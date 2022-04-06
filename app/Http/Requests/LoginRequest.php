<?php

namespace App\Http\Requests;

use App\Rules\CheckLoginSocialiteRule;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required'],
            'password' => ['required', new CheckLoginSocialiteRule(), new PasswordRule()]
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Bạn chưa nhập Email.',
            'password.required' => 'Bạn chưa nhập Password.'
        ];
    }
}
