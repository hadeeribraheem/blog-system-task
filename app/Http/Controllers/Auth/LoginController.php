<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // validate the data that user entered
        $data = $request->validated();

        // authenticate user with the data he entered , --> if success flash a success msg and redirect to his dashboard
        if (Auth::attempt($data)) {
            Flasher::addSuccess('Welcome back!');
            return redirect()->route('dashboard');
        }

        //--> if authentication failed , flash a error msg and redirect back with old input
        Flasher::addError('Invalid credentials. Please try again.');
        return back()->withInput();
    }
}
