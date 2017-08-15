<?php
namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Assess;
use App\UserInfo;
// use DB;
use App\GroupUser;
use Carbon\Carbon;
use App\Organization;
use App\Jobs\SendExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use League\Csv\Reader;
use App\Http\Requests\UserinfoRequest;
use App\Http\Requests\UpdateUserInfoRequest;


class UserInfoController extends Controller
{
    public function index(){
        $userinfo = UserInfo::all();
        $user = User::all();
        return view('business.userinfo.index',compact('userinfo','user'));
    }
    public function getcreate(){
        $groupuser = GroupUser::where('name','<>','Admin')->get();
        $organization = Organization::where('system','<>','0')->get();
        return view('business.userinfo.create',compact('groupuser','organization'));
    }
    public function postcreate(UserinfoRequest $request ,User $user,UserInfo $userinfo){
        $user = new User();
        $user->username = $request->username;
        $user->groupuser_id = $request->groupuser_id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->organization_id = $request->organization;
        $user->syslock = '1';
        $userinfo = new UserInfo();
        $userinfo->fullname = $request->fullname;
        $userinfo->employee_id= $request->employee_id;
        $userinfo->issuedby =$request->issuedby;
        $userinfo->dateissue= \Carbon\Carbon::parse($request->dateissue)->format('Y-m-d i');
        $userinfo->salary=(double)$request->salary;
        $userinfo->assess_id = $this->assess($request->assess);
        $userinfo->phone1=$request->phone1;
        $userinfo->phone2=$request->phone2;
        $userinfo->phone3=$request->phone3;
        $userinfo->phone4=$request->phone4;
        $userinfo->address1 = $request->address1;
        $userinfo->address2 = $request->address2;
        $userinfo->identitycard=$request->identitycard;
        $userinfo->maritalstatus=$request->marital;
        $userinfo->birthday=\Carbon\Carbon::parse($request->birthday)->format('Y-m-d i');
        $userinfo->sex=$request->sex;
        if($request->hasFile('filename1')){
            $path = 'uploadfile';
            $file = $request->file('filename1');
            $name = $file->getClientOriginalName();
            do{
                $filename1 = str_random(4)."_".$name;
            }while(file_exists("uploadfile/".$filename1));
            $file->move($path,$filename1);
            $userinfo->image1 = $filename1;    
        }
        else {
            $userinfo->image1="";
        }
        if($request->hasFile('filename2')){
            $path = 'uploadfile';
            $file = $request->file('filename2');
            $name = $file->getClientOriginalName();
            do{
                $filename2 = str_random(4)."_".$name;
            }while(file_exists("uploadfile/".$filename2));
            $file->move($path,$filename2);
            $userinfo->image2 = $filename2;    
        }
        else {
            $userinfo->image2="";
        }
        $user->save();
        $user->userinfo()->save($userinfo);
        \Session::flash('notify','Thêm người dùng thành công');
        return redirect()->route('indexuserinfo');
    }
    public function assess($scores){
        $assess = Assess::all();
        foreach ($assess as $key => $value) {
            if($scores>=$value->scoresfirst && $scores<=$value->scoreslast){
                $assess_id = $value->id;
            }
        }
        return $assess_id;
    }
    public function show($id){
     $userinfo = UserInfo::find($id);
     $user = User::find($userinfo->user_id);
     $groupuser = GroupUser::all();
     $organization = Organization::all();
     $assess = Assess::all();
         // return $userinfo;
     return view('business.userinfo.show',compact('userinfo','user','groupuser','organization','assess'));
 }

 public function update(UpdateUserInfoRequest $request, UserInfo $userinfo){
    $userinfo->fill($request->all());
    $userinfo->save();
    \Session::flash('notify','Sửa thông tin user thành công');

    return redirect()->route('indexuserinfo');
}

public function destroy($id){
    $userinfo = UserInfo::find($id);
    $userinfo->delete();
    \Session::flash('notify','Xóa thành công');
    return redirect()->route('indexuserinfo');

}
public function checkuser(){
    $user = User::all();
    if($user->count()==0){
        return $user->count();
    }
    else{
        return $user->last()->id;
    }
}
public function postcreateExcel(Request $r,User $user, UserInfo $userinfo){
    set_time_limit(1800);
    try{

     $file = $r->file('upExcel')->getRealPath();
     Excel::filter('chunk')->load($file)->chunk(5000, function($results)
     {
               // dd($results);
        foreach($results as $key=>$row)
        {

            foreach ($row as $key => $value) {
                $username =explode(" ",$value['ho_va_ten']);
                $user =  new User();
                $user->username = reset($username).end($username).$value['ma_nhan_vien'];
                $user->email = "";
                $user->password = Hash::make("password");
                $user->status = 0;
                $user->syslock = 1;
                $user->groupuser_id =2;
                $user->organization_id =2;
                $user->save();
                $userinfo = new UserInfo();
                $userinfo->user_id=$user->id;
                $userinfo->fullname = $value['ho_va_ten'];
                $userinfo->employee_id = $value['ma_nhan_vien'];
                $userinfo->salary =is_numeric(str_replace(".","",$value['muc_luong']))?str_replace(".","",$value['muc_luong']):0;
                $userinfo->assess_id = "3";
                $userinfo->save();
            }
        }

    });
 }

 catch(\Exception $ex){
    echo $ex->getMessage()."</br>";
    echo "<a href='/admin/user' class='col-lg-12'>Quay Lại Trang List User</a>";
}
}
public function AjaxcheckEmployee_id(Request $req)
{
    $userinfo=UserInfo::where('employee_id',$req->employee_id)->get();
    if(UserInfo::find($req->userinfo_id)->employee_id==$req->employee_id)
    {
        return 'true';
    }
    if($userinfo->count()==0)
    {
        return 'true';
    }
    else
    {
        return 'false';
    }
}

}
