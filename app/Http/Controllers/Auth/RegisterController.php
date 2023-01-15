<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.register');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
