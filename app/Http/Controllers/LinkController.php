<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;
use Spatie\ValidationRules\Rules\Delimited;

class LinkController extends Controller
{
    public function getRealIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->getClientIp();
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

    public function redirect($short_path, Link $link, Visitor $visitor, Request $request)
    {
        $url = $link->where('short_path', '=' , $short_path);
        if($url->value('url') == null){
            return redirect('/');
        }else{

            if($url->value('private') == 1){
                if(auth()->user() && ($this->checkInEmails($url->value('email')) >= 1)){
                    //authorized
                }else{
                    if(auth()->user()){
                        return redirect('/')->with('message', 'You are not authorized to access this link.');
                    }else{
                        return redirect('/login')->with('message', 'This is a private link. You must be logged in to be able to access the real link.');
                    }

                }
            }
            if(is_null($request->header('referer'))){
                $referer = "Direct";
            }else{
                $referer = $request->header('referer');
            }

            $agent = new Agent;
            $visitor->create([
                'link_id' => $url->value('id'),
                'ip_address' => self::getRealIp(),
                'browser' => $agent->browser(),
                'device' => $agent->device(),
                'referer' => $referer,
                'other' => $request->userAgent()
            ]);

            return redirect()->away($url->value('url'));

        }
    }

    public function generatePath()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 7; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function store(Request $request)
    {

        $fields = $request->validate(
            [
            'url' => 'required|url',
            'private' => 'required|boolean',
            'email' => ['nullable','min:5','required_if:private,==,1', new Delimited('email')]
            ],
            [
                'email.required_if' => 'The email field is required when private is selected.',
            ]);


        $link = new Link;

        do{
            $myPath = self::generatePath();
            $myPathCount = $link->where('short_path', $myPath)->count();
        }while($myPathCount > 0);

        $fields['short_path'] = $myPath;

        if(auth()->user()){
        $fields['user_id'] = auth()->user()->id;
        }

        $link->create($fields);

        return back()->with('short_path', $fields['short_path']);

    }


    public function destroy($id, User $user, Link $link, Visitor $visitor)
    {
        $linkRecord = $link->where('id', '=', $id);
        if(auth()->user() && ((auth()->user()->id == $linkRecord->value('user_id')) || auth()->user()->admin_authority == 1)){

        $linkRecord->delete();
        $visitors = $visitor->where('link_id', '=', $id);
        $visitors->delete();

        return back()->with('message', 'URL and visitors deleted successfully.');

        }else{

        return back()->with('message', 'You are not authorized to delete this URL.');

        }
    }


}
