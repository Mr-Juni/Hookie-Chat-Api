<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Events\UserSignedUp;
use App\User;

class NameController extends Controller
{

    public function store(Request $request, User $user) {

    	$attribute = $this->validate($request, [
    		'username' => 'required|unique:users'
    	]);

    		$generateRandomString = Str::random(60);
	        $token = hash('sha256', $generateRandomString);

	        $user->username = $request->input('username');
	        $user->api_token = $token;
	        $user->save();

            $permission = "new";
	        event(new UserSignedUp($request->input('username'), $permission));
	        return response()->json(['data' => ['success' => true, 'user' => $user]], 201);
    }

    public function continue(Request $request, User $user) {

    	$attribute = $this->validate($request, [
    		'username' => 'required'
    	]);

    	$data_check = User::where('username', $request->input('username'))->exists();

    	if (!$data_check) {
    		return response()->json(['data' => ['error' => false, 'message' => 'username does not exist']], 401);
    	}

        $permission = "continue";
    	$data = User::where('username', $request->input('username'))->first();
	    event(new UserSignedUp($request->input('username'), $permission));
	    return response()->json(['data' => ['success' => true, 'user' => $data]], 201);
    }
}
