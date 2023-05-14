<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	public function __construct()
    {
	    
	}
	
	public function Login(Request $request) {
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);

		if (Auth::attempt($credentials)) {   
			$token = $request->user()->createToken("booka");
			return ['token' => $token->plainTextToken];
		}else{
			return ['message' => "unauthenticated"];
		}
	}
    
}
