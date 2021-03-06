<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postOrganRequestComEdit extends FormRequest
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
        'name'=>'required|min:6|max:225',
        'city'=>'required|min:6|max:25',
        'addr'=>'required|min:10|max:225',
        'phone'=>'numeric|digits_between:10,13',
        'bank'=>'required|max:225',
        'bbranch'=>''
        ];
    }
    public function messages(){
        return [
        'name.min'=>'Tên công ty phải nhiều hơn 6 kí tự',
        'name.max'=>'Tên công ty phải ít hơn 225 kí tự',
        'name.required' =>'Xin vui lòng điền vào tên công ty',
        'city.required' =>'Xin vui lòng điền vào thành phố',
        'city.min'=>'Tên thành phố ít nhất có 6 kí tự',
        'city.max'=>'Tên thành phố phải ít hơn 25 kí tự',
        'addr.required'=>'Xin vui lòng điền vào địa chỉ công ty',
        'addr.min'=>'Địa chỉ công ty phải nhiều hơn 10 kí tự',
        'addr.max'=>'Đại chỉ công ty phải ít hơn 225 kí tự',
        'phone.digits_between'=>'Yêu cầu số điện thoại ít nhất phải là 10 chữ số và nhỏ hơn 13 chữ số',
        'phone.numeric'=>'Chỉ được phép nhập số ở ô này',
        'bank.required' =>'Xin vui lòng điền ngân hàng trả lương',
        'bank.max'=>'Tên ngân hàng phải ít hơn 225 kí tự'
        ];
    }
}
