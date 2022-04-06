<?php

namespace App\Http\Requests;

use App\Jobs\PasswordForgotJob;
use App\Rules\EmailRule;
use App\Rules\VerifiedRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPassRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', new EmailRule(), new VerifiedRule()],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không phù hợp',
            'email.max' => 'Email không hợp lệ',
        ];
    }

    public function withValidator($validator)
    {
        if(!$validator->fails()){
            $validator->after(function ($validator) {
        
                DB::beginTransaction();
    
                try {
                    DB::table('password_resets')->insert([
                        'email' => $this->email,
                        'token' => Str::random(60),
                        'created_at' => Carbon::now()
                    ]);
        
                    DB::commit();
    
                    $tokenData = DB::table('password_resets')->where('email', $this->email)->latest()->first();
    
                    PasswordForgotJob::dispatch([
                        'email' => $this->email,
                        'token' => $tokenData->token
                    ]);
    
                }catch (Exception $e) {
                    DB::rollBack();
                    
                    return view('templates.samples.404');
                }
            });
        }
    }
}
