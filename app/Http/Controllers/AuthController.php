<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $res = $this->authService->login($request->email, $request->password);
        if ($res['success']) {
            return redirect()->route('home')->with('success', 'Berhasil Login');
        }

        return redirect()->back()->with('error', array_values($res['errors'])[0] ?? 'Gagal Login');
    }

    public function register()
    {
        if (auth()->check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $res = $this->authService->register($data);
        if ($res['success']) {
            return redirect('/login')->with('success', 'Berhasil membuat user');
        }

        return redirect()->back()->with('error', array_values($res['errors'])[0] ?? 'Gagal membuat user');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
