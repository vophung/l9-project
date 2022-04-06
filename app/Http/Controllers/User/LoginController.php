<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session as FacadesSession;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('checkLogged')->only(['index','store']);
    }
    
    public function index() {
        return view('templates.pages.content.login');
    }

    public function store(LoginRequest $request) {

        $data = [
            'email' => $request->email,
            'password' => $request->password 
        ];

        if($request->has('rememberme')){
            Cookie::queue('email', $request->email, 1440);
            Cookie::queue('password', $request->password, 1440);
        }else {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }

        return User::loginWithAccount($data);
    }

    public function logout() {
        try {
            Auth::logout();

            return redirect()->route('login.index');
        }catch (Exception $e) {
            return view('templates.samples.404');
        }
    }
}
