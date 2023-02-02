<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //


    public function loginIndex(){

        return view("client.login");
    }


    public function loginSubmit(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard("client")->attempt($credentials)) {
            $request->session()->regenerate();

            return Auth::id();

            //return redirect()->intended('dashboard');
        }

        return "email or password incorrect";
//        return back()->withErrors([
//            'email' => 'The provided credentials do not match our records.',
//        ])->onlyInput('email');
    }






}
