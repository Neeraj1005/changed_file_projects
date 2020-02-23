@extends('adminLayout.master')
@section('page-title','Support CRM')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
   {{--      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
          Add Media
        </button> --}}
{{--         <a href="#" class="btn btn-outline-secondary font-weight-normal mr-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>() </a>
        <a href="#" class="btn btn-outline-secondary font-weight-normal"><i class="fa fa-download" aria-hidden="true"></i></a> --}} 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section>
    	<div class="row">
    		<div class="col-lg-8 flex-lg-last">
    			<img src="{{url('uploads/media',$data->original_filename)}}" alt="{{$data->original_filename}}" style="
    			max-width: 50%;
    			display: block;
    			margin: auto;
    			height: auto; 
    			/*margin-left: 7px*/
    			">  			
    		</div>
    		<div class="col-lg-4 float-lg-left">
    			<div class="card card-primary" style="margin-right: 5px;">
    			              <div class="card-header" style="background-color: #676a6d;">
    			                <h3 class="card-title">Image Description</h3>
    			              </div>
    			              <!-- /.card-header -->
    			              <div class="card-body" >
    			                <span><i class="fa fa-calendar" aria-hidden="true"></i> Uploaded on:</span>
    			                <strong><p class="text-muted" style="display: inline">
    			                  {{ date('F d, Y',strtotime($data->created_at)) }} at {{ date('g : ia',strtotime($data->created_at)) }}
    			                </p></strong>
    			                <hr>
    			                <span>File Name:</span>
    			                <strong><p style="display: inline;">{{$data->original_filename}}</p></strong> 
								<hr>
    			                <span>File type:</span>
    			                <strong><p style="display: inline;">{{$data->extension}}</p></strong>
								<hr>
    			                <span>Fle Size:</span>
    			                <strong><p style="display: inline;"></p>{{round(($data->imgsize)/1024 )}}KB</strong>
    			                {{-- <strong><p style="display: inline;"></p>{{(File::size($data->filename))/1024}} KB</strong> --}}
								<hr>
    			                <span>Dimension:</span>
    			                <strong><p style="display: inline;">
    			                	{{$data->width}} <i class="fa fa-times" aria-hidden="true"></i> {{$data->height}}
    			                </p></strong>
								<hr>
    			                <span>File URL:</span>
    			                <!--<input type="text" class="mediaLib" name="image_url" value="{{url('uploads/media',$data->original_filename)}}" readonly="" style="
    			                display: block; 
    			                background-color: #eee;
    			                padding: 0 8px;
    			                line-height: 2;
    			                border-radius: 4px;
    			                border: 1px solid #7e8993;
    			                color: #32373c;
    			                border-spacing: 0;
    			                width:-webkit-fill-available;">-->
    			                {{-- <a href="{{url($data->filename)}}" target="_blank">{{url($data->filename)}}</a href="{{url($data->filename)}}"> --}}
<input type="text" class="mediaLib" name="image_url" value="{{url($data->filename)}}" readonly="" style="
                                display: block; 
                                background-color: #eee;
                                padding: 0 8px;
                                line-height: 2;
                                border-radius: 4px;
                                border: 1px solid #7e8993;
                                color: #32373c;
                                border-spacing: 0;
                                width:-webkit-fill-available;">
    			              </div>
    			              <!-- /.card-body -->
    			              <div class="card-footer">
    			              	<button class="btn btn-danger float-right" type="button" id="button-addon2">Delete</button>
    			              </div>
    			            </div>
    		</div>
    	</div><hr>
    	{{-- <div class="row">
    		    <button class="btn btn-outline-primary" type="button" id="button-addon2">Button</button>
    	</div> --}}
    </section>

@endsection