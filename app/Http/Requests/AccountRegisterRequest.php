<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRegisterRequest extends FormRequest
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
        if($this->request->get('ctv')!=null){
            $array= [
            'username'=>'required|unique:user,username|min:5|max:255',
            'email'=>'required|unique:user,email',
            'password'=>'required|min:6|max:255',
            'phone'=>'required',
            'fullname'=>'required',
            'address'=>'required',
            ];
        }
        else if($this->request->get('dt')!=null){
            $array= [
            'usernamedt'=>'required|unique:user,username|min:5|max:255',
            'emaildt'=>'required|unique:user,email',
            'passworddt'=>'required|min:6|max:255',
            'phonedt'=>'required',
            'select_market'=>'required',
            'select_city'=>'required',
            'select_dis'=>'required',
            'select_store'=>'required',
            'fullnamedt'=>'required',
            'addressdt'=>'required',
            ];
        }
        return $array;
    }
    public function messages(){
        if($this->request->get('group')==1){
            $array= [
            'username.required'=>'Vui lòng nhập tên người dùng',
            'username.unique'=>'Tên người dùng đã tồn tại',
            'username.min'=>'Tên người dùng phải từ 5 ký tự',
            'username.max'=>'Tên người dùng vượt quá ký tự cho phép',
            'email.required'=>'Vui lòng nhập email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu phải từ 6 ký tự',
            'password.max'=>'Mật khẩu vượt quá ký tự cho phép',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'fullname'=>'Vui lòng nhập tên',
            'address'=>'Vui lòng nhập địa chỉ',
            ];
        }
        else{
            $array= [
            'select_market.required'=>'Siêu thị không được để trống',
            'select_city.required'=>'Thành phố không được để trống',
            'select_dis.required'=>'Quận/Huyện không được để trống',
            'select_store.required'=>'Cửa hàng không được để trống',
            'usernamedt.required'=>'Vui lòng nhập tên người dùng',
            'usernamedt.unique'=>'Tên người dùng đã tồn tại',
            'usernamedt.min'=>'Tên người dùng phải từ 5 ký tự',
            'usernamedt.max'=>'Tên người dùng vượt quá ký tự cho phép',
            'emaildt.required'=>'Vui lòng nhập email',
            'emaildt.unique'=>'Email đã tồn tại',
            'passworddt.required'=>'Vui lòng nhập mật khẩu',
            'passworddt.min'=>'Mật khẩu phải từ 6 ký tự',
            'passworddt.max'=>'Mật khẩu vượt quá ký tự cho phép',
            'phonedt.required'=>'Vui lòng nhập số điện thoại',
            ];
        }
        return $array;
    }
}
