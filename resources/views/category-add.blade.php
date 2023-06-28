@extends('layouts.mainLayout')

@section('title', 'Add Category')

@section('content')

    <h1>Add New Category</h1>

    <div>
        <form action="category-add" method="POST">
            @csrf
            <div class="mt-5 w-50">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="name" class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Category Name"
                    value="{{ old('name') }}">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

@endsection
