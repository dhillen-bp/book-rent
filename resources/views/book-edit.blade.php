@extends('layouts.mainLayout')

@section('title', 'Edit Book')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h1>Edit Book</h1>

    <div>

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

            <form action="/book-edit/{{ $book->slug }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="code" class="form-label fw-bold">Code</label>
                    <input type="text" class="form-control" name="book_code" id="code" placeholder="Book Code"
                        value="{{ $book->book_code }}">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Book Title"
                        value="{{ $book->title }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Cover Image</label>
                    @if ($book->cover != '')
                        <img src="{{ asset('storage/cover/' . $book->cover) }}" alt="Cover Image"
                            class="img-fluid mb-3 d-block" width="200px">
                    @else
                        <img src="{{ asset('images/cover-default.png') }}" alt="Cover Image" class="img-fluid mb-3 d-block"
                            width="200px">
                    @endif

                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label fw-bold">Category</label>
                    <p>
                        @foreach ($book->categories as $category)
                            | {{ $category->name }} |
                        @endforeach
                    </p>
                    <select name="categories[]" id="category" class="form-control select-multiple" multiple="multiple">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection
