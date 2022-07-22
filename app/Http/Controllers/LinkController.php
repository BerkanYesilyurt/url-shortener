<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function redirect($short_path, Link $link){


        $url = $link->where('short_path', '=' , $short_path)->value('url');
        if($url == null){
         return redirect('/');
        }else{
       return redirect()->away($url);
        }
    }

    public function generatePath() {
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
        $fields = $request->validate([
            'url' => 'required|url',
            'private' => 'required|boolean',
        ]);


        $link = new Link;

        do{
            $myPath = self::generatePath();
            $myPathCount = $link->where('short_path', $myPath)->count();
        }while($myPathCount > 0);

        $fields['short_path'] = $myPath;


        $link->create($fields);

        return back()->with('short_path', $fields['short_path']);

    }


}
