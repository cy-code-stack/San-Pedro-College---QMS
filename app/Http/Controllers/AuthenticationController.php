<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterStoreRequest;
// use Session;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function _construct()
    {
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 'Unverified') {
                return redirect()->route('unverified.dashboard');
            }elseif ($user->role == 'admin') {
                return redirect()->route('AdminDash');
            } else {
                switch ($user->usertype_id) {
                    case 1:
                        return redirect()->route('cashier.dashboard');
                    case 2:
                        return redirect()->route('assesor.dashboard');
                    case 3:
                        return redirect()->route('guard.dashboard');
                    case 4:
                        return redirect()->route('queuedisplay.dashboard');
                    default:
                        return redirect()->route('unverified.dashboard');
                }
            }
        } else {   
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'These credentials does not match.'
            ]);
        }
    }



    public function storeUser(RegisterStoreRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $data = $request->all();
        $response = User::create($data);
        if ($response) {
            // User creation was successful
            return response()->json([
                'status' => 'success',
                'redirect' => '/login',
            ], 200);
        } else {
            // User creation failed
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user.',
            ], 500);
        }
    }

    public function storeUserValidate(RegisterStoreRequest $request)
    {
    }


    public function forgotPassword()
    {
        return view('auth.forgotpassword');
    }

    public function logout(Request $request)
    {
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
