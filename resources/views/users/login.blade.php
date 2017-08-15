<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <title>LOS SYSTEM</title>
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
</head>
<body class="login-img3-body" style="background: url({{url('img/test.jpg')}}) no-repeat; background-size: 100%">
    <div class="container">
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
    {!!Form::close()!!}
</div>
</body>
</html>