<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout_system(Request $request)
    {
        Auth::logout();

        // invalidate the current session
        $request->session()->invalidate();

        // regenerate csrf token
        $request->session()->regenerateToken();

        // show success msg and redirect to login page
        Flasher::addSuccess('Logged out successfully.');
        return redirect()->route('login');
    }
}
