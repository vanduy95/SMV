@extends('layouts.master')
@section('content')
<section class="content-header">
  <h1>
    Account 
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Assess</li>
  </ol>
</section>
<!-- list account -->
<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header">
        <h3 class="col-lg-3">List Assess</h3>
      </div>
      <!-- <div class=" form-group">
        <tr class=" form-group">
          <td><label>Search: </label></td>
          <td>
            <input class="" type="text" name="search_assess">
          </td>
        </tr>
      </div> -->
      <div class="box-body">
       <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
          <thead>
            <tr role="row">
              <th>ID</th>
              <th>Scores</th>
              <th>Scores</th>
              <th>Reted</th>
              <th>Review</th>
              <th>Create At</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>
             @foreach($assess as $as)
             <tr role="row" class="odd">
              <td class="sorting_1">{{$as->id}}</td>
              <td>{{$as->scoresfirst}}</td>
              <td>{{$as->scoreslast}}</td>
              <td>{{$as->reted}}</td>
              <td>{{$as->reviews}}</td>
              <td>{{$as->created_at}}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ route('AsseessShow',$as->id) }}" class="confirm" ><i class="fa fa-fw fa-cog confirm"></i></a>
                  <a id="delete_assess" data-id={{$as->id}}><i
                    class="fa fa-fw fa-remove"></i></a>
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
  </div>
  <script type="text/javascript">
    $('table').on('click', '#delete_assess', function(event) {
      var table = $('table').DataTable();
      var r = $(this).parents('tr');
      var assess_id=$(this).data('id');
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
          url: "{{ url('admin/ajax/postDeleteAssess') }} ",
          data:{assess_id:assess_id},
          type:'POST',
          success: function(data){
           if(data.toString().indexOf("Permission Denied")==-1){
            //$(".order_"+order_id).parent().remove();
            table.row( r ).remove().draw();
            swal("Xóa thành công!", "", "success");
          }
          else
          {
           swal("Bạn Không có quyền!","", "error")
         }
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
