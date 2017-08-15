<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        $array=[
        'groupuser_id'=>'required',
        'username'=>'required|min:5|max:255|unique:User,username,'.$user->id,
        'email'=>'required|unique:User,email,'.$user->id,
        'status'=>'required',
        'syslock'=>'numeric'
        ];
        if($this->request->get('syslock') == 1){
            $array=[
            'firstname'=>'required|min:3|max:255',
            'lastname'=>'required|min:3|max:255',
            'address'=>'required|min:3|max:255',
            'salary'=>'required|numeric',
            'phone'=>'required|numeric|min:9',
            'marital'=>'required',
            'birthday'=>'required',
            'sex'=>'required',
            'identitycard'=>'required|numeric|min:11'
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
        'status.required'=>'Vui lòng chọn trạng thái',
        ];
        if($this->request->get('syslock') == 1){
            $array=[
            'firstname.required'=>'Vui lòng nhập nhập họ',
            'firstname.min'=>'Họ phải từ 3 ký tự',
            'firstname.'=>'Họ vượt quá ký tự cho phép',
            'lastname.required'=>'Vui lòng nhập nhập tên',
            'lastname.min'=>'Tên phải từ 3 ký tự',
            'lastname.'=>'Tên vượt quá ký tự cho phép',
            'address.required'=>'Vui lòng nhập nhập địa chỉ',
            'address.min'=>'Địa chỉ phải từ 3 ký tự',
            'address.'=>'Địa chỉ vượt quá ký tự cho phép',
            'salary.required'=>'Vui lòng nhập nhập số lương',
            'salary.'=>'Số lương không đúng',
            'phone.required'=>'Vui lòng nhập nhập số điện thoại ',
            'phone.min'=>'Số điện thoại không đúng',
            'phone.numeric'=>'Số điện thoại không đúng',
            'marital.required'=>'Vui lòng nhập tình trạng hôn nhân ',
            'birthday.required'=>'Vui lòng nhập nhập ngày sinh ',
            'sex.required'=>'Vui lòng nhập nhập giới tính',
            'identitycard.required'=>'Vui lòng nhập nhập số chứng minh nhân dân',
            'identitycard.min'=>'Số chứng minh nhân dân không đúng',
            'identitycard.numeric'=>'Số chứng minh nhân dân không đúng',
            ];
        }
        return $array;
    }
}
