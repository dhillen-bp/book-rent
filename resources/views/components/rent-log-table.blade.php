<div>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th class="col-sm-1">No.</th>
                <th class="col-sm-1">User</th>
                <th class="col-sm-2">Book</th>
                <th class="col-sm-2">Rent Date</th>
                <th class="col-sm-2">Return Date</th>
                <th class="col-sm-2">Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $item)
                <tr
                    class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'table-danger' : 'table-success') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->book->book_code }} - {{ $item->book->title }}</td>
                    <td>{{ $item->rent_date }}</td>
                    <td>{{ $item->return_date }}</td>
                    <td>{{ $item->actual_return_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
