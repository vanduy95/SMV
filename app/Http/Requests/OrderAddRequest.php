<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderAddRequest extends FormRequest
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
        if($this->request->get('pre_pay') == null && $this->request->get('select_rate') == null){
            $array=[
            'company' => 'required',
            'salary' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'identitycard' => 'required|numeric',
            'product'=>'required|max:225',
            'code_product'=>'required|max:50',
            'price'=>'required',
            'pre_pay'=>'required',
            'lead_month'=>'required|numeric|min:1|max:25',
            'market'=>'required',
            'select_city'=>'required',
            'select_dis'=>'required',
            'select_store'=>'required',
            ];
        }
        else if($this->request->get('pre_pay') != null || $this->request->get('select_rate') != null){
            $array=[
            'company' => 'required',
            'salary' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
            'identitycard' => 'required|numeric',
            'product'=>'required|max:225',
            'code_product'=>'required|max:50',
            'price'=>'required',
            'lead_month'=>'required|numeric|min:1|max:25',
            'market'=>'required',
            'select_city'=>'required',
            'select_dis'=>'required',
            'select_store'=>'required',
            ];
        }
        return $array;
    }
    
    public function messages(){
        if($this->request->get('pre_pay') == null && $this->request->get('select_rate') == null){
            $array=[
            'company.required' => 'Trường này không được để trống',
            'salary.required' => 'Trường này không được để trống',
            'fullname.required' => 'Trường này không được để trống',
            'address.required' => 'Trường này không được để trống',
            'phone.required' => 'Trường này không được để trống',
            'phone.numeric' => 'Trường này là sô',
            'identitycard.required' => 'Trường này không được để trống',
            'identitycard.numeric' => 'Trường này là sô',

            'price.required'=>'Yêu cầu nhập vào giá bán',
            'code_product.required'=>'Mã sản phẩm không được để trống',
            'code_product.min'=>'Mã sản phẩm phải nhiều hơn 3 kí tự',
            'code_product.max'=>'Mã sản phẩm phải ít hơn 50 kí tự',
            'product.required'=>'Tên sản phẩm không được để trống',
            'product.min'=>'Tên sản phẩm phải nhiều hơn 5 kí tự',
            'product.max'=>'Tên sản phẩm phải ít hơn 225 kí tự',
            'lead_month.required'=>'Tháng không được để trống',
            'lead_month.numeric'=>'Tháng chỉ được nhập số',
            'lead_month.min'=>'Tháng phải nhập nhiều hơn 1 số',
            'lead_month.max'=>'Tháng phải nhập ít hơn 24 tháng số',
            'market.required'=>'Siêu thị không được để trống',
            'select_city.required'=>'Thành phố không được để trống',
            'select_dis.required'=>'Quận huyện không được để trống',
            'select_store.required'=>'Cửa hàng không được để trống',
            'pre_pay.required'=>'Bạn phải nhập số tiên trả trước hoặc chọn tỉ lệ trả trước'
            ];
        }
        else if($this->request->get('pre_pay') != null || $this->request->get('select_rate') != null){
            $array=[
            'company.required' => 'Trường này không được để trống',
            'salary.required' => 'Trường này không được để trống',
            'salary.numeric' => 'Trường này là sô',
            'fullname.required' => 'Trường này không được để trống',
            'address.required' => 'Trường này không được để trống',
            'phone.required' => 'Trường này không được để trống',
            'phone.numeric' => 'Trường này là sô',
            'identitycard.required' => 'Trường này không được để trống',
            'identitycard.numeric' => 'Trường này là sô',
            'price.required'=>'Yêu cầu nhập vào giá bán',

            'code_product.required'=>'Mã sản phẩm không được để trống',
            'code_product.min'=>'Mã sản phẩm phải nhiều hơn 3 kí tự',
            'code_product.max'=>'Mã sản phẩm phải ít hơn 50 kí tự',
            'product.required'=>'Tên sản phẩm không được để trống',
            'product.min'=>'Tên sản phẩm phải nhiều hơn 5 kí tự',
            'product.max'=>'Tên sản phẩm phải ít hơn 225 kí tự',
            'lead_month.required'=>'Tháng không được để trống',
            'lead_month.numeric'=>'Tháng chỉ được nhập số',
            'lead_month.min'=>'Tháng phải nhập nhiều hơn 1 số',
            'lead_month.max'=>'Tháng phải nhập ít hơn 24 tháng số',
            'market.required'=>'Siêu thị không được để trống',
            'select_city.required'=>'Thành phố không được để trống',
            'select_dis.required'=>'Quận huyện không được để trống',
            'select_store.required'=>'Cửa hàng không được để trống',
            ];
        }
        return $array;
    }
}
