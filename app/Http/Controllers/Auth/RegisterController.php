<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUserInfoRequest;
use App\Repositories\UserRepositoryInterface;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(SaveUserInfoRequest $request)
    {
        $data= $request->validated();
        $data['password'] = Hash::make($data['password']);
        $this->userRepo->saveUser($data);

        Flasher::addSuccess('Account created successfully.');
        return redirect()->route('home');
    }
}
