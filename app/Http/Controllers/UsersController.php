<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display the user's list data.
     */
    public function showList(Request $request): View
    {
        $users = User::where('roles_id',12)->with('role')->where('is_active',1)->get()->toArray();

        return view('users.showList', [
            'userList' => $users,
        ]);
    }
}
