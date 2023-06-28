@extends('layouts.mainLayout')

@section('title', 'Category')

@section('content')

    <form action="/category-delete/{{ $category->slug }}" method="POST"
        class="mx-auto card shadow col-6 d-flex justify-content-center align-items-center">
        @csrf
        @method('DELETE')
        <h3 class="card-title m-5 text-center">
            Are you sure to delete category <b>{{ $category->name }}</b>?</h3>

        <div class="card-body mb-5">
            <button class="btn btn-danger me-5" type="submit">Sure Delete</button>
            <a href="/categories" class="btn btn-light">Cancel</a>
        </div>
    </form>

@endsection
