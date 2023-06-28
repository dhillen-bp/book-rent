@extends('layouts.mainLayout')

@section('title', 'User Delete')

@section('content')

    <form action="/user-ban/{{ $user->slug }}" method="POST"
        class="mx-auto card shadow col-6 d-flex justify-content-center align-items-center">
        @csrf
        @method('DELETE')
        <h3 class="card-title m-5 text-center">
            Are you sure to delete user <b>{{ $user->username }}</b>?</h3>

        <div class="card-body mb-5">
            <button class="btn btn-danger me-5" type="submit">Sure Delete</button>
            <a href="/users" class="btn btn-light">Cancel</a>
        </div>
    </form>

@endsection
