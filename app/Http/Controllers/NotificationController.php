<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationController extends Controller
{
    public function show(Request $req)
    {
    	$notification=array();
    	$notification['unreadnotify']=User::find($req->user_id)->unreadNotifications->whereIn('type',['App\Notifications\CreateOrderNotification','App\Notifications\CheckOrdersNotification']); 
        // foreach ($notification['unreadnotify'] as $key => $value) {
        //     $notification['unreadnotify'][$key]['created_at']=$value['created_at']->diffForHumans();
        // }
    	//$notification['notify']=User::find($req->user_id)->notifications->forPage(0,50);
    	return response()->json($notification);
    }
    public function update(Request $req)
    {
    	User::find($req->user_id)->notifications->where('id',$req->id)->first()->delete();
        $notification['unreadnotify']=User::find($req->user_id)->unreadNotifications; 
        return response()->json($notification);
    }
    public function notifyUser(Request $req)
    {
        $notification=array();
        $notification['unreadnotify']=User::find($req->user_id)->unreadNotifications->where('type','App\Notifications\UserNotification'); 
        // foreach ($notification['unreadnotify'] as $key => $value) {
        //     $notification['unreadnotify'][$key]['created_at']=$value['created_at']->diffForHumans();
        // }
        //$notification['notify']=User::find($req->user_id)->notifications->forPage(0,50);
        return response()->json($notification);
    }
}
