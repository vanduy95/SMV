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
    public function convertnameinfo($str) {
    // In thường
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);    
    // In đậm
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
         return $str; // Trả về chuỗi đã chuyển
     } 
     public function index(){
        $userinfo = UserInfo::all();
        $user = User::all();
        $organization=Organization::all();
        return view('business.userinfo.index',compact('userinfo','user','organization'));
    }
    public function getcreate(){
        $groupuser = GroupUser::where('name','<>','Admin')->get();
        $organization = Organization::where('system','<>','0')->get();
        return view('business.userinfo.create',compact('groupuser','organization'));
    }
    public function postcreate(UserinfoRequest $request ,User $user,UserInfo $userinfo){
        // dd($request);
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
       $organization = Organization::where('system','<>','1')->get();
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
    $userinfo->user->delete();
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
        $datas=Excel::load(Input::file('upExcel'), function ($reader) {})->get();
        foreach($datas as $key => $rows)
        {
            // $equal_id = UserInfo::where('employee_id','=',$rows['ma_nhan_vien']==''?0:$rows['ma_nhan_vien'])->get()->count();
            // $equal_cmt = UserInfo::where('identitycard','=',$rows['chung_minh_thu']==''?0:$rows['chung_minh_thu'])->get()->count();
            // dd($rows['ma_nhan_vien']);
             if(!empty(str_replace(' ','',$rows['ma_nhan_vien']))  || !empty(str_replace(' ','',$rows['chung_minh_thu'])) ) {
                    // if($equal_id < 1 && $equal_cmt <1){
                $username =explode(" ",$this->convertnameinfo($rows['ho_va_ten']));
                $user =  new User();
                $user->username = (reset($username)).(end($username)).$rows['ma_nhan_vien'];
                $user->email = "";
                $user->password = Hash::make("password");
                $user->status = 0;
                $user->syslock = 1;
                $user->groupuser_id =2;
                $user->organization_id =$r->organization;
                $user->save();
                $userinfo = new UserInfo();
                $userinfo->user_id=$user->id;
                $userinfo->fullname = $rows['ho_va_ten'];
                $userinfo->employee_id = $rows['ma_nhan_vien'];
                $userinfo->identitycard = $rows['chung_minh_thu'];
                $userinfo->time_worked = $rows['so_thang_lam_viec'];
                $userinfo->number_account = $rows['so_tai_khoan'];
                $userinfo->salary = is_numeric(str_replace(['.',','],"",$rows['muc_luong']))?str_replace(['.',','],"",$rows['muc_luong']):0;
                $userinfo->assess_id = "3";
                $userinfo->save();
                // }
                // else{
                //     $error=[
                //         $rows['ma_nhan_vien'], $rows['ho_va_ten'],$rows['chung_minh_thu']
                //     ];
                // }
            }
        }
        // if(count($error) > 0){
        //     dd($error);
        // }
   }
   catch(\Exception $ex){
        echo $ex->getMessage()."</br>";
        echo "<a href='/admin/userinfo' class='col-lg-12'>Quay Lại Trang Danh Sách Khách Hàng</a>";
        die();
}
    \Session::flash('mess_userinfo','Tải lên danh sách thành công');
    return redirect('admin/userinfo');
}
public function downloadExcel(){
    Excel::create('Danh sách mẫu', function($excel)  {
                $excel->sheet('Sheet1', function($sheet)
                {
                    $sheet->fromArray('',null,'A1',false,false);
                    $headings=array('Mã nhân viên','Họ và tên','Số tài khoản','Mức lương','Số tháng làm việc','Chứng minh thư');
                    $sheet->prependRow(1, $headings);
                });
            })->download('xls');
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
