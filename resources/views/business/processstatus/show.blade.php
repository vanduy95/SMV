@extends('layouts.master')

@section('content')
<section class="content-header">
  <h1>
    Process Status   
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Process Status</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Create Process Status</h3>
        </div>
        <div class="panel-body">
          <div class="form">
            {!!Form::open(array('class'=>'form-validate form-horizontal','id'=>'register_form','action'=>['ProcessStatusController@show',$processstatus->id]))!!}
            <div class="form-group ">
              {!!Html::decode(Form::label('fullname','Name <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
              <div class="col-lg-8">
                {!!Form::text('name',$processstatus->name,['class'=>'form-control'])!!}
                @if($errors->has('name'))<p style="color: red;">{{$errors->first('name')}}</p>@endif
              </div>
            </div>
            <div class="form-group ">
              {!!Html::decode(Form::label('fullname','Value <span class="required">*</span>',['class'=>'control-label col-lg-2']))!!}
              <div class="col-lg-8">
                {!!Form::text('value',$processstatus->value,['class'=>'form-control'])!!}
                @if($errors->has('value'))<p style="color: red;">{{$errors->first('value')}}</p>@endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
                <a class="btn btn-default" href="{{url('processstatus')}}">Cancel</a>
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