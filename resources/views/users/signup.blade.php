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
<body class="login-img3-body">
    <div class="container">
        {!!Form::open(array('class'=>'login-form','url'=>'login'))!!}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              {!!Form::text('username','',['class'=>'form-control','placeholder'=>'Username','autofocus'])!!}
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
        </div>
        <label class="checkbox">
            {!!Form::checkbox('','remember-me')!!}Remember me
            <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
        </label>
            {!!Form::submit('Login',['class'=>'btn btn-primary btn-lg btn-block'])!!}
        </div>
        {!!Form::close()!!}
        </div>
</body>
</html>