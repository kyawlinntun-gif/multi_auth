<?php

namespace App\Http\Controllers\AuthAdmin;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm()
    {
        return view('auth_admin.register');
    }

    public function Register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:admins,email|max:25',
            'password' => 'required|min:5|max:8|confirmed'
        ]);
        
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        Auth::guard('admin')->login($admin);

        return redirect()->intended(route('admin.home'));
    }

}
