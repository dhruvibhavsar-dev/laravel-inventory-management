@extends('layouts.app')
@section('title', 'Edit Material')
@section('content')
<h1 class="h3 mb-3">Edit Material</h1>
<div class="alert alert-info">Editing changes only the material's basic details. Existing inward/outward transactions are not edited.</div>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('materials.update', $material) }}">
        @csrf @method('PUT')
        @include('materials._form')
    </form>
</div></div>
@endsection
