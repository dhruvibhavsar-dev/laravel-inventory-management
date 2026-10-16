@extends('layouts.app')

@section('title', 'Manage Materials')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="h3 mb-0">Manage Materials</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('inward-transactions.create') }}" class="btn btn-outline-primary">Add Inward/Outward</a>
        <a href="{{ route('materials.create') }}" class="btn btn-primary">Add Material</a>
    </div>
</div>

<div class="card"><div class="table-responsive">
<table class="table table-striped table-hover align-middle mb-0">
    <thead><tr><th>Material ID</th><th>Category</th><th>Material Name</th><th>Opening Balance</th><th>Current Balance</th><th style="width: 160px">Actions</th></tr></thead>
    <tbody>
    @forelse ($materials as $material)
        @php
            // Use the eager-loaded sum to avoid an extra transaction query for each row.
            $currentBalance = (float) $material->opening_balance + (float) ($material->transactions_sum_quantity ?? 0);
        @endphp
        <tr>
            <td>{{ $material->id }}</td>
            <td>{{ $material->category->name }}</td>
            <td>{{ $material->name }}</td>
            <td>{{ number_format((float) $material->opening_balance, 2) }}</td>
            <td>{{ number_format($currentBalance, 2) }}</td>
            <td>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('materials.edit', $material) }}">Edit</a>
                <form class="d-inline" method="POST" action="{{ route('materials.destroy', $material) }}" onsubmit="return confirm('Soft-delete this material?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center py-4">No materials found. Add your first material.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $materials->links() }}</div>
@endsection
