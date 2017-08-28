<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
Use App\UserInfo;
Use App\Organization;
use Notification;
use App\Notifications\UserNotification;
use DB;
class CheckUserController extends Controller
{
    public function list()
    {
        try{
            switch (Auth::user()->groupuser_id) {
                case 1:
                $user=User::whereIn('status',[4,3,2])->get();
                case 3:
                $user=User::where('status',4)->get();
                break;
                case 4:
                $user=User::where('status',3)->get();
                break;
                case 5:
                $user=User::where('status',2)->get();
                break;
                default:
                break;
            }
            return view('business.checkuser.index',compact('user'));
        }
        catch (Exception $e){
            return $e;
        }
        
    }
    public function show($id)
    {
       $user=User::find($id);
       $organization=Organization::all();
       switch (Auth::user()->groupuser_id) {
          case 1:
          if($user&&$user->status==4)
          {
            return view('business.checkuser.update.index',compact('user','organization'));
          }
          if($user&&$user->status==3)
          {
            return view('business.checkuser.accuracy.index',compact('user'));
          }
          if($user&&$user->status==2)
          {
            return view('business.checkuser.approval.index',compact('user'));
          }
          break;
          case 3:
          if($user&&$user->status==4)
          {
            return view('business.checkuser.update.index',compact('user','organization'));
          }
        else
        {
            \Session::flash('notify','Khách hàng đã được xử lý hoặc đã chuyển trạng thái');
            return redirect('admin/checkuser/list');
        }
        break;
        case 4:
        if($user&&$user->status==3)
        {
            return view('business.checkuser.accuracy.index',compact('user'));
        }
        else
        {
            \Session::flash('notify','Khách hàng đã được xử lý hoặc đã chuyển trạng thái');
            return redirect('admin/checkuser/list');
        }
        break;
        case 5:
        if($user&&$user->status==2)
        {
            return view('business.checkuser.approval.index',compact('user'));
        }
        else
        {
            \Session::flash('notify','Khách hàng đã được xử lý hoặc đã chuyển trạng thái');
            return redirect('admin/checkuser/list');
        }
        break;
        default:
        break;
    }

}
public function update(Request $req)
{
 $user=User::find($req->user_id);
 if($req->has('delete'))
 {
  $user->delete();
  \Session::flash('notify','Đã xóa khách hàng');
  return redirect('admin/checkuser/list');
}
$userinfo=UserInfo::find($req->userinfo_id);
$userinfo->employee_id=$req->employee_id;
$userinfo->user_id=$req->user_id;
$userinfo->fullname=$req->name;
$userinfo->address1=$req->address1;
$userinfo->address2=$req->address2;
$userinfo->dateissue=date('Y-m-d',strtotime(str_replace("/","-",$req->dateissue)));
$userinfo->salary=preg_replace("/[ đồng.,]/","",$req->salary);
$userinfo->issuedby=$req->issuedby;
$userinfo->phone1=$req->phone1;
$userinfo->phone2=$req->phone2;
$userinfo->phone3=$req->phone3;
$userinfo->birthday=date('Y-m-d',strtotime(str_replace("/","-",$req->birthday)));
$userinfo->sex=$req->sex;
$userinfo->identitycard=$req->identitycard;
$userinfo->note1=$req->note1;
$userinfo->note2=$req->note2;
$userinfo->time_worked=$req->time_work;
$userinfo->department=$req->department;
$userinfo->position=$req->position;
$userinfo->save();
$user->organization_id=$req->organization_id;
if($req->type=='approval')
{
  $user->status=2;
  $users=User::whereIn('groupuser_id',[5])->get();
  Notification::send($users, new UserNotification(Auth::user()->username.' đã yêu cầu phê duyệt thông tin khách hàng ',$user->userinfo));
  \Session::flash('notify','Khách hàng đã được chuyển cho người phê duyệt');
}
elseif($req->type=='accuracy')
{
  $user->status=3;
  $users=User::whereIn('groupuser_id',[4])->get();
  Notification::send($users, new UserNotification(Auth::user()->username.' đã yêu cầu xác thực thông tin khách hàng ',$user->userinfo));
  \Session::flash('notify','Khách hàng đã được chuyển cho người xác thực');
}
$user->save();
return redirect('admin/checkuser/list');
}
public function postAccuracy(Request $r)
{
   $user=User::find($r->user_id);
   $userinfo=UserInfo::find($r->userinfo_id);
   if($r->salary_day==null)
   {
     $userinfo->salary_day=1;
 }
 else
 {
    $userinfo->salary_day=$r->salary_day;
}
if(!$r->salary_avg==null)
{
    $userinfo->salary_avg=preg_replace("/[ đồng.]/","",$r->salary_avg);
    $userinfo->salary=preg_replace("/[ đồng.]/","",$r->salary_avg);
}
$userinfo->number_account=$r->number_account;
$userinfo->exchange_status=$r->exchange_status;
$userinfo->phone2=$r->phone2;
$userinfo->bank_name=$r->bank_name;
$userinfo->time_worked=$r->time_work;
$userinfo->save();
$user->status=2;
$user->save();
$users=User::whereIn('groupuser_id',[5])->get();
Notification::send($users, new UserNotification(Auth::user()->username.' đã yêu cầu phê duyệt Khách hàng ',$user->userinfo));
\Session::flash('notify','Xác thực thành công. Khách hàng đã chuyển cho người kiểm duyệt');
return redirect('admin/checkuser/list');
}
public function postApproval(Request $req)
{
 $user=User::find($req->user_id);
 if($req->has('approval'))
 {
    $user->status=0;
    $user->save();
    \Session::flash('notify','Duyệt thành công.');
    return redirect('admin/checkuser/list');
}
if($req->has('deactive'))
{
 $user->delete();
 \Session::flash('notify','Khách hàng đã bị từ chối.');
 return redirect('admin/checkuser/list');
}
if($req->has('accuracy'))
{
    $user->status=3;
    $user->note=$req->note_accuracy;
    $user->save();
    $users=User::whereIn('groupuser_id',[4])->get();
    Notification::send($users, new UserNotification(Auth::user()->username.' đã yêu cầu xác thực lại khách hàng ',$user->userinfo));
    \Session::flash('notify','Khách hàng đã được chuyển xác thực lại.');
    return redirect('admin/checkuser/list');
}
if($req->has('update'))
{
    $user->status=4;
    $user->note=$req->note_update;
    $user->save();
    $users=User::whereIn('groupuser_id',[3])->get();
    Notification::send($users, new UserNotification(Auth::user()->username.' đã yêu cầu cập nhập lại khách hàng ',$user->userinfo));
    \Session::flash('notify','Khách hàng đã được chuyển cập nhập lại.');
    return redirect('admin/checkuser/list');
}
}
public function checkidentitycard(Request $req)
{
    if($req->has('userinfo_id'))
    {
       $userinfo=UserInfo::find($req->userinfo_id);
       if($userinfo->identitycard==$req->identitycard)
       {
          return 'true';
      }
      else
      {
          $user=User::where(['status'=>0,'syslock'=>1])->pluck('id');
          $userinfos=UserInfo::whereIn('user_id',$user)->where('identitycard',$req->identitycard)->get();
          if(count($userinfos))
          {
             return 'false';
         }
         else
         {
             return 'true';
         }
     }
 }
 else
 {
    $user=User::where(['status'=>0,'syslock'=>1])->pluck('id');
    $userinfos=UserInfo::whereIn('user_id',$user)->where('identitycard',$req->identitycard)->get();
    if(count($userinfos))
    {
       return 'false';
   }
   else
   {
       return 'true';
   }
}
}

public function checkEmployee_id(Request $req)
{
   if($req->has('userinfo_id')){
    $userinfo=UserInfo::find($req->userinfo_id);
    if($userinfo->employee_id==$req->employee_id)
    {
      return 'true';
  }
  else{
    $user=User::where(['status'=>0,'syslock'=>1])->where('organization_id',$req->organization_id)->pluck('id');
    $userinfos=UserInfo::whereIn('user_id',$user)->where('employee_id',$req->employee_id)->get();
    if(count($userinfos))
    {
       return 'false';
   }
   else
   {
       return 'true';
   }
}
}
else{
    $user=User::where(['status'=>0,'syslock'=>1])->where('organization_id',$req->organization_id)->pluck('id');
    $userinfos=UserInfo::whereIn('user_id',$user)->where('employee_id',$req->employee_id)->get();
    if(count($userinfos))
    {
       return 'false';
   }
   else
   {
       return 'true';
   }
}
}
}
