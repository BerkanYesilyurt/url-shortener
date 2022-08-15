<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function showUser($user_id, User $user){
        if(auth()->user()->admin_authority == 1){
            $userInfo = $user->where('id', '=', $user_id)->first();
            return view('admin.edituser', compact('userInfo'));
        }else{
            return redirect('/');
        }
    }

    public function editUser($user_id, User $user, Request $request){
        if(auth()->user()->admin_authority == 1){

            $fields = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
                'password' => ['nullable', 'min:6'],
                'admin_authority' => ['required', 'boolean'],
                'API_token' => ['nullable', 'min:35', 'max:35', 'alpha_num']
            ]);

            $currentUserToken = $user->where('id', '=' , $user_id)->value('API_token');
            $istokenExists = $user->where('API_token', '=' , $fields['API_token']);

            if(($istokenExists->count() == 1 && $currentUserToken == $fields['API_token']) || $currentUserToken == $fields['API_token']){
                unset($fields['API_token']);
            }elseif($istokenExists->count() == 0){
                //passed
            }else{
                return back()->withErrors(['API_token' => 'The API token has already been taken.']);
            }

            if (!empty($fields['password'])){
                $fields['password'] = bcrypt($fields['password']);
            }else{
                unset($fields['password']);
            }


            $user->where('id', '=', $user_id)->update($fields);

            return back()->with('message', 'You have successfully edited user.');

        }else{
            return redirect('/');
        }
    }

    public function deleteUser($user_id, User $user, Link $link){

        $links = $link->where('user_id', '=', $user_id);
        $links->delete();

        $user->find($user_id)->delete();

        return redirect('/admin')->with('message', 'You have successfully deleted user.');
    }
}
