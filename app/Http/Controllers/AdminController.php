<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(User $user)
    {
        if(auth()->user()->admin_authority == 1){
            $users = $user->simplePaginate(10);
            return view('admin.index', compact('users'));
        }else{
            return redirect('/');
        }
    }

    public function user($user_id, Link $link, User $user){
        if(auth()->user()->admin_authority == 1){
            $userInfo = $user->where('id', '=', $user_id)->first();
            $LinksOfUser = $link->where('user_id', '=', $user_id)->simplePaginate(10);
            return view('admin.linksofuser', compact('LinksOfUser', 'userInfo'));
        }else{
            return redirect('/');
        }
    }

    public function editUser($user_id){

    }
}
