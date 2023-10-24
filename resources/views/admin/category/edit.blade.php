<form action="{{ route('category.update') }}" method="Post" enctype="multipart/form-data" id="edit_form">
    @csrf
    <div class="form-group">
      <input type="hidden" name="id" value="{{ $data->id }}">
      <label for="category_name">Category Name</label>
      <input type="text" class="form-control" id="category" name="category" value="{{ $data->category }}">
      <small id="emailHelp" class="form-text text-muted">This is your main category</small>
    </div> 
    
    {{-- <div class="form-group">
      <label for="category_name">Category Icon</label><br>
      <input type="file" class="dropify" id="icon" name="icon" >
      <input type="hidden"  name="old_icon" value="{{ $data->icon }}">
    </div>   --}}
    {{-- <div class="form-group">
      <label for="category_name">Show on Homepage</label>
     <select class="form-control" name="home_page">
       <option value="1" @if($data->home_page==1) selected @endif>Yes</option>
       <option value="0" @if($data->home_page==0) selected @endif>No</option>
     </select>
      <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>
    </div>     --}}

<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="Submit" class="btn btn-primary">Update</button>
</div>
</form>
<script type="text/javascript">
  $('#edit_form').submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var request =$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){  
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('#editModal').modal('hide');
          table.ajax.reload();
        }
      });
    });


</script>
