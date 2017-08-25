<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetailsystemCreateRequest extends FormRequest
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
            'nameretail'=>'required|unique:retailsystem,nameretail',
        ];
    }
    public function messages(){
        return [
        'nameretail.unique'=>'Hệ thống đã tồn tại',
        'nameretail.required'=>'Vui lòng nhập tên',
        ];
    }
}
