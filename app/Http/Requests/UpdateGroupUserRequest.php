<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupUserRequest extends FormRequest
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
        $groupuser= $this->route('groupuser');
        return [
        'name'=>'required|min:3|unique:groupuser,name,'.$groupuser->id,
        'note'=>'required'
        ];
    }
    public function messages(){
        return [
        'name.unique'=>'Tên đã tồn tại',
        'name.required'=>'Vui lòng nhập tên',
        'name.min'=>'Tên không hợp lệ',
        'note.required'=>'Trường này không được để trống'
        ];
    }
}
