<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    // Show all categories.
    public function index(): View
    {
        $categories = Category::withCount('materials')->orderBy('name')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    // Show the create-category form.
    public function create(): View
    {
        return view('categories.create');
    }

    // Validate and save a new category.
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9 _-]+$/', 'unique:categories,name'],
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    // Show the edit form for a category.
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    // Validate and update an existing category.
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required', 'string', 'max:100', 'alpha_dash:ascii',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Prevent deleting categories that still have active materials.
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->materials()->withTrashed()->exists() || $category->transactions()->exists()) {
            return back()->with('error', 'This category has materials. Move or delete those materials first.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
