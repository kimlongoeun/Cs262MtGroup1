<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:3', 'max:200']
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        Auth::login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors(['loginname' => 'Invalid username or password.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function index()
    {
        $posts = Post::latest()->get();
        return view('homepage', ['posts' => $posts]);
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', ['posts' => $posts]);
    }
}
