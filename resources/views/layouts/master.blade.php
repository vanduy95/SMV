<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{url('img/demo/shortcut-icon.png')}}" rel="shortcut icon" type="image/x-icon" />  
  <title>LOS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  {!!Html::style('theme/bootstrap/css/bootstrap.min.css')!!}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  {!!Html::style('js/alert/sweetalert.css')!!}
  {!!Html::style('theme/dist/css/AdminLTE.min.css')!!}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  {!!Html::style('theme/dist/css/skins/_all-skins.min.css')!!}
  <!-- iCheck -->
  {!!Html::style('theme/plugins/morris/morris.css')!!}
  <!-- jvectormap -->
  {!!Html::style('theme/plugins/jvectormap/jquery-jvectormap-1.2.2.css')!!}
  <!-- Date Picker -->
  {!!Html::style('theme/plugins/datepicker/datepicker3.css')!!}
  <!-- Daterange picker -->
  {!!Html::style('theme/plugins/daterangepicker/daterangepicker.css')!!}
  <!-- bootstrap wysihtml5 - text editor -->
  {!!Html::style('/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')!!}
  {!!Html::style('css/style.css')!!}
  {!!Html::style('theme/plugins/datatables/dataTables.bootstrap.css')!!}
  {!!Html::style('theme/dist/css/AdminLTE.min.css')!!}
  {!!Html::style('theme/dist/css/alt/AdminLTE-without-plugins.css')!!}
  {!!Html::style('theme/dist/css/alt/AdminLTE-without-plugins.min.css')!!}
  {{-- kendo css --}}
  {!!Html::style('/theme/kendo/kendo.common-material.min.css')!!}
  {!!Html::style('/theme/kendo/kendo.material.mobile.min.css')!!}
  {!!Html::style('/theme/kendo/kendo.material.min.css')!!}
  {{-- end kendo --}}
  {!!Html::script('theme/plugins/jQuery/jquery-3.2.1.min.js')!!}
  {{-- kendojs --}}
  {!!Html::script('theme/kendo/kendo.all.min.js')!!}
  {!!Html::script('theme/kendo/moment.js')!!}
  {{-- endkendojs --}}
  {!!Html::script('theme/plugins/money_format/numeral_money.min.js')!!}
  <script src="//cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('style')
  <style>
    .error{
      color:red;
    }
    .clear{
      clear: both;
    }
    .bg-gray-fix{
      background: #eee !important;
      font-weight: inherit !important;
      color: black !important;
    }
    .table-responsive{
      overflow-x: scroll;
    }
    @media screen and (min-width: 1000px){
      .table-responsive{
        overflow-x: hidden;
      }
    }

  </style>
  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.6 -->
  <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
  {!!Html::script('theme/bootstrap/js/bootstrap.min.js')!!}
  <!-- Morris.js charts -->
  <!-- Sparkline -->
  {!!Html::script('theme/plugins/sparkline/jquery.sparkline.min.js')!!}
  <!-- jvectormap -->
  {!!Html::script('theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')!!}
  {!!Html::script('theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')!!}
  <!-- jQuery Knob Chart -->
  {!!Html::script('theme/plugins/knob/jquery.knob.js')!!}
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  {!!Html::script('theme/plugins/daterangepicker/daterangepicker.js')!!}
  <!-- datepicker -->
  {!!Html::script('theme/plugins/datepicker/bootstrap-datepicker.js')!!}
  <!-- Bootstrap WYSIHTML5 -->
  {!!Html::script('theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')!!}
  <!-- Slimscroll -->
  {!!Html::script('theme/plugins/slimScroll/jquery.slimscroll.min.js')!!}
  <!-- FastClick -->
  {!!Html::script('theme/plugins/fastclick/fastclick.js')!!}
  <!-- AdminLTE App -->
  {!!Html::script('theme/dist/js/app.min.js')!!}
  {!!Html::script('js/notify/bootstrap-notify.js')!!}
  {!!Html::script('js/notify/bootstrap-notify.min.js')!!}
  {{-- kendo css --}}
  {!!Html::style('/theme/kendo/kendo.common-material.min.css')!!}
  {!!Html::style('/theme/kendo/kendo.material.mobile.min.css')!!}
  {!!Html::style('/theme/kendo/kendo.material.min.css')!!}
  {!!Html::script('theme/kendo/kendo.all.min.js')!!}
  {!!Html::script('theme/kendo/moment.js')!!}
  {{-- end kendo --}}

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- {!!Html::script('theme/dist/js/pages/dashboard.js')!!} -->
  <!-- AdminLTE for demo purposes -->
  {!!Html::script('theme/plugins/jQuery_Ajax/jQuery_Ajax_Admin.js')!!}
  {!!Html::script('theme/dist/js/demo.js')!!}
  {!!Html::script('theme/plugins/datatables/jquery.dataTables.min.js')!!}
  {!!Html::script('/theme/plugins/datatables/dataTables.bootstrap.min.js')!!}
  {!!Html::script('js/alert/sweetalert.min.js')!!}
  {!!Html::script('js/validate/jquery.validate.js')!!}
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  {!!Html::script('js/angular/notification.js')!!}
  <script type="text/javascript">
    $(function () {
      $('#example1').DataTable({
        responsive: {        details: false    }
      });
      $('#example2').DataTable({
       responsive: {        details: false    }
     });
    });

    var user_id={{Auth::user()->id}}

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  <script type="text/javascript">var _Hasync= _Hasync|| [];
    _Hasync.push(['Histats.start', '1,3877614,4,306,118,60,00011001']);
    _Hasync.push(['Histats.fasi', '1']);
    _Hasync.push(['Histats.track_hits', '']);
    (function() {
      var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
      hs.src = ('//s10.histats.com/js15_as.js');
      (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
    })();</script>
    <style type="text/css">
      #loading{
        background: url({{ asset('img/loading.gif') }}) center no-repeat ;
position: fixed;
left: 0px;
top: 0px,;
width: 100%;
height: 100%;
z-index: 9999
}
</style>

@yield('script')

</head>
<body class="skin-blue sidebar-mini">
 <div class="loading" id="loading" style="display: none"></div>
 <div class="wrapper">
  @include('partials.header')
  @include('partials.sidebars')
  <div class="content-wrapper" ng-app="my-app">
    @yield('content')
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
      </div>
    </aside>
  </div>
</div>


</body>
</html>
