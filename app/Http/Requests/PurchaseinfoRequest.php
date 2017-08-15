<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseinfoRequest extends FormRequest
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
        'id_com'=>'required|numeric',
        'cmt'=>'required_without:code',
        'code'=>'required_without:cmt',
        ];
    }
    public function messages(){
        return [
        'id_com.required'=>'Công ty không được để trống',
        'id_com.numeric'=>'ID của công ty là số',
        'cmt.required_without'=>'Nhập mã số chứng minh nhân dân hoặc mã nhân viên',
        'code.required_without'=>'Nhập mã nhân viên hoặc mã số chứng minh nhân dân',
        ];
    }
}
