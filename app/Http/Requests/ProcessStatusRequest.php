<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStatusRequest extends FormRequest
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
     'name'=>'required|unique:ProcessStatus,name',
     'value' => 'required|numeric|unique:ProcessStatus,value|max:127'
     ];
 }
 public function messages(){
    return [
    'name.required'=>'Vui lòng nhập tên',
    'name.unique'=>'Tên đã tồn tại',
    'value.required'=>'Vui lòng nhập giá trị',
    'value.numeric'=>'Giá trị chỉ được nhập số',
    'value.unique'=>'Giá trị đã tồn tại',
    'value.max'=>'Giá trị vượt quá giới hạn'
    ];
}
}
