<?php

namespace App\Http\Requests;

use App\Rules\TokenRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|required_with:password_confirm|same:password_confirm|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'token' => ['required', new TokenRule()]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email khong duoc bo trong.',
            'email.email' => 'Email khong phu hop',
            'email.exists' => 'Email da ton tai',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.confirmed' => 'Bạn chưa nhập lại xác nhận mật khẩu',
            'password.min' => 'Tối thiểu nhập 8 ký tự',
            'password.regex' => 'Mật khẩu chứa ít nhất 8 ký tự, 1 in hoa, 1 in thường, và số',
            'password.required_with' => 'Vui lòng nhập lại mật khẩu',
            'password.same' => 'Mật khẩu không trùng khớp',
            'token.required' => 'Something went wrong' 
        ];
    }

    public function withValidator($validator)
    {
        if(!$validator->fails()){
            $validator->after(function ($validator) { 

                DB::beginTransaction();

                try {

                    $tokenData = DB::table('password_resets')->where('token', $this->token)->first();

                    $user = User::where('email', $tokenData->email)->first();
    
                    $user->password = Hash::make($this->password);
                    $user->update();
    
                    DB::table('password_resets')->where('email', $user->email)->delete();

                    DB::commit();

                }catch (Exception $e){
                    DB::rollback();
                    
                    return view('templates.samples.404');
                }


            });
        }
    }
}
