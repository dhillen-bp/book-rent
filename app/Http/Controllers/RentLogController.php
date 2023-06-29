<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $rentlogs = RentLogs::with('user', 'book')
            ->whereHas('book', function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('username', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);
        return view('rent_log', ['rent_logs' => $rentlogs]);
    }
}
