<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanStatusRequest extends FormRequest
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
        $loanstatus = $this->route('loanstatus');
        return [
        'name'=>'required|max:255|min:3|unique:LoanStatus,name,'.$loanstatus->id,
        'value' => 'required|numeric|unique:LoanStatus,value,'.$loanstatus->id
        ];
    }
    public function messages(){
        return [
        'name.required'=>'Bạn chưa nhập tên',
        'name.max'=>'Tên sản phẩm có độ dài đến 255 ký tự',
        'name.min'=>'Tên sản phẩm có độ dài từ 3 ký tự',
        'value.required'=>'Bạn chưa nhập giá trị',
        'value.numeric'=>'Giá trị chỉ được nhập số',
        'name.unique'=>'Tên đã tồn tại',
        'value.unique'=>'Giá trị đã tồn tại'
        ];
    }
}
