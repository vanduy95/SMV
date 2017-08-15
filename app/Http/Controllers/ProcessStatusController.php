<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcessStatus;
use App\Http\Requests\ProcessStatusRequest;
use App\Http\Requests\UpdateProcessStatusRequest;

class ProcessStatusController extends Controller
{
    public function index(){
    	$processstatus = ProcessStatus::all();
    	return view('business.processstatus.index',compact('processstatus'));
    }
    public function getcreate(){
        return view('business.processstatus.create');
    }
    public function postcreate(ProcessStatusRequest $request){
    	ProcessStatus::create($request->all());
        \Session::flash('notify','Thêm thành công');
        return redirect()->route('indexprocess');
    }
    public function show($id){
    	$processstatus = ProcessStatus::find($id);
    	return view('business.processstatus.show',compact('processstatus'));
    }
    public function update(UpdateProcessStatusRequest $request,ProcessStatus $processstatus){
    	$processstatus->fill($request->all());
    	$processstatus->save();
        \Session::flash('notify','Sửa thành công');
        return redirect()->route('indexprocess');

    }
    public function destroy($id){
    	$processstatus = ProcessStatus::find($id);
    	$processstatus->delete();
        \Session::flash('notify','Xóa thành công');
        return redirect()->route('indexprocess');
    }
}
