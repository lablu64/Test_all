@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All categories list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Category Name</th>
                      <th>Category Slug</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>

                  <form id="deleted_form" action="" method="post">
                    @method('DELETE')
                    @csrf
                </form> 

                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" id="add_form" >

      	@csrf
      
      <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category" name="category" required="">
           </div> 
           <div class="form-group">
            <label for="category_name">Category image</label>
            <input type="file" class="form-control"  name="image" >
           </div> 
          
          <div class="form-group">
            <label for="">status</label>
           <select class="form-control" name="status">
             <option value="active">Active</option>
             <option value="deactive">Deactive</option>
           </select>
           </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary"><span class="d-none"> loading..... </span> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body" id="edit_part">
        
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
  $('.dropify').dropify();

</script>



<script type="text/javascript">


 


  $(function category(){
        table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('category.index') }}",
        columns:[
          {data:'DT_RowIndex',name:'DT_RowIndex'},
          {data:'category_name',name:'category_name'},
           {data:'category_slug',name:'category_slug'},	
           {data:'image',name:'image'},
          {data:'action',name:'action',orderable:true, searchable:true},
  
        ]
      });
    });


    //store coupon ajax call
  $('#add_form').submit(function(e){
    e.preventDefault();
    $('.loading').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#addModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
</script>

@endsection