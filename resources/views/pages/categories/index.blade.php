@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2>Categories</h2>
        <a href="{{ route('tasks.show-active') }}" class="btn btn-outline-primary">Tasks</a>
        <hr>
        @include('pages.categories.components.form')
        <hr>
        @include('pages.categories.components.table')
    </div>
@endsection
