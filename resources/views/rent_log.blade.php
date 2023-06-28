@extends('layouts.mainLayout')

@section('title', 'Rent Log')

@section('content')

    <h1>Rent Log</h1>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-5 d-flex justify-content-end">
        <a href="book-add" class="btn btn-primary me-4">Add Data</a>
        <a href="book-deleted" class="btn btn-info">Show Deleted Data</a>
    </div>

    <div class="my-5">
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>

@endsection
