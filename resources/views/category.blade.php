@extends('layouts.mainLayout')

@section('title', 'Category')

@section('content')

    <h1>Category List</h1>

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

    <div class="mt-5 row d-flex justify-content-between">
        <div class="col-12 col-sm-5 mb-3">
            <form action="" method="get" class="">
                <div class="input-group">
                    <input type="text" class="form-control" id="floatingInputGroup1" name="keyword"
                        placeholder="Search Keyword">
                    <button class="input-group-text btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="col-12 col-md-auto">
            <a href="category-add" class="btn btn-primary me-4">Add Data</a>
            <a href="category-deleted" class="btn btn-info">Show Deleted Data</a>
        </div>
    </div>

    <div class="my-5">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th class="col-sm-1">No.</th>
                    <th class="col-sm-6">Name</th>
                    <th class="col-sm-5">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $loop->index + $categories->firstItem() }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="category-edit/{{ $item->slug }}" class="btn btn-warning me-2">Edit</a>
                            <a href="category-delete/{{ $item->slug }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $categories->withQueryString()->links() }}
@endsection
