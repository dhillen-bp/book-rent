@extends('layouts.mainLayout')

@section('title', 'Profile')

@section('content')
    <div class="my-5">
        <h2 class="mb-3">Your Rent Logs</h2>
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>
@endsection
