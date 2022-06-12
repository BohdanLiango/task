@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2>TASKS</h2>
        <a href="{{ route('tasks.category.show-all') }}" class="btn btn-outline-primary">Categories</a>
        <hr>
       @include('pages.tasks.components.form')
        <hr>
       @include('pages.tasks.components.table')
    </div>
@endsection
