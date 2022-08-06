<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Visitor;
use Illuminate\Http\Request;

class StatsController extends Controller
{

    public function dashboard(Link $link)
    {
        if(auth()->user()){
            $LinksOfUser = $link->where('user_id', '=', auth()->user()->id)->simplePaginate(10);

            return view('dashboard', compact('LinksOfUser'));
        }else{
           return redirect('/');
        }
    }

    public function isAdmin(){
        if(auth()->user()){
            if(auth()->user()->admin_authority == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function checkInEmails($emails)
    {
        $count = 0;
        $separatedEmails = explode(',', $emails);
        foreach ($separatedEmails as $separatedEmail)
        {
            if(trim($separatedEmail) == auth()->user()->email){
                $count++;
            }
        }

        return $count;
    }

    public function stats($short_path, Link $link, Visitor $visitor){
        $matchedLink = $link->where('short_path', '=' , $short_path);
        $machedLinkId = $matchedLink->value('id');
        $visitors = $visitor->where('link_id', '=' , $machedLinkId)->simplePaginate(10);
        if($matchedLink->exists()){

            if($matchedLink->value('private') == 1) {
                if ((auth()->user() && ($this->checkInEmails($matchedLink->value('email')) >= 1)) || $this->isAdmin()){
                    //authorized
                    return view('stats', compact('visitors'));
                }else{
                    if(auth()->user()){
                        return redirect('/')->with('message', 'You are not authorized to access stats of this link.');
                    }else{
                        return redirect('/login')->with('message', 'This is a private link. You must be logged in to be able to access stats of this link.');
                    }

                }
            }else{
                    return view('stats', compact('visitors'));
            }


        }else{
            return redirect('/');
        }

    }
}
