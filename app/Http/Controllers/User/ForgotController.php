<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPassRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ForgotController extends Controller
{
    use CanResetPassword;

    public function index() {
        return view("templates.pages.content.forgot");
    }

    public function reset($token, $email) {
        $data = ['email' => $email, 'token' => $token];

        return view('templates.pages.content.reset')->with('data', $data);
    }

    public function email(ForgotPassRequest $request) {
       return redirect()->back()->with('status','A reset link has been sent to your email address.');
    }

    public function update(ResetPasswordRequest $request) {
        $user = User::where('email', $request->email)->select('is_verified')->first();

        $credentials = ['email' => $request->email, 'password' => $request->password, 'is_verified' => 1];

        if(!$user) {
            return redirect()->route('login.index')->with('error','Tai khoan khong ton tai.');
        }else {
            if(Auth::attempt($credentials)){
                return redirect()->route('admin.index');
            }else if($user->is_verified != 1){
                return redirect()->route('login.index')->with('error','Tai khoan chua xac minh.');
            }
        }
    }
}
