@extends('layouts.mainLayout')

@section('title', 'Detail User')

@section('content')

    <h1>Detail User</h1>

    <div class="mt-5 d-flex justify-content-end">
        @if ($user->status == 'inactive')
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-success">Approve User</a>
        @endif
    </div>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="my-5 w-20 col-lg-3 col-md-6">
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" class="form-control" value="{{ $user->username }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Addres</label>
                <textarea class="form-control" name="" id="" rows="5" readonly style="resize: none">{{ $user->addres }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <input type="text" class="form-control" value="{{ $user->status }}" readonly>
            </div>
        </div>

        <div class="my-5 w-75 col-lg-9 col-md-6">
            <h3 class="mb-3">Rent Logs</h3>
            <x-rent-log-table :rentlog='$rent_logs' />
        </div>
    </div>
    </div>
@endsection
