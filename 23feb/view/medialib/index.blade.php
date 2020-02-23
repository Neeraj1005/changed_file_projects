@extends('adminLayout.master')
@section('page-title','Support CRM')
@section('content-wrapper')

<div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mt-2">Media</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right pull-right">
        {{-- <a class="btn btn-primary font-weight-normal mr-1 px-3" href="#" ><i class="fa fa-plus-square-o mr-1" aria-hidden="true"></i> Add Media</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Add Media
        </button>
{{--         <a href="#" class="btn btn-outline-secondary font-weight-normal mr-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>() </a>
        <a href="#" class="btn btn-outline-secondary font-weight-normal"><i class="fa fa-download" aria-hidden="true"></i></a> --}} 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Modal -->
    <form action="{{route('media.store')}}" method="post" enctype="multipart/form-data">
    	@csrf
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add Media</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="image">Upload Image</label>
              <input type="file" class="form-control-file" id="file" name="image">
              <label for="imageSize" style="color: #9e9b9b">Maximum upload file size: 2 MB</label>
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


<section class="content">
<div class="row">
  <div class="col-12">
    <div class="card shadow">
 {{--      <div class="card-header">
          
      </div> --}}
        <div class="card-body pb-1 pt-2 px-0 minus-padd">
       <table id="example" class="table table-condensed">
        <thead>
            <tr>
              <th width="30">
				<div class="custom-control custom-checkbox text-center pl-3">
					<input type="checkbox" class="checkbox custom-control-input" id="check_all">
					<label class="custom-control-label ml-2" for="check_all"></label>
				</div>
			</th>
              <th>Image</th>
              <th>File Name</th>
              <th>Uploaded Date</th>
              <th>Edit</th>
              <th>Delete</th>
              
            </tr>
        </thead>
        <tbody> 
        @foreach($profiles as $profile)
        <tr>

            <td width="20">
				<div class="custom-control custom-checkbox">
				  <input type="checkbox" class="checkbox custom-control-input" id="{{$profile->id}}" data-id="{{$profile->id}}">
				  <label class="custom-control-label ml-2" for="{{$profile->id}}"></label>
				</div>
			</td>
        	<td>
				{{-- <button data-toggle="modal" data-target=".bd-example-modal-xl"> --}}
        	<a href="{{route('media.show', $profile->id)}}">
        		<img class="thumbnail" src="{{url($profile->filename)}}" alt="{{$profile->original_filename}}" style="width: 125px; height: 125px;">
        		{{-- </button> --}}
        	</a>
        	</td>
        	<td>{{$profile->original_filename}}</td>
        	<td>{{ date('F d, Y',strtotime($profile->created_at)) }}<br>{{ date('g : ia',strtotime($profile->created_at)) }}</td>
    {{--     	<td>
        		<a href="{{route('media.show', $profile->id)}}">view</a>
        	</td> --}}
          <td>
              <a class="btn btn-sm btn-outline-secondary btn-sml mr-2" href="{{ route('media.edit',$profile->id) }}"><i class="fa fa-pencil text-secondary" aria-hidden="true"></i></a>
          </td>
        	<td>
        		<form method="post" action="{{route('media.destroy', $profile->id)}}">
        			@csrf
        			@method('DELETE')
        			<button class="btn btn-sm btn-outline-secondary delete-all" data-url=""><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete </button>
        		</form>
        	</td>
        </tr>
	    @endforeach
        </tbody>

    </table>
       </div>
{{-- 	  <div class="border-top bg-white card-footer text-muted">
         <button class="btn btn-sm btn-outline-secondary delete-all" data-url=""><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete </button>      
		</div> --}}
@include('includes/datatable')
      <!-- /.card-body --> 
    </div>
    <!-- /.card --> 
  </div>
  <!-- /.row -->

{{-- Modal Start --}}

{{-- <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      	<div class="container">
<section class="float-left">
	Hello
</section>
<section class="float-right">
	Ni,c
</section>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}
{{-- Model End --}}

  </section>
  <!-- /.content -->










</div>
<script type="text/javascript">
	$('.confirmation').on('click', function () {
		return confirm('Are you sure want to delete?');
	});
</script>
@endsection