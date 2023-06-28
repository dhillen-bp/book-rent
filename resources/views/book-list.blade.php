@extends('layouts.mainLayout')

@section('title', 'Book List')

@section('content')

    <form action="" method="GET">
        <div class="row">
            <div class="col-12 col-sm-6">
                <select name="category" id="" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Book's Title Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div class="my-5">
        <div class="row">

            @foreach ($books as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ $item->cover != null ? asset('storage/cover/' . $item->cover) : asset('images/cover-default.png') }}"
                            class="card-img-top img-fluid" alt="Book Cover" draggable="false" height="350px">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $item->book_code }}</h5>
                            <p class="card-text">{{ $item->title }}</p>
                            <h6 class="text-end"><span
                                    class="badge {{ $item->status == 'in stock' ? 'text-bg-success' : 'badge bg-secondary' }}">{{ $item->status }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
