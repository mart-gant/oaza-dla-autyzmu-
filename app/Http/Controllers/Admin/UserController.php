<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;
use App\Notifications\RoleChanged;
use App\Notifications\UserSuspended;
use App\Notifications\UserUnsuspended;


class UserController extends Controller
{
    public function index()
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:parent,therapist,educator,admin,autistic_person,specialist',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => ['role' => $user->role],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Użytkownik został utworzony pomyślnie!');
    }

    public function edit(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:parent,therapist,educator,admin,autistic_person,specialist',
        ]);

        $oldData = $user->only(['name', 'email', 'role']);
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        
        $user->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => ['old' => $oldData, 'new' => $user->only(['name', 'email', 'role'])],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Użytkownik został zaktualizowany pomyślnie!');
    }

    public function updateRole(Request $request, User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $request->validate(['role' => 'required|string']);
        $oldRole = $user->role;
        $user->role = $request->role;
        $user->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_role',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => ['old_role' => $oldRole, 'new_role' => $user->role],
        ]);

        // Send notification
        $user->notify(new RoleChanged($user->role));

        return redirect()->back()->with('success', 'Role updated');
    }

    public function destroy(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $userId = $user->id;
        $user->delete();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_user',
            'target_type' => 'user',
            'target_id' => $userId,
            'meta' => null,
        ]);

        return redirect()->back()->with('success', 'User deleted');
    }

    public function impersonate(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        session(['impersonator_id' => auth()->id()]);
        Auth::loginUsingId($user->id);

        AuditLog::create([
            'user_id' => session('impersonator_id'),
            'action' => 'impersonate_start',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        return redirect('/');
    }

    public function stopImpersonate()
    {
        $impersonator = session()->pull('impersonator_id');
        if ($impersonator) {
            Auth::loginUsingId($impersonator);
            AuditLog::create([
                'user_id' => $impersonator,
                'action' => 'impersonate_stop',
                'target_type' => 'user',
                'target_id' => auth()->id(),
                'meta' => null,
            ]);
        }

        return redirect()->route('admin.users.index');
    }

    public function suspend(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $user->is_suspended = true;
        $user->suspended_until = null;
        $user->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        // Send notification
        $user->notify(new UserSuspended($user->suspended_until));

        return redirect()->back()->with('success', 'User suspended');
    }

    public function unsuspend(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $user->is_suspended = false;
        $user->suspended_until = null;
        $user->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'unsuspend_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        // Send notification
        $user->notify(new UserUnsuspended());

        return redirect()->back()->with('success', 'User unsuspended');
    }
}
