<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;
use Spatie\ValidationRules\Rules\Delimited;

class LinkController extends Controller
{

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

    public function rules()
    {
        return [
            'url' => 'required|url',
            'private' => 'required|boolean',
            'email' => ['nullable','min:5','required_if:private,==,1', new Delimited('email')]
        ];
    }

public function newLink(Request $request, Link $link, User $user){

    $validator = Validator::make(request()->all(), [
        'API_token' => 'required|min:35|max:35|exists:users',
        'url' => 'required|url',
        'private' => 'required|boolean',
        'email' => ['nullable','min:5','required_if:private,==,1', new Delimited('email')]
    ],
        [
            'API_token.required' => 'The API token is required.',
            'email.required_if' => 'The email field is required when private is selected.',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => true,
            'errors' => $validator->errors(),
        ]);
    }

    $currentUser = $user->where('API_token', $request->API_token);

    do{
        $myPath = self::generatePath();
        $myPathCount = $link->where('short_path', $myPath)->count();
    }while($myPathCount > 0);

    $link->user_id = $currentUser->value('id');
    $link->url = $request->url;
    $link->private = $request->private;
    $link->email = $request->private ? $request->email : NULL;
    $link->short_path = $myPath;

    $link->save();

    return response()->json([
        'error' => false,
        'link' => new LinkResource($link),
    ], 201);


}

public function getDetails(){

}

}
