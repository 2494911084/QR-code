<?php

namespace App\Http\Requests\Api;

class FileViewLogRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'r_name' => 'required',
            'phone' => 'required',
            'file_img_url' => 'required',
            'code' => 'required'
        ];
    }
}
