@extends('layouts.mainLayout')

@section('title', 'List Deleted Book')

@section('content')

    <h1>List Deleted Book</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/books" class="btn btn-secondary">Back</a>
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
                    <th class="col-sm-1">Code</th>
                    <th class="col-sm-4">Title</th>
                    <th class="col-sm-2">Category</th>
                    <th class="col-sm-1">Status</th>
                    <th class="col-sm-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedBooks as $item)
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
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="book-restore/{{ $item->slug }}" class="btn btn-primary me-3">Restore</a>
                            <form action="book-permanent-delete/{{ $item->slug }}" method="post" class="d-block mt-3"
                                onsubmit="return confirmDelete()">
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
        var result = confirm("Are you sure you want to permanently delete this book?");

        // Kembalikan nilai true atau false berdasarkan pilihan pengguna
        return result;
    }
</script>
