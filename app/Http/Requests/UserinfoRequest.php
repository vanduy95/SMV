<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserinfoRequest extends FormRequest
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
        'groupuser_id'=>'required',
        'username'=>'required|unique:User,username|min:5|max:255',
        'email'=>'required|unique:User,email',
        'password'=>'required|min:6|max:255',
        'password_confirmation'=>'required|max:255|same:password',
        'status'=>'required',
        'organization'=>'required',
        'fullname'=>'required',
        'birthday'=>'required',
        'identitycard'=>'required|numeric',
        'assess'=>'numeric',
        'issuedby'=>'required',
        'dateissue'=>'required',
        'employee_id'=>'required',
        'phone1'=>'required',
        ];
    }
    public function messages(){
        return [
        'groupuser_id.required'=>'Vui lòng chọn nhóm người dùng',
        'username.required'=>'Vui lòng nhập tên người dùng',
        'username.unique'=>'Tên người dùng đã tồn tại',
        'username.min'=>'Tên người dùng phải từ 5 ký tự',
        'username.max'=>'Tên người dùng vượt quá ký tự cho phép',
        'email.required'=>'Vui lòng nhập email',
        'email.unique'=>'Email đã tồn tại',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'password.min'=>'Mật khẩu phải từ 6 ký tự',
        'password.max'=>'Mật khẩu vượt quá ký tự cho phép',
        'password_confirmation.max'=>'Mật khẩu xác minh vượt quá ký tự cho phép',
        'password_confirmation.confirmed'=>'Mật khẩu xác minh không chính xác',
        'password_confirmation.required'=>'Vui lòng nhập mật khẩu xác minh',
        'status.required'=>'Vui lòng chọn trạng thái',
        'fullname.required'=>'Vui lòng nhập nhập họ',
        'salary.required'=>'Vui lòng nhập nhập số lương',
        'birthday.required'=>'Vui lòng nhập nhập ngày sinh ',
        'sex.required'=>'Vui lòng nhập nhập giới tính',
        'identitycard.required'=>'Vui lòng nhập nhập số chứng minh nhân dân',
        'identitycard.min'=>'Số chứng minh nhân dân không đúng',
        'assess'=>'Trường này là số',
        ];
    }
}
