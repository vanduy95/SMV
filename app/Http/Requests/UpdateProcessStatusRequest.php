<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessStatusRequest extends FormRequest
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
        $processstatus = $this->route('processstatus');
        return [
        'name'=>'required|unique:ProcessStatus,name,'.$processstatus->id,
        'value'=>'required|numeric|max:127|unique:ProcessStatus,value,'.$processstatus->id
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
