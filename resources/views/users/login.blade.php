<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('img/demo/shortcut-icon.png')}}" />
    <title>SỨC MUA VIỆT</title>
    <!-- Bootstrap CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    
    <!-- bootstrap theme -->
    {!!Html::style('css/bootstrap-theme.css')!!} 
    <!--external css-->
    <!-- font icon -->
    {!!Html::style('css/elegant-icons-style.css')!!} 
    {!!Html::style('css/font-awesome.css')!!} 
    <!-- Custom styles -->
    {!!Html::style('css/style1.css')!!} 
    {!!Html::style('css/style-responsive.css')!!} 
    {!!Html::script('theme/plugins/jQuery/jquery-2.2.3.min.js')!!}
    {!!Html::script('js/custom.js')!!}
</head>
<body>
{{--     <div class="container">
        {!!Form::open(array('class'=>'login-form','action'=>'LoginController@login'))!!}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            @if($errors->has('errorslogin'))
            <div class="alert alert-danger">
                {{$errors->first('errorslogin')}}
            </div>
            @endif
            @if(Session::has('user_success1') && Session::has('user_success2'))
            <div class="alert alert-success">
             <p style="font-family: Arial !important">{{ Session::get('user_success1') }}</p>
             <p style="font-family: Arial !important">{{Session::get('user_success2')}}</p>
         </div>
         @endif
         <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          {!!Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Username','autofocus'])!!}
      </div>
      @if($errors->has('username'))<p style="color: red;font-family: Arial">{!!$errors->first('username')!!}</p>@endif
      <div class="input-group">
        <span class="input-group-addon"><i class="icon_key_alt"></i></span>
        {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
    </div>
    @if($errors->has('password'))<p style="color: red;font-family: Arial">{!!$errors->first('password')!!}</p>@endif
    <label class="checkbox">
        {!!Form::checkbox('','remember')!!}<span style="font-family: Arial">Nhớ mật khẩu</span>
        <span style="font-family: Arial" class="pull-right"> <a href="#">Quên mật khẩu?</a></span>
    </label>
    <input type="hidden" name="back_url" value="{{session('url_back')}}">
    {!!Form::submit('Đăng nhập',['class'=>'btn btn-primary btn-lg btn-block','style'=>'font-family: Arial '])!!}
</div>
{!!Form::close()!!} --}}
{{-- </div> --}}
<div class="head-bg col-lg-12 col-md-12 col-xs-12">
    <div class="head-logo col-lg-3 col-md-5 col-xs-5">
        <a href="/"><img src="../img/home_page/logo.png" alt=""></a>
    </div>
    <div class="head-logo col-lg-8 col-md-6 col-xs-6">
        <a href="{{route('accountcreate')}}"><h3>Đăng ký</h3></a>
    </div>
    <div class="clear"></div>
</div>
<div class="login-background col-lg-12 col-md-12">
    <div class="data-form-login col-lg-4 col-md-8 col-xs-12">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="form-title col-lg-12 col-xs-12 col-md-12 text-center">
                <h1>ĐĂNG NHẬP</h1>
            </div>
            <div class="form-title col-lg-6 col-xs-6 col-md-6">            </div>
            <div class="clear"></div>
        </div>
        <div class="col-lg-12" style="padding: 0">
            <form class="form-login col-lg-12 col-md-12 col-xs-12" method="post" action="/login">
                {{csrf_field()}}
                <div  class="form-input col-lg-12 col-xs-12 col-md-12 form-group">
                    <label id="form-label-u" for="">Tên đăng nhập</label>
                    <input id="form-input-u" name="username"  class="form-control" type="text">
                </div>
                @if($errors->has('username')) <p>{{"a"}}</p>
                @endif
                <div  class="form-input col-lg-12 col-xs-12 col-md-12 form-group">
                    <label id="form-label-p" for="">Mật khẩu</label>
                    <input id="form-input-p" name="password" class="form-control" type="password">
                    @if($errors->has('password'))<p style="color: red;font-family: Arial">{{$errors->first('password')}}</p>@endif
                </div>
                <div class="form-input col-lg-12 col-xs-12 col-md-12">
                    <label for=""><a href="">Quên mật khẩu</a></label>
                </div>
                <div class="col-lg-12 col-xs-12 col-md-12 form-group">
                    <input type="checkbox">
                    <label for="">Lưu mật khẩu</label>
                </div>
                <div class="form-input col-lg-12 col-xs-12 col-md-12 form-group">
                    <input class="btn btn-primary" type="submit" value="Đăng nhập">
                </div>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="col-lg-12">
    <div class="clear"></div>
</div>
</body>
</html>