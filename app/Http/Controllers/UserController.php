<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile()
    {
        $rentlogs = RentLogs::with('user', 'book')->where('user_id', Auth::user()->id)->get();
        return view('profile', ['rent_logs' => $rentlogs]);
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::where('role_id', 2)->where([
            ['status', 'active'],
            ['username', 'LIKE', '%' . $keyword . '%']
        ])
            ->paginate(10);
        return view('user', ['users' => $users]);
    }

    public function registeredUsers()
    {
        $registedUsers = User::where('role_id', 2)->where('status', 'inactive')->get();
        return view('registered-user', ['registedUsers' => $registedUsers]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with('user', 'book')->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'rent_logs' => $rentlogs]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('user-detail/' . $slug)->with('status', 'User Approved Successfully!');
    }

    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-delete', ['user' => $user]);
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        return redirect('users')->with('status', 'User Banned Successfully!');
    }

    public function bannedUsers()
    {
        $bannedUsers = User::onlyTrashed()->get();
        return view('user-banned-list', ['bannedUsers' => $bannedUsers]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect('users')->with('status', 'User Restored Successfully!');
    }

    public function permanentDelete($slug)
    {
        $deletedUser = User::withTrashed()->where('slug', $slug)->first();
        $deletedUser->forceDelete();

        if ($deletedUser) {
            Session::flash('status', 'success');
            Session::flash('message', "Ban Permanent User data $deletedUser->name successfully");
        }

        return redirect('/users');
    }
}
