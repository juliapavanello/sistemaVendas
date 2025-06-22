<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DAO\UserDAO;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view("/user/login");
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Session::put('user', UserDAO::getByEmail($request->email));

            return redirect()->intended('produtos');
        }
        return back()->withErrors([
            'email' => 'Credenciais erradas.',
        ])->onlyInput('email');
    }
}
