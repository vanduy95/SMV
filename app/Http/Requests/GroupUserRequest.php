<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUserRequest extends FormRequest
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
            'name'=>'required|min:3',
            'note'=>'required'
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Trường này không được để trống',
            'name.min'=>'Tên không hợp lệ',
            'note.required'=>'Trường này không được để trống'
        ];
    }
}
