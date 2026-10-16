@extends('layouts.app')
@section('title', 'Add Material')
@section('content')
<h1 class="h3 mb-3">Add Material</h1>
<div class="card"><div class="card-body">
    <form method="POST" action="{{ route('materials.store') }}">
        @csrf
        @include('materials._form')
    </form>
</div></div>
@endsection
