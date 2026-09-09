<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $loginAction;

    public function __construct(LoginAction $loginAction)
    {
        $this->loginAction = $loginAction;
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $success = $this->loginAction->execute(
            $request->username,
            $request->password
        );

        if (!$success) {
            return back()
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}