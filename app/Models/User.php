<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_code',
        'is_verified',
        'google_id'
    ];
    
    public $incrementing = false; 

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info() {
        return $this->hasOne('App\Models\UserInfo');
    }

    public function cart() {
        return $this->hasMany('App\Models\Cart');
    }

    public static function loginWithAccount($data) {
        $user = User::where('email', $data['email'])->select('is_verified')->first();

        $credentials = ['email' => $data['email'], 'password' => $data['password'], 'is_verified' => 1];

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

    public static function loginWithGoogle($data) {
        $finduser = User::where('google_id', $data->id)->first();

        if(!$finduser) {
            return redirect()->route('login.index')->with('error','Tai khoan khong ton tai.');
        }else {
            if(Auth::login($finduser)){
                return redirect()->route('admin.index');
            }else {
                return redirect()->route('login.index')->with('error','Something went wrong.');
            }
        }
    }

    public static function loginWithFacebook($data) {
        $finduser = User::where('facebook_id', $data->id)->first();

        if(!$finduser) {
            return redirect()->route('login.index')->with('error','Tai khoan khong ton tai.');
        }else {
            if(Auth::login($finduser)){
                return redirect()->route('admin.index');
            }else {
                return redirect()->route('login.index')->with('error','Something went wrong.');
            }
        }
    }
}
