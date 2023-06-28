@extends('layouts.mainLayout')

@section('title', 'List Deleted Category')

@section('content')

    <h1>List Deleted Category</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="categories" class="btn btn-secondary">Back</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif

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
                @foreach ($deletedCategories as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="category-restore/{{ $item->slug }}" class="btn btn-primary me-3">Restore</a>
                            <form action="category-permanent-delete/{{ $item->slug }}" method="post"
                                class="d-inline-block" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete Permanent</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

<script>
    function confirmDelete() {
        // Tampilkan dialog konfirmasi
        var result = confirm("Are you sure you want to permanently delete this category?");

        // Kembalikan nilai true atau false berdasarkan pilihan pengguna
        return result;
    }
</script>
