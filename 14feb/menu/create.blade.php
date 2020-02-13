@extends('adminLayout.master')
@section('page-title',':: Admin Control panel Logo Management ::')
@section('content-wrapper')
 
 
 <div class="content-wrapper">
  <!-- Main content -->
  	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
            <h1 class="my-1">New Menu</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	
	
<section class="content">
@include('includes/flashmessage')
<div class="row">

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card shadow">
              <!-- /.card-header -->
              <!-- form start -->
               
                <div class="card-body">
				<form method='post' action="{{url('menu')}}" role="form">
                {{csrf_field()}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Menu Display</label>
                    <select name="status" id="status" class="form-control">
                      <option value="1">Top Menu</option>
                      <option data-check="true" value="2">Sub Menu</option>
                        <option value="0">Footer Menu</option>

                    </select>
          
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Menu Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" >
					
                  </div> 
<div class="form-group">
    <label for="page">Pages</label>
    <select class="form-control" name="page" id="pageone">
        <option value="">Select page</option>
        @foreach($pages as $page)
        <option value="{{$page->id}}">{{$page->title}}</option>
        @endforeach                                    
        <option disabled>---</option>
        <option value='NewField'>Add Custom URL</option>
    </select>
    <input class="form-control" type="text" name="page1" id="page" style="display: none;" />
    {{-- <span class="text-danger">{{ $errors->first('page') }}</span> --}}
</div>
@php
use App\Menu;
  $dropdown = Menu::all();
@endphp
  <div class="form-group" id="ifYes" style="display: none;">
    <label for="parent_id">Parent Menu</label>
    <select class="form-control" name="parent_id" id="parent_id">
      <option value="0">select Menu</option>
      @foreach($dropdown as $drop)
      <option value="{{$drop->id}}">{{$drop->name}}</option>
   @endforeach
    </select>
  </div>

                <div class="border-top bg-white card-footer text-muted text-right pull-right">
				    <a href="{{url('menu')}}" class="btn btn-outline-secondary font-weight-normal mr-2">Cancel</a>    
					<button class="btn btn-primary font-weight-normal px-4" type="submit" name="submit">Create</button>
                </div>
              </form>
            </div>

			</div>
</div>


<!-- jQuery -->
<script src="{{url('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('plugins/select2/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        // Add lead
        $("#pageone").change(function() {
            var alead = $(this).val();
            if (alead == "NewField") {
                $("#page").show();
            } else {
                $("#page").hide();
            }
        });
    });
    $(function() {
    $('select').change(function(evt) {
       console.log($('select option:selected').data('check'));
       $('select option:selected').data('check') ? 
           $('#ifYes').show() : $('#ifYes').hide();
    });
        $("#status").change(function(){
      $('#parent_id').val('0');
    });
});
</script>
@endsection