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
        'email'=>'required|unique:User|email',
        'password'=>'required|min:6|max:255',
        'password_confirmation'=>'required|max:255|same:password',
        'status'=>'required',
        'sex'=>'required',
        'salary'=>'required|numeric|max:99999999|min:2999999',
        'organization'=>'required',
        'fullname'=>'required|min:6|max:225',
        'birthday'=>'required',
        'identitycard'=>'required|numeric',
        'assess'=>'numeric',
        'issuedby'=>'required|min:6|max:225',
        'dateissue'=>'required',
        'employee_id'=>'required|min:3|max:20',
        'phone1'=>'required|numeric',
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
        'email.email'=>'Email không đúng định dạng',
        'password.required'=>'Vui lòng nhập mật khẩu',
        'password.min'=>'Mật khẩu phải từ 6 ký tự',
        'password.max'=>'Mật khẩu vượt quá ký tự cho phép',
        'password_confirmation.max'=>'Mật khẩu xác minh vượt quá ký tự cho phép',
        'password_confirmation.confirmed'=>'Mật khẩu xác minh không chính xác',
        'password_confirmation.required'=>'Vui lòng nhập mật khẩu xác minh',
        'status.required'=>'Vui lòng chọn trạng thái',
        'fullname.required'=>'Vui lòng nhập nhập họ và tên',
        'fullname.min'=>'Họ và tên phải nhiều hơn 6 ký tự',
        'fullname.max'=>'Họ và tên phải ít hơn 225 ký tự',
        'salary.required'=>'Vui lòng nhập nhập số lương',
        'salary.numeric'=>'Lương chi được nhập vào là số',
        'salary.min'=>'Lương của khách hàng không được nhỏ hơn 3 triệu',
        'salary.max'=>'Lương của khách hàng không được lớn hơn 100 triệu',
        'birthday.required'=>'Vui lòng nhập nhập ngày sinh ',
        'sex.required'=>'Vui lòng nhập nhập giới tính',
        'organization.required'=>'Bạn phải chọn tổ chức',
        'employee_id.required'=>'Bạn chưa điền mã nhân viên',
        'employee_id.min'=>'Mã nhân viên không được ít hơn 3 ký tự',
        'employee_id.max'=>'Mã nhân viên không được nhiều hơn 20 ký tự',
        'identitycard.required'=>'Vui lòng nhập nhập số chứng minh nhân dân',
        'identitycard.numeric'=>'Số chứng minh không đúng định dạng',
        'assess.numeric'=>'Bạn chỉ được nhập số',
        'issuedby.required'=>'Nơi cấp không được để trống',
        'issuedby.min'=>'Nơi cấp không được ít hơn 6 ký tự',
        'issuedby.max'=>'Nơi cấp không được ít hơn 225 ký tự',
        'phone1.required'=>'Số điện thoại không được để trống',
        'phone1.numeric'=>'Định dạng số điện thoại chưa đúng!!!',
        'dateissue.required'=>'Ngày cấp không được để trống!!!',
        // 'phone1.max'=>'Định dạng số điện thoại chưa đúng!!!',
        ];
    }
}
