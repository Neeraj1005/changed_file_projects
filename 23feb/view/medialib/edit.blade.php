@extends('adminLayout.master')
@section('title','Media Edit')
@section('content-wrapper')

<div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mt-2">Media</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>



  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card shadow">
          <!-- /.card-body -->
          <form action="{{route('media.update',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="file" name="image">
            <h5>{{$data->original_filename}}</h5>
            <label for="imageSize" style="color: #9e9b9b">Maximum upload file size: 2 MB</label>
          </div>
          <button type="submit" name="submit" value="Update Menu" class="btn btn-primary font-weight-normal px-4"/>Update</button>
          </form> 
        </div>
        <!-- /.card --> 
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->










  </div>
@endsection