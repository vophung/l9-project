<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'mobile' => ['required'],
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/'
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'Vui long dien sdt',
            'mobile.regex' => 'Vui long dien so',
            'mobile.not_regex' => 'Khong duoc dien ky tu',
            'mobile.min' => 'Sdt co it nhat 9 chu so',
            'address.required' => 'Vui long dien dia chi',
            'address.regex' => 'Vui long nhap dung dia chi',
        ];
    }
}
