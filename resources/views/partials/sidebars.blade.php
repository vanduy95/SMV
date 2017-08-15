<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    @if(Auth::check())
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/theme/dist/img/profile.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p> 
          {{Auth::user()->username}}
        </p>
      </div>
    </div>
    @endif
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      @include('partials.menu')
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>