<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->request->get('syslock') != 1){
            $array=[
            'groupuser_id'=>'required',
            'username'=>'required|unique:user,username|min:5|max:255',
            'email'=>'required|unique:user,email',
            'password'=>'required|min:6|max:255',
            'password_confirmation'=>'required|max:255|same:password',
            'status'=>'required',
            'syslock'=>'numeric',
            'organization'=>'required',
            ];
        }
        if($this->request->get('syslock') == 1){
            $array=[
            'groupuser_id'=>'required',
            'username'=>'required|unique:User,username|min:5|max:255',
            'email'=>'required|unique:User,email',
            'password'=>'required|min:6|max:255',
            'password_confirmation'=>'required|max:255|same:password',
            'status'=>'required',
            'syslock'=>'numeric',
            'firstname'=>'required|min:3|max:255',
            'lastname'=>'required|min:3|max:255',
            'address'=>'min:3|max:255',
            'salary'=>'required',
            'marital'=>'required',
            'birthday'=>'required',
            'phone'=>'required',
            'sex'=>'required',
            'identitycard'=>'required|numeric|min:11',
            'assess'=>'numeric',
            ];
        }
        return $array;
    }
    public function messages(){
        $array=[
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
        'organization'=>'Vui lòng chọn tổ chức'
        ];
        if($this->request->get('syslock') == 1){
            $array=[
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
            'firstname.required'=>'Vui lòng nhập nhập họ',
            'firstname.min'=>'Họ phải từ 3 ký tự',
            'firstname.'=>'Họ vượt quá ký tự cho phép',
            'lastname.required'=>'Vui lòng nhập nhập tên',
            'lastname.min'=>'Tên phải từ 3 ký tự',
            'lastname.'=>'Tên vượt quá ký tự cho phép',
            'address.required'=>'Vui lòng nhập nhập địa chỉ',
            'address.min'=>'Địa chỉ phải từ 3 ký tự',
            'address.max'=>'Địa chỉ vượt quá ký tự cho phép',
            'salary.required'=>'Vui lòng nhập nhập số lương',
            'phone.required'=>'Vui lòng nhập nhập số điện thoại ',
            'marital.required'=>'Vui lòng nhập tình trạng hôn nhân ',
            'birthday.required'=>'Vui lòng nhập nhập ngày sinh ',
            'sex.required'=>'Vui lòng nhập nhập giới tính',
            'identitycard.required'=>'Vui lòng nhập nhập số chứng minh nhân dân',
            'identitycard.min'=>'Số chứng minh nhân dân không đúng',
            'identitycard.numeric'=>'Số chứng minh nhân dân không đúng',
            'assess'=>'Trường này là số',
            ];
        }
        return $array;
    }
}
