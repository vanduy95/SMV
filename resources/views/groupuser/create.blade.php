@extends('layouts.master')

@section('content')
<section class="content-header">
  <h1>
    Group user  
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Group user</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create Group User</h3>
        </div>
        <div class="panel-body">
          <div class="form">
            {!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','url'=>'admin/groupuser/create','action'=>['GroupUserController@getcreate']))!!}
            <div class="form-group ">
              {!!Html::decode(Form::label('fullname','Group user Name <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
              <div class="col-lg-8">
                {!! Form::text('name','',['class'=>'form-control']) !!}
                @if($errors->has('name'))<p style="color: red;">{{$errors->first('name')}}</p>@endif
              </div>
            </div>
            <div class="form-group ">
              {!!Html::decode(Form::label('fullname','Note <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
              <div class="col-lg-8">
                {!! Form::text('note','',['class'=>'form-control']) !!}
                @if($errors->has('note'))<p style="color: red;">{{$errors->first('note')}}</p>@endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                {!!Form::submit('Save',['id'=>'save','class'=>'btn btn-primary'])!!}
                {!!Form::reset('Reset',['id'=>'reset','class'=>'btn btn-default'])!!}
              </div>
            </div>
            {!!Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop