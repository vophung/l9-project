<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => ['required'],
            'price' => ['required','max:16'],
            'discount' => ['max:16'],
            'sumary' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền tiêu đề',
            'price.required' => 'Vui lòng điền gia tien',
            'price.max' => 'Toi da 16 don vi',
            'discount.max' => 'Toi da 16 don vi',
            'sumary.required' => 'Vui lòng điền so luoc ve san pham',
        ];
    }
}
