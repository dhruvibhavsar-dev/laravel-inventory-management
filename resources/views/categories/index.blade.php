@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Category Master</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
</div>

<div class="card"><div class="table-responsive">
<table class="table table-striped table-hover mb-0">
    <thead><tr><th>ID</th><th>Category Name</th><th>Materials</th><th style="width: 190px">Actions</th></tr></thead>
    <tbody>
    @forelse ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->materials_count }}</td>
            <td>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('categories.edit', $category) }}">Edit</a>
                <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center py-4">No categories found.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
