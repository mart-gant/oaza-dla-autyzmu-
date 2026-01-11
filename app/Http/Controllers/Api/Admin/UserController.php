<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\RoleChanged;
use App\Notifications\UserSuspended;
use App\Notifications\UserUnsuspended;

class UserController extends Controller
{
    public function index(Request $request)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        $users = User::paginate(20);
        return response()->json($users);
    }

    public function updateRole(Request $request, User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        $request->validate(['role' => 'required|string']);
        $oldRole = $user->role;
        $user->role = $request->role;
        $user->save();
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_role',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => ['old_role' => $oldRole, 'new_role' => $user->role],
        ]);

        $user->notify(new RoleChanged($user->role));

        return response()->json(['message' => 'Role updated']);
    }

    public function destroy(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);
        $user->delete();
        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        return response()->json(['message' => 'User deleted']);
    }

    public function suspend(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $user->is_suspended = true;
        $user->suspended_until = null;
        $user->save();

        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'suspend_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        $user->notify(new UserSuspended($user->suspended_until));

        return response()->json(['message' => 'User suspended']);
    }

    public function unsuspend(User $user)
    {
        abort_if(! auth()->check() || auth()->user()->role !== 'admin', 403);

        $user->is_suspended = false;
        $user->suspended_until = null;
        $user->save();

        \App\Models\AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'unsuspend_user',
            'target_type' => 'user',
            'target_id' => $user->id,
            'meta' => null,
        ]);

        $user->notify(new UserUnsuspended());

        return response()->json(['message' => 'User unsuspended']);
    }
}
