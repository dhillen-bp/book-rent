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
        return view('rent-book', ['users' => $users, 'books' => $books]);
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

    public function returnBook()
    {
        $users = User::where([
            ['role_id', '!=', 1],
            ['status', '!=', 'inactive']
        ])->get();

        return view('return-book', ['users' => $users]);
    }

    public function getUserBooks($user_id)
    {
        $books = Book::whereHas('rentLogs', function ($query) use ($user_id) {
            $query->where([
                ['user_id', $user_id],
                ['actual_return_date', null]
            ]);
        })->get();

        return response()->json($books);
    }


    public function saveReturnBook(Request $request)
    {
        $rent = RentLogs::where([
            ['user_id', $request->user_id],
            ['book_id', $request->book_id],
            ['actual_return_date', '=', NULL]
        ]);
        $rentData = $rent->first();
        $countData = $rent->count();

        if ($countData === 1) {
            try {
                DB::beginTransaction();

                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save();

                $book = Book::findOrFail($request->book_id);
                $book->status = 'in stock';
                $book->save();

                DB::commit();

                Session::flash('message', "Book is returned successfully");
                Session::flash('alert-class', "alert-success");
                return redirect('book-return');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } else {
            Session::flash('message', "Error in returning the book!");
            Session::flash('alert-class', "alert-danger");
            return redirect('book-return');
        }
    }
}
