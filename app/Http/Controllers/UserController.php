<?php

namespace App\Http\Controllers;

use App\Models\FrindRequest;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }
    public function register()
    {
        return view('register');
    }
    public function registerRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = $this->userRepository->addUser([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($user) {
            return redirect('/');
        }
        return redirect()->back()->withInput()->withErrors('an error occuer please try again');
    }

    public function profile($user_id)
    {
        $user = $this->userRepository->getUserPosts($user_id);
        return view('profile', compact(['user']));
    }
}
