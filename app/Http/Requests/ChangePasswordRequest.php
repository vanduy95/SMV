<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'passwordold'=>'required|min:6|max:30',
            'passwordnew'=>'required|min:6|max:30',
            'password_confirmation'=>'required|min:6|max:30|same:passwordnew',
        ];
    }

     public function messages(){
        return [
            'passwordold.required'=>'Mật khẩu cũ không được để trống',
            'passwordold.min'=>'Mật khẩu cũ phải từ 6->30 kí tự',
            'passwordold.max'=>'Mật khẩu cũ phải từ 6->30 kí tự',
            'passwordnew.required'=>'Mật khẩu mới không được để trống',
            'passwordnew.min'=>'Mật khẩu mới phải từ 6->30 kí tự',
            'passwordnew.max'=>'Mật khẩu mới phải từ 6->30 kí tự',
            'password_confirmation.required'=>'Xác nhận mật khẩu không được để trống',
            'password_confirmation.min'=>'Xác nhận mật khẩu phải từ 6->30 kí tự',
            'password_confirmation.max'=>'Xác nhận mật khẩu từ 6->30 kí tự',
            'password_confirmation.same'=>'Mật khẩu không khớp',
        ];
    }
}
