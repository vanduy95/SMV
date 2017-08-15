<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUploadFileRequest extends FormRequest
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
            'filename'=>'',
            'lb_market'=>'required',
            'lb_dis'=>'required',
            'lb_city'=>'required',
            'lb_store'=>'required',
        ];
        
    }
    public function messages(){
        return [
        // 'filename.required'=>'Bạn chưa chọn file'
        ];
    }
}
