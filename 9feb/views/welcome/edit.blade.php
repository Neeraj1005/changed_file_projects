@extends('adminLayout.master')
@section('page-title',':: Admin Control panel Logo Management ::')
@section('content-wrapper')

<div class="content-wrapper">

<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-6">
    <div class="card mt-1">
      <div class="card-body">
        @include('includes/flashmessage')
        <form action="{{ route('welcome-home.update',$data->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="formGroupExampleInput">Title</label>
            <input type="text" class="form-control" name="title" id="formGroupExampleInput" placeholder="" value="{{$data->title}}">
          </div>
          <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="file" name="image" value="{{$data->image}}"><span>{{$data->image}}</span>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Message</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{$data->description}}</textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-success float-right">update</button>
        </form>
      </div>
    </div>
  </div>    
  </div>
  </section> 
</div>
 
@endsection