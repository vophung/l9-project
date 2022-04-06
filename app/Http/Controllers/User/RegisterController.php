<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct() {
        $this->middleware('checkLogged')->only(['index', 'store']);
    }

    public function index() {
        return view('templates.pages.content.register');
    }

    public function store(RegisterRequest $request) {
        $data =  [
            'username' => $request->username,
            'email' => $request->email
        ];

        return view('mail.mail-sent-successfull')->with('data', $data);
    }

    public function verifyUser(Request $request)
    {
        $verification_code = $request->get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            return redirect()->route('login.index')->with(session()->flash('alert-success', 'Tai khoan cua ban da duoc xac minh'));
        }

        return redirect()->route('login.index')->with(session()->flash('alert-danger','Da co loi xay ra!'));
    }
}
