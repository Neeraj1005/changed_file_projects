@extends('adminLayout.master')
@section('page-title','Didital CRM')
@section('content-wrapper')


<div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mt-2">Articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right pull-right">
        <a class="btn btn-primary font-weight-normal mr-1 px-3" href="{{ route('articles.create') }}" ><i class="fa fa-plus-square-o mr-1" aria-hidden="true"></i> New Article</a>
        <a href="{{url('admin-article-trash')}}" class="btn btn-outline-secondary font-weight-normal mr-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>({{$trashArticle}}) </a>
        <a href="{{url('export-article')}}" class="btn btn-outline-secondary font-weight-normal"><i class="fa fa-download" aria-hidden="true"></i></a> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- Main content -->
 @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
 


<section class="content">
<div class="row">
  <div class="col-12">
    <div class="card shadow">
      <div class="card-header">
          @include('includes/article_top')
      </div>
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
              <th>Title</th>
            <?php if($usertype == "administrator"){?> <th>Author </th> <?php }?>
            <th>Image</th> 
              <th>Category</th>
              <th>View</th>
              <th>Like</th>
              <th>Dislike</th>
              <th>Created Date</th>
              <th>Featured</th>
              <th>Status</th>
              <th>Action</th>
              
            </tr>
        </thead>
        <tbody>  

         @foreach($articles as $val)
        <tr>
		
            <td width="20">
				<div class="custom-control custom-checkbox">
				  <input type="checkbox" class="checkbox custom-control-input" id="{{$val->id}}" data-id="{{$val->id}}">
				  <label class="custom-control-label ml-2" for="{{$val->id}}"></label>
				</div>
			</td>
            @if($val->draft===1)
            <td><a href="{{ url('viewArticle',$val->aslug) }}" target="_blank" >{{ $val->title }} </a></td>
            @else
            <td><a href="{{ url('viewArticle',$val->aslug) }}" target="_blank" >{{ $val->title }} <span>-draft</span></a></td>
            @endif
<td>
  @if($val->image!=Null)
      @if($val->image!=$val->mediaLibrary['id'])
      Image is deleted plz upload new image
      @else
  <img src="{{url('uploads/media',$val->mediaLibrary['original_filename'])}}" style="height: 125px; width: 125px;">
      @endif
  @else
  image is not selected
  @endif
</td>
           <?php if($usertype == "administrator"){?> <td>{{  $val->user['name'] }}  </td> <?php }else{}?>
            <td>{{ $val->category['name'] }}</td>
            <td>{{ $val->visit_count }}</td>
             <td>{{ abs($val->thumbsup) }}</td>
             <td>{{ abs($val->thumbsdown) }}</td>
             

            <td>{{ date('F d, Y',strtotime($val->created_at)) }} <br /> at {{ date('g : ia',strtotime($val->created_at)) }} </td>
             <td>
              <!-- @if($val->status ==0)
              <a href="{{url('articles/featured/'.$val->id)}}" id="featured">Not Featured</a>
              @else
               <a href="{{url('articles/featured/'.$val->id)}}" id="featured">Featured</a>
               @endif -->

               <a href="{{url('articles/featured/'.$val->id)}}">
              <?php if($val->status==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>


              </td>
              <td><!--This table data will show button or draft section when post is not draft-->

            {{--   @if($val->article_status ==0)
              <a href="{{url('articles/articlesStatus/'.$val->id)}}" id="featured">Inactive</a>
              @else
               <a href="{{url('articles/articlesStatus/'.$val->id)}}" id="featured">Active</a>
               @endif  --}}
               
              @if($val->draft===0 && $val->article_status===1)
               draft
              @else 
              <a href="{{url('articles/articlesStatus/'.$val->id)}}">
 <!--below ternary operation is used-->
              {!! ($val->article_status===1)? '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>' : '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>' !!}
              </a>
              @endif


              </td>
               
            <td>
					@can('article-edit')
                    <a class="btn btn-sm btn-outline-secondary btn-sml mr-2" href="{{ route('articles.edit',$val->id) }}"><i class="fa fa-pencil text-secondary" aria-hidden="true"></i></a>
                    @endcan 
              <!--<form action="{{ route('articles.destroy',$val->id) }}" method="POST">
                  <a class="btn-text-first" href="{{ route('articles.show',$val->id) }}">Show</a>
                    @csrf
                    @method('DELETE')
                     @can('article-delete') 
                    <button type="submit" class="btn-text-delete confirmation">Delete</button>
                    @endcan
                </form>--> 
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>
       </div>
	    <script type="text/javascript">
                        $('.confirmation').on('click', function () {
                            return confirm('Are you sure want to delete?');
                        });
                    </script>
	  <div class="border-top bg-white card-footer text-muted">
         <button class="btn btn-sm btn-outline-secondary delete-all" data-url=""><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete </button>      
		</div>
@include('includes/datatable')
      <!-- /.card-body --> 
    </div>
    <!-- /.card --> 
  </div>
  <!-- /.row -->
  </section>
  <!-- /.content --> 
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#featured').click(function(){
          $.ajax({
                    url: 'create/'+catID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      //console.log(data);
                        
                        $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
    });
})

    
</script>
<script type="text/javascript">

   $(document).ready(function () {
      $('#check_all').on('click', function(e) {
      if($(this).is(':checked',true))  
      {
        $(".checkbox").prop('checked', true);  

      } else {  

        $(".checkbox").prop('checked',false);  

      } 

      });
      $('.checkbox').on('click',function(){

        if($('.checkbox:checked').length == $('.checkbox').length){

           $('#check_all').prop('checked',true);

        }else{

           $('#check_all').prop('checked',false);

        }

      });

      $('.delete-all').on('click', function(e) {

       var idsArr = [];  

        $(".checkbox:checked").each(function() {  

           idsArr.push($(this).attr('data-id'));

        });  
       if(idsArr.length <=0)  
       {  
        alert("Please select atleast one record to delete.");  

       }else {  
//alert("{{ route('articles.multiple-delete') }}");
        if(confirm("Are you sure, you want to delete the selected articles?")){  
          var strIds = idsArr.join(","); 
           $.ajax({
            url: "{{ route('articles.multiple-delete') }}",
              type: 'GET',
             // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: 'ids='+strIds,
              success: function (data) {
               // alert(data);
             if (data['status']==true) {
                $(".checkbox:checked").each(function() {  
  
                  $(this).parents("tr").remove();

                });
                alert(data['message']);

                } else {
                  alert('Whoops Something went wrong!!');
                }
              },

              error: function (data) {
              alert(data.responseText);

              }

              });

           }  

        }  

      });

      $('[data-toggle=confirmation]').confirmation({

       rootSelector: '[data-toggle=confirmation]',
       onConfirm: function (event, element) {
        element.closest('form').submit();
       }

    });   

  });

</script> 
@if(Auth::user()->privilege == 'administrator')
<script type="text/javascript">
   $(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#liknowledge").addClass('menu-open');        
        $("#ulknowledge").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#lilistarticle").addClass("active");
      });
</script>
 @else
<script type="text/javascript">
   $(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#liagentknowlage").addClass('menu-open');        
        $("#ulagentknowlage").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#agentarticle").addClass("active");
      });
</script>
 @endif
@endsection