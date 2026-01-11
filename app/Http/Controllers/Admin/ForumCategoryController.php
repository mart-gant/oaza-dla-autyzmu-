<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumCategoryController extends Controller
{
    public function __construct()
    {
        // Tylko admin może zarządzać kategoriami
        $this->middleware(function ($request, $next) {
            if (!Auth::user() || !Auth::user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ForumCategory::withCount('topics')->orderBy('name')->get();
        return view('admin.forum.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.forum.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:forum_categories,name',
        ]);

        ForumCategory::create($request->only('name'));

        return redirect()->route('admin.forum.categories.index')
            ->with('success', 'Kategoria została pomyślnie utworzona.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForumCategory $category)
    {
        return view('admin.forum.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ForumCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:forum_categories,name,' . $category->id,
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin.forum.categories.index')
            ->with('success', 'Kategoria została pomyślnie zaktualizowana.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForumCategory $category)
    {
        if ($category->topics()->count() > 0) {
            return redirect()->route('admin.forum.categories.index')
                ->with('error', 'Nie można usunąć kategorii z tematami. Usuń najpierw wszystkie tematy.');
        }

        $category->delete();

        return redirect()->route('admin.forum.categories.index')
            ->with('success', 'Kategoria została pomyślnie usunięta.');
    }
}
