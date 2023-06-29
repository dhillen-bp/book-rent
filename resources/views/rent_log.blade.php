@extends('layouts.mainLayout')

@section('title', 'Rent Log')

@section('content')

    <h1>Rent Log</h1>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
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
            <a href="book-add" class="btn btn-primary me-4">Add Data</a>
            <a href="book-deleted" class="btn btn-info">Show Deleted Data</a>
        </div>
    </div>

    <div class="my-5">
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>

    <div class="my-5">
        {{ $rent_logs->withQueryString()->links() }}
    </div>
@endsection
