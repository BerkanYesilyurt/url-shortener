<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(User $user)
    {
        if(auth()->user()->admin_authority == 1){
            $users = $user->simplePaginate(10);
            return view('admin', compact('users'));
        }else{
            return redirect('/');
        }
    }

    public function user($user_id){

    }

    public function editUser($user_id){

    }
}
