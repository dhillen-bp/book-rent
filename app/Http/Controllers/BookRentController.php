<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where([
            ['role_id', '!=', 1],
            ['status', '!=', 'inactive']
        ])->get();
        $books = Book::all();
        return view('book-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(7)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        // if book = not available
        if ($book['status'] != 'in stock') {
            Session::flash('message', "Can't rent, the book is not available");
            Session::flash('alert-class', "alert-danger");
            return redirect('book-rent');
        } else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('message', "Can't rent, user has reach limit of books");
                Session::flash('alert-class', "alert-danger");
                return redirect('book-rent');
            } else {
                try {
                    // Database Transaction karena lebih dari 1 proses
                    DB::beginTransaction();

                    // process insert to rent_logs table
                    RentLogs::create($request->all());

                    // process update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', "Rent Book Success");
                    Session::flash('alert-class', "alert-success");
                    return redirect('book-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
}
