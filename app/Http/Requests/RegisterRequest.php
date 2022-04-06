<?php

namespace App\Http\Requests;

use App\Http\Controllers\User\MailController;
use App\Jobs\SendMailJob;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class RegisterRequest extends FormRequest
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
            'username' => 'required|max:55|regex:/[\sA-Za-z0-9\p{L}]$/',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|required_with:password_confirm|same:password_confirm|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            // 'password_confirm' => 'min:8'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng điền tên',
            'username.max' => 'Tên tối đa 55 ký tự',
            'username.regex' => 'Tên không được chứa những kí tự đặc biệt',
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không phù hợp',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.confirmed' => 'Bạn chưa nhập lại xác nhận mật khẩu',
            'password.min' => 'Tối thiểu nhập 8 ký tự',
            'password.regex' => 'Mật khẩu chứa ít nhất 8 ký tự, 1 in hoa, 1 in thường, và số',
            'password.required_with' => 'Vui lòng nhập lại mật khẩu',
            'password.same' => 'Mật khẩu không trùng khớp',
            // 'password_confirm.min' => 'Ít nhất 8 ký tự'
        ];
    }

    public function withValidator($validator)
    {
        if(!$validator->fails()){
            $validator->after(function ($validator) {

                DB::beginTransaction();
    
                try {
                    $user = new User();
                    $user->name = $this->username;
                    $user->email = $this->email;
                    $user->password = bcrypt($this->password);
                    $user->verification_code = sha1(time());
                    $user->save();
                    
                    SendMailJob::dispatch([
                        'username' => $this->username, 
                        'email' => $this->email, 
                        'verification_code' => $user->verification_code
                    ]);
    
                    DB::commit();
                }catch (Exception $e){
                    DB::rollback();
                    return view('templates.samples.404');
                }
            });
        }
    }
}
