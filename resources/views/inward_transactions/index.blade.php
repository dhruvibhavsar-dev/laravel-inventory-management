@extends('layouts.app')
@section('title', 'Inward/Outward Transactions')
@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <h1 class="h3 mb-0">Inward/Outward Transactions</h1>
    <a href="{{ route('inward-transactions.create') }}" class="btn btn-primary">Add Transaction</a>
</div>
<p class="text-muted">Positive quantity = inward stock; negative quantity = outward stock.</p>
<div class="card"><div class="table-responsive">
<table class="table table-striped table-hover align-middle mb-0">
    <thead><tr><th>Inward ID</th><th>Date</th><th>Category</th><th>Material</th><th>Quantity (+/-)</th></tr></thead>
    <tbody>
    @forelse ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->transaction_date->format('d-m-Y') }}</td>
            <td>{{ $transaction->category->name }}</td>
            <td>{{ $transaction->material->name }}</td>
            <td>{{ number_format((float) $transaction->quantity, 2) }}</td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center py-4">No transactions recorded yet.</td></tr>
    @endforelse
    </tbody>
</table></div></div>
<div class="mt-3">{{ $transactions->links() }}</div>
@endsection
