<div class="mb-3">
    <label for="name" class="form-label">Category name <span class="text-danger">*</span></label>
    <input id="name" name="name" type="text" class="form-control" maxlength="100" required
           value="{{ old('name', $category->name ?? '') }}" placeholder="e.g. Raw material">
    <div class="form-text">Use letters, numbers, spaces, hyphens or underscores.</div>
</div>
<button class="btn btn-primary" type="submit">Save</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
