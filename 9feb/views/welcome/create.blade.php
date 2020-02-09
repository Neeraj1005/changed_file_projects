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
        <form>
        <div class="form-group">
          <label for="formGroupExampleInput">Title</label>
          <input type="text" class="form-control" name="title" id="formGroupExampleInput" placeholder="Example input placeholder">
        </div>
        <div class="form-group">
          <label for="image">Upload Image</label>
          <input type="file" class="form-control-file" id="file" name="image">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Message</label>
          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        <button type="button" class="btn btn-success float-right">update</button>
      </form>
      </div>
    </div>
    </div>    
  </div>
  </section> 
</div>
 
@endsection