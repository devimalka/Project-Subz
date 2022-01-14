<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function panel(){


        $users = User::all();
        return view('admin.panel')->with('users',$users);

    }
}
