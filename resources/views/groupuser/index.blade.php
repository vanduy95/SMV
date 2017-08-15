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
        <div class="box-header">
          <h3 class="box-title">List Group</h3>
        </div>
        @if(session('notify'))
        <div class="alert bg-teal disabled color-palette">
          {{session('notify')}}
        </div>
        @endif
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
              <tr role="row">
                <th>ID</th>
                <th>Name</th>
                <th>Create date</th>
                <th>Update date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($groupuser as $gr)
              <tr>
                <td>{{$gr->id}}</td>
                <td>{{$gr->name}}</td>
                <td>{{$gr->created_at}}</td>
                <td>{{$gr->updated_at}}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('groupshow',$gr->id) }}"><i class="fa fa-fw fa-cog"></i></a>
                    <a id="delete_groupuser" data-id={{$gr->id}}><i class="fa fa-fw fa-remove"></i></a>
                  </div>
                </td>
              </tr> 
              @endforeach   
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $('table').on('click', '#delete_groupuser', function(event) {
      var table = $('table').DataTable();
      var r = $(this).parents('tr');
      var groupuser_id=$(this).data('id');
      swal({
        title: "Bạn có chắc muốn xóa",
        text: "",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
      },
      function(){
        $.ajax({
          url: "{{ url('admin/ajax/postDeleteGroupUser') }} ",
          data:{groupuser_id:groupuser_id},
          type:'POST',
          success: function(data){
            //$(".order_"+order_id).parent().remove();
             table.row( r ).remove().draw();
            swal("Xóa thành công!", "", "success");
          },
          error: function() {
           swal("Xóa thất bại!", "", "error")
         }
       });
      });
    });
  </script>
</section>
@stop