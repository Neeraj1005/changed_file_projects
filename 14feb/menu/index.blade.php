@extends('adminLayout.master')
@section('page-title',':: Admin Control panel Logo Management ::')
@section('content-wrapper')
 <div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-8">
            <h1 class="mt-2">Menus</h1>
          </div><!-- /.col -->
          <div class="col-sm-4 text-right pull-right">
        @can('menu-create')
        <a href="{{url('menu/create')}}" class="btn btn-primary font-weight-normal px-3 mr-1"><i class="fa fa-plus-square-o mr-2" aria-hidden="true"></i>New Menu</a>
        @endcan
		<a href="{{url('menuTrash')}}" class="btn btn-outline-secondary mr-2"><i class="fa fa-trash mr-1" aria-hidden="true"></i>({{$trashMenu}})</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	
	

<!-- Main content -->
<section class="content">
@if(Session::has('message'))
<div class="alert alert-success"><i class="glyphicon glyphicon-ok"></i> &nbsp;{{Session::get('message')}}</div>
@endif

@if(Session::has('errors'))
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
 

<div class="row">
  <div class="col-12">
    <div class="card shadow">
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
                            <th>Menu Name</th>
                              <th>Menu appearance area</th>
                              <th >Status</th>
                           
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($items as $item)
                          <tr>
                           <td width="20">
				<div class="custom-control custom-checkbox">
				  <input type="checkbox" class="checkbox custom-control-input" id="{{$item->id}}" data-id="{{$item->id}}">
				  <label class="custom-control-label ml-2" for="{{$item->id}}"></label>
				</div>
			</td>
			                <td>{{$item->name}}</td>
                      <!--      <td><?php if($item->status ==1) { ?> Top Menu <?php } else { ?> Footer Menu <?php } ?></td>-->
<td>
  @if($item->status===1)
  Top Menu

@elseif($item->status===2)
  Sub Menu

@else
Footer Menu
@endif
</td>


                            <td>

                              <a href="{{url('menu/menuStatus/'.$item->id)}}">
                              @if($item->menu_status==1)
                              {!!'<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>'!!}
                              @else
                              {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>' !!}
                              </a>
                              @endif


                            </td>
                            <td>
                            @can('menu-create')
							<a href="{{url('menu/'.$item->id.'/edit')}}" class="btn btn-sm btn-outline-secondary btn-sml mr-2"><i class="fa fa-pencil text-secondary" aria-hidden="true"></i></a>
							@endcan
							
							
                        <!--<form action="{{url('menu/'.$item->id)}}" method="post" >
						<input type="hidden" name="_method" value="DELETE" />
						{{csrf_field()}}
						@can('menu-delete')
						<button type="submit" name="submit"  class="btn-text-delete" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
						@endcan
						</form>-->
                             </td>
                           
                          
                          </tr>
                          @endforeach
                        </tbody>
                       
                      </table>
       </div>
 <div class="border-top bg-white card-footer text-muted">        
         <button class="btn btn-sm btn-outline-secondary font-weight-normal delete-all" data-url=""><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete </button>      
		</div>


@include('includes/datatable')
      <!-- /.card-body --> 
    </div>
    <!-- /.card --> 
    
  </div>
  <!-- /.row -->
  
</div>
</section>
</div>


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
        if(confirm("Are you sure, you want to delete the selected recore's?")){  
          var strIds = idsArr.join(","); 
           $.ajax({
            url: "{{ route('menu.multiple-delete') }}",
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
<script type="text/javascript">
   $(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#licms").addClass('menu-open');        
        $("#ulcms").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#menu").addClass("active");
      });
</script>
@endsection