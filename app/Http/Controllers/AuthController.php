<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return  view('index');
    }
    public function loginRequest(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        $data=['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($data)){
            return redirect('posts/list');
        }
        return redirect()->back()->withInput($data)->withErrors("email or password not correct");
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    
}
