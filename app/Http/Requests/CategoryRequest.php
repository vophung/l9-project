<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => ['required', 'max:50'],
            'metaTitle' => ['required', 'max:50']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng điền tiêu đề',
            'title.max' => 'Vui lòng không điền quá 50 ký tự',
            'metaTitle.required' => 'Vui lòng điền mô tả tiêu đề',
            'metaTitle.max' => 'Vui lòng không điền quá 50 ký tự',
        ];
    }
}
