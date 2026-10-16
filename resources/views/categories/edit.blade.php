@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<h1 class="h3 mb-3">Edit Category</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf @method('PUT')
        @include('categories._form')
    </form>
</div></div>
@endsection
