<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordEmployee extends FormRequest
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
            'username'=>'required|min:5|max:255',
            'password'=>'required|min:6|max:255',
            're_password'=>'required|min:6|max:255',
            '_token'=>''
        ];
    }
    public function messages(){
       return[
           'username.required'=>'Vui lòng nhập vào tài khoản',
           'password.required'=>'Mật khẩu không được để trống',
           're_password.required'=>'Nhập lại mật khẩu không được để trống',
           'username.min'=>'Tài khoản phải nhiều hơn 5 ký tự',
           'username.max'=>'Tài khoản phải nhỏ hơn 255 ký tự',
           'password.min'=>'Mật khẩu phải dài hơn 6 ký tự',
           'password.max'=>'Mật khẩu ít hơn 255 ký tự',
           're_password.min'=>'Nhập lại mật khẩu phải nhiều hơn 5 ký tự',
           're_password.max'=>'Nhập lại mật khẩu phải ít hơn 255 ký tự'
        ];
    }
}
