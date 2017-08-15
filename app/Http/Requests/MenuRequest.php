<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name'=>'required|min:3|max:50|unique:menu,name',
            'parent_id'=>'required|numeric',
            'order'=>'required|numeric'
        ];
    }
    public function messages(){
        return [
        'name.unique'=>'Tên đã tồn tại',
        'name.required'=>'Vui lòng nhập tên',
        'name.min'=>'Tên từ 3 ký tự',
        'name.max'=>'Giới hạn ký tự là 50',
        'parent_id.required'=>'Trường này không được để trống',
        'parent_id.numeric'=>'Trường này chỉ được nhập số',
        'order.required'=>'Trường này không được để trống',
        'order.numeric'=>'Trường này chỉ được nhập số'
        ];
    }
}
