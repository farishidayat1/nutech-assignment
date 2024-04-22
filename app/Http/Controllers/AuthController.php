<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('product');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data))
        {
            return redirect()->route('product');
        } else {
            Session::flash('error_message', 'Email and Password is Wrong!');
            return redirect()->route('login.form');
        }    
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|min:3|max:50',
            'lastname' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ]); 

        $user = new User();
        $user->name = $request->firstname.' '.$request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.form')->with('success_message', 'Successfully created user!');
    }
}
