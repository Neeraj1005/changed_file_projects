@extends('adminLayout.master')
@section('page-title','Support CRM')
@section('content-wrapper')

<div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mt-2">Welcome page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right pull-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Add Welcome
        </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Modal -->
    <form action="{{route('welcome-home.store')}}" method="post" enctype="multipart/form-data">
    	@csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="width: 50%">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add your Welcome page </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
              <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
</form>
{{-- Modal End --}}
{{-- View Section --}}
    <section class="content">
    	<div class="row">
    		@foreach($data as $data)
    		<div class="card m-4" style="width: 18rem;">
    			<img alt="avatar" class="card-img-top" src="{{$data->image}}" class="float-right">
    			<div class="card-body">    				
            <h5 class="card-title">{{$data['title']}}</h5>
    				<p class="card-text"> {{$data['description']}} </p>
          <a href="{{url('/welcome-home/'.$data->id.'/edit')}}" class="btn btn-primary float-right">Edit</a>
    			{{-- 	<form method="post" action="#">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-primary float-right">Delete1</button>
    				</form>  --}}
    			</div>
    		</div>
    		@endforeach		
    	</div>
    </section>
    {{-- End View Section --}}
</div>

@endsection