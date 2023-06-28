@extends('layouts.mainLayout')

@section('title', 'Book')

@section('content')

    <h1>Book List</h1>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
        @if (Session::get('message'))
            <div class="alert alert-warning" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
    @endif

    <div class="mt-5 d-flex justify-content-end">
        <a href="book-add" class="btn btn-primary me-4">Add Data</a>
        <a href="book-deleted" class="btn btn-info">Show Deleted Data</a>
    </div>

    <div class="my-5">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-sm-1">No.</th>
                    <th class="col-sm-1">Code</th>
                    <th class="col-sm-4">Title</th>
                    <th class="col-sm-2">Category</th>
                    <th class="col-sm-2">Status</th>
                    <th class="col-sm-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach ($item->categories as $category)
                                | {{ $category->name }} |
                            @endforeach
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="book-edit/{{ $item->slug }}" class="btn btn-warning me-2">Edit</a>
                            <a href="book-delete/{{ $item->slug }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
