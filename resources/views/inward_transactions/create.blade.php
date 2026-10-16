@extends('layouts.app')
@section('title', 'Add Inward/Outward')
@section('content')
<h1 class="h3 mb-3">Add Inward/Outward Quantity</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('inward-transactions.store') }}">
        @csrf
        <div class="mb-3">
            <label for="category_id" class="form-label">Material category <span class="text-danger">*</span></label>
            <select id="category_id" name="category_id" class="form-select" required>
                <option value="">Select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id') === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="material_id" class="form-label">Material name <span class="text-danger">*</span></label>
            <select id="material_id" name="material_id" class="form-select" required disabled>
                <option value="">Select a category first</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="transaction_date" class="form-label">Date <span class="text-danger">*</span></label>
            <input id="transaction_date" name="transaction_date" type="date" class="form-control" required
                   value="{{ old('transaction_date', now()->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Material inward/outward quantity <span class="text-danger">*</span></label>
            <input id="quantity" name="quantity" type="number" step="0.01" class="form-control" required
                   value="{{ old('quantity') }}" placeholder="Use a negative value for outward stock">
            <div class="form-text">Example: 5.00 for inward, -3.00 for outward. Maximum 2 decimal places.</div>
        </div>

        <button class="btn btn-primary" type="submit">Save Transaction</button>
        <a href="{{ route('inward-transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const categorySelect = document.getElementById('category_id');
    const materialSelect = document.getElementById('material_id');
    const oldMaterialId = @json(old('material_id'));

    // Fetch only active materials for the selected category.
    async function loadMaterials(selectedMaterialId = '') {
        materialSelect.innerHTML = '<option value="">Loading materials...</option>';
        materialSelect.disabled = true;

        if (!categorySelect.value) {
            materialSelect.innerHTML = '<option value="">Select a category first</option>';
            return;
        }

        try {
            const response = await fetch(
                @json(url('/categories')) + '/' + encodeURIComponent(categorySelect.value) + '/materials',
                { headers: { 'Accept': 'application/json' } }
            );

            if (!response.ok) throw new Error('Could not load materials');

            const materials = await response.json();
            materialSelect.innerHTML = '<option value="">Select material</option>';

            materials.forEach(material => {
                const option = document.createElement('option');
                option.value = material.id;
                option.textContent = material.name;
                if (String(material.id) === String(selectedMaterialId)) option.selected = true;
                materialSelect.appendChild(option);
            });

            if (materials.length === 0) {
                materialSelect.innerHTML = '<option value="">No active materials in this category</option>';
            } else {
                materialSelect.disabled = false;
            }
        } catch (error) {
            materialSelect.innerHTML = '<option value="">Unable to load materials</option>';
        }
    }

    categorySelect.addEventListener('change', () => loadMaterials());
    if (categorySelect.value) loadMaterials(oldMaterialId);
});
</script>
@endpush
