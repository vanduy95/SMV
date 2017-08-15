<?php

namespace App\Http\Middleware;

use Closure;

class ReplaceOrdersMidd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request){
            $search=['.',' đ'];
            $buy = str_replace($search,"",$request->buy);
            $price = str_replace($search,"",$request->price);
            $pp = str_replace($search,"",$request->pre_pay);
            if($buy==0 && $price==0 && $pp==0){
                \Session::flash('mess_buy','Nhập vào là số và không có chữ trong dãy!!!');
                \Session::flash('mess_price','Nhập vào là số và không có chữ trong dãy!!!');
                \Session::flash('mess_pp','Nhập vào là số và không có chữ trong dãy!!!');
                return back();
            }else{
               return $next($request);
           }
           if(!empty($request->dis) || !empty($request->city) || !empty($request->market)){
            return redirect()->route('redirectAjax');
        } 
    }
 }
}
