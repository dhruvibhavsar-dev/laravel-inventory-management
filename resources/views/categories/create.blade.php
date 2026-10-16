@extends('layouts.app')
@section('title', 'Add Category')
@section('content')
<h1 class="h3 mb-3">Add Category</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        @include('categories._form')
    </form>
</div></div>
@endsection
