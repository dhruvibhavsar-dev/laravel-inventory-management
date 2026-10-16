<div class="mb-3">
    <label for="category_id" class="form-label">Material category <span class="text-danger">*</span></label>
    <select id="category_id" name="category_id" class="form-select" required>
        <option value="">Select category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected((string) old('category_id', $material->category_id ?? '') === (string) $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="name" class="form-label">Material name <span class="text-danger">*</span></label>
    <input id="name" name="name" type="text" class="form-control" maxlength="150" required
           pattern="(?=.*[A-Za-z0-9])[A-Za-z0-9 _-]+"
           value="{{ old('name', $material->name ?? '') }}" placeholder="e.g. Steel Rod 12">
    <div class="form-text">Letters, numbers, spaces, hyphens and underscores are allowed.</div>
</div>
<div class="mb-3">
    <label for="opening_balance" class="form-label">Opening balance <span class="text-danger">*</span></label>
    <input id="opening_balance" name="opening_balance" type="number" step="0.01" class="form-control" required
           value="{{ old('opening_balance', $material->opening_balance ?? '') }}" placeholder="e.g. 100.00">
    <div class="form-text">Maximum 2 digits after the decimal point.</div>
</div>
<button class="btn btn-primary" type="submit">Save Material</button>
<a href="{{ route('materials.index') }}" class="btn btn-secondary">Cancel</a>
