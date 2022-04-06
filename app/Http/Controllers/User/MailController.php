<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendRegisterMail($name, $email, $verification_code)
    {
        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];

        Mail::to($email)->send(new RegisterMail($data));
    } 

    public static function sendResetPasswordMail($email, $token)
    {
        $link = config('app.url') . ':8000' . '/password/reset/' . $token . '/email=' . urlencode($email);

        $data = [
            'email' => $email,
            'token' => $token,
            'link' => $link
        ];

        Mail::to($email)->send(new ResetPasswordMail($data));
    }
}
