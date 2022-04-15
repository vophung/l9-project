<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        return User::loginWithGoogle($user);
    }

    public function redirectFB() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFB() {
        dd('learning');
        // $user = Socialite::driver('facebook')->user();

        // $this->_registerOrLoginUserFB($user);

        // return User::loginWithFacebook($user);
    }

    protected function _registerOrLoginUserFB($data) {

        DB::beginTransaction();

        try {
            $user = User::where('email', $data->email)->first();

            // return $user;

            if(!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->google_id = $data->id;
                $user->is_verified = 1;
                $user->save();
            }else {
                User::where(['email' => $data->email])->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'facebook_id' => $data->id,
                    'is_verified' => 1,
                    'password' => null
                ]);    
            }


            DB::commit();

        }catch (Exception $e) {
            DB::rollback();

            return view('templates.samples.404');
        }
    }

    protected function _registerOrLoginUser($data) {

        DB::beginTransaction();

        try {
            $user = User::where('email', $data->email)->first();

            if(!$user) {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->google_id = $data->id;
                $user->is_verified = 1;
                $user->save();
            }else {
                User::where(['email' => $data->email])->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'google_id' => $data->id,
                    'is_verified' => 1,
                    'password' => null
                ]);    
            }

            DB::commit();

        }catch (Exception $e) {
            DB::rollback();

            return view('templates.samples.404');
        }
    }
}
