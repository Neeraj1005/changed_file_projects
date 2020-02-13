@extends('adminLayout.master')
@section('page-title',':: Admin Control panel Logo Management ::')
@section('content-wrapper')

 <div class="content-wrapper">
<!-- Main content -->
  	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
            <h1 class="my-1">Edit Menu</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	
	
<section class="content">
@if(Session::has('message'))
<div class="alert alert-success"> {{ Session::get('message') }} </div>
@endif
				 
@if (Session::has('errors'))
<div class="alert alert-danger"> @foreach ($errors->all() as $error)
  {{ $error }}<br/>
  @endforeach </div>
@endif

<div class="row">

          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card shadow">
              <!-- form start -->
               
                <div class="card-body card-body-custom">
				<form action="{{route('menu.update',$items->id)}}" method="post" enctype="multipart/form-data">
				{{-- <input type="hidden" name="_method" value="PUT" /> --}}
				@csrf
        @method('put')

                  <div class="form-group">
                    <label for="status">Menu Display</label>
                     
                    <select name="status" id="status" class="form-control"> 
                      <option value="3">Select Menu  Appearance Area</option>
                      <option value="1" @if($items->status === 1) selected = 'selected' @endif>Top Menu</option>
                      <option data-check="true" value="2" @if($items->status === 2) selected = 'selected' @endif>Sub Menu</option>

                      <option value="0" @if($items->status === 0) selected = 'selected' @endif>Footer Menu</option>
                    </select>
          
                  </div>

                  <div class="form-group">
                    <label for="name">Menu Name</label>
                    <input type="text" name="name" class="form-control" value="{{$items->name}}" >
                  
                  </div> 

{{--                   <div class="form-group">
                    <label for="page">Pages</label>
                    <select name="page" class="form-control">
                        <option value="0">Select Pages</option>
                        @foreach($pages as $page)
                        <option value="{{$page->id}}" @if(old('page', $items->content_id) === $page->id) selected @endif>
                           {{$page->title}}
                        </option>
                        @endforeach
                    </select>
                  
                  </div> --}}
                  <div class="form-group">
                    <label for="page" class="labelclass">Pages</label>
                    <select class="form-control" name="page" id="pageone">
                      <option value="0">Select page</option>
                      @foreach($pages as $page)
                      <option value="{{$page->id}}" @if(old('page', $items->content_id) === $page->id) selected @endif>{{$page->title}}</option>
                      @endforeach                                    
                      <option disabled>---</option>
                      <option value='NewField' @if(old('page', $items->content_id) === 'NewField') selected @endif>Add Custom URL</option>
                    </select>
                    <input class="form-control" type="text" name="page1" id="page" placeholder="https://" value="{{$items->content_id}}" style=" width: 450px; margin-top: 5px;" />
                  </div>


               @php
               use App\Menu;
                 $dropdown = Menu::all();
               @endphp
                 <div class="form-group" id="ifYes" style="">
                  <label for="parent_id">Parent id</label>
                  <select name="parent_id" id="parent_id" class="form-control">
                      <option value="0">Select Parent id</option>
                      @foreach($dropdown as $dropname)
                      <option value="{{$dropname->id}}" @if(old('dropname', $items->parent_id) === $dropname->id) selected @endif>
                         {{$dropname->name}}
                      </option>
                      @endforeach
                  </select>
                </div>
                <!-- /.card-body -->

<div class="border-top bg-white card-footer text-muted text-right pull-right">
<a href="{{url('menu')}}" class="btn btn-outline-secondary font-weight-normal mr-2">Cancel</a>
<button type="submit" name="submit" value="Update Menu" class="btn btn-primary font-weight-normal px-4"/>Save</button>
                </div>
              </form>
            </div>

			</div>
      <!--Here is my java script code-->
      <script type="text/javascript">
          $(function() {
              // Add lead
              $("#pageone").change(function() {
                  var dropvalue = $(this).val();
                  if (dropvalue == "NewField") {
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

</div>


@endsection