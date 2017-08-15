<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoanRequest extends FormRequest
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
            'product_id'=>'required',
            'processstatus_id'=>'required',
            'loanamount'=>'required|numeric',
            'interestrate'=>'required|numeric|max:50',
            'startdate'=>'required|date|before:enddate',
            'enddate'=>'required|date|after:startdate',
        ];
    }
    public function messages(){
        return[
            'product_id.required'=>'Trường này không được để trống',
            'processstatus_id.required'=>'Trường này không được để trống',
            'loanamount.required'=>'Trường này không được để trống',
            'loanamount.numeric'=>'Trường này chỉ được nhập số',
            'interestrate.numeric'=>'Trường này chỉ được nhập số',
            'interestrate.required'=>'Trường này không được để trống',
            'startdate.required'=>'Trường này không được để trống',
            'startdate.date'=>'Trường này là ngày tháng',
            'startdate.before'=>'Ngày không hợp lệ',
            'enddate.after'=>'Ngày không hợp lệ',
            'enddate.date'=>'Trường này là ngày tháng',
            'enddate.required'=>'Trường này không được để trống',
        ];
    }
}
