@extends('adminLayout.master')
@section('page-title','Knowledgebase Settings')
@section('content-wrapper')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
   

{{-- <?php $settingval = DB::table('knowledgebaseSetting')->get(); ?> --}}
<div class="content-wrapper">
	<div class="content-header py-2 border--bottom shadow-2 mb-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="my-1">Knowledgebase Settings</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- Main content -->
 @include('includes/flashmessage')
 
<section class="content">
<div class="row">
  <div class="col-12">
    <div class="card shadow">
        <div class="card-body pb-1 pt-2 px-0 minus-padd">
       <table id="example" class="table table-condensed">
        <thead>
          <tr>
            <th>#</th>
            <th>Setting</th>
            <th>Status </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Display Views</td>
            <td>
               

              <a href="{{url('knowledgebaseViews')}}">
              <?php if($settingval[0]->views==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Display Like/Unlike</td>
            <td>
                <!-- <a href="{{url('knowledgebaseLikeUnlike')}}"><?php if($settingval[0]->like_unlike ==1){?> On <?php }else{?> Off <?php }?></a> -->
                <a href="{{url('knowledgebaseLikeUnlike')}}">
              <?php if($settingval[0]->like_unlike==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Display Category</td>
            <td>
              <!-- <a href="{{url('knowledgebaseCategory')}}"><?php if($settingval[0]->category ==1){?> On <?php }else{?> Off <?php }?></a> -->
               <a href="{{url('knowledgebaseCategory')}}">
              <?php if($settingval[0]->category==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>4</td>
            <td>Display Author</td>
            <td>
              <!-- <a href="{{url('knowledgebaseAuthor')}}"><?php if($settingval[0]->author ==1){?> On <?php }else{?> Off <?php }?></a> -->
               <a href="{{url('knowledgebaseAuthor')}}">
              <?php if($settingval[0]->author==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>5</td>
            <td>Display Posted Date</td>
            <td>
              <!-- <a href="{{url('knowledgebasePostedDate')}}"><?php if($settingval[0]->posted_date ==1){?> On <?php }else{?> Off <?php }?></a> -->
               <a href="{{url('knowledgebasePostedDate')}}">
              <?php if($settingval[0]->posted_date==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>6</td>
            <td>Display Print</td>
            <td>
              <!-- <a href="{{url('knowledgebasePrint')}}"><?php if($settingval[0]->print ==1){?> On <?php }else{?> Off <?php }?></a> -->
               <a href="{{url('knowledgebasePrint')}}">
              <?php if($settingval[0]->print==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr>
            <td>7</td>
            <td>Display Save Post</td>
            <td>
              <!-- <a href="{{url('knowledgebaseSavePost')}}"><?php if($settingval[0]->save_post ==1){?> On <?php }else{?> Off <?php }?></a> -->
              <a href="{{url('knowledgebaseSavePost')}}">
              <?php if($settingval[0]->save_post==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr><td>8</td>
            <td>Display Tags</td>
            <td>
              <!-- <a href="{{url('knowledgebasetags')}}"><?php if($settingval[0]->tags ==1){?> On <?php }else{?> Off <?php }?></a> -->
               <a href="{{url('knowledgebasetags')}}">
              <?php if($settingval[0]->tags==1){echo '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></div>';}else{echo '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></div>';}?>
              </a>
            </td>
          </tr>
          <tr><td>9</td><td>Related Posts</td>
            <td>
             <a href="{{url('knowledgebaseRelatedpost')}}">
              @if($settingval[0]->related_post==1)
{!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
</div>' !!}
@else
{!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
</div>' !!}
               @endif
             </a> 
            </td>
          </tr>          
          <tr><td>10</td><td>Welcome Block</td>
            <td>
              <a href="{{url('knowledgebaseWelcomeblock')}}">
@if($settingval[0]->welcome_block==1)
{!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
</div>' !!}
@else
{!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
</div>' !!}
              @endif
              </a> 
            </td>
          </tr>    
          <tr><td>11</td><td>slider/Banner</td>
            <td>
              <a href="{{url('knowledgebaseSliderblock')}}">
                @if($settingval[0]->slider_block==1)
                {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @else
              {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
            </div>' !!}
            @endif
          </a> 
            </td>
          </tr>  
          <tr><td>12</td><td>Footer Social Media</td>
            <td>
              <a href="{{url('knowledgebaseFooterblock')}}">
                @if($settingval[0]->footer_block==1)
                {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @else
              {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
            </div>' !!}
            @endif
          </a> 
            </td>
          </tr>   
          <tr><td>13</td><td>Home Sidebar Area</td>
            <td>
  {{--               <a href="{{url('#')}}">
                  @if($settingval[0]->footer_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif
            </a> --}}
            </td>
          </tr>
          <tr><td>14</td><td>Internal Sidebar Area</td>
            <td>
         {{--        <a href="{{url('knowledgebaseFooterblock')}}">
                  @if($settingval[0]->footer_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif </a>--}}
            </td>
          </tr>          
          <tr><td>15</td><td>Featured Post</td>
            <td>
                <a href="{{url('knowledgebaseFeaturedblock')}}">
                  @if($settingval[0]->featured_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif
            </a>
            </td>
          </tr>       
          <tr><td>16</td><td>Categories</td>
            <td>
                <a href="{{url('knowledgebaseCategoryblock')}}">
                  @if($settingval[0]->category_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif
            </a>
            </td>
          </tr>         
          <tr><td>17</td><td>Search Field</td>
            <td>
                <a href="{{url('knowledgebaseSearchblock')}}">
                  @if($settingval[0]->search_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif
            </a>
            </td>
          </tr>       
          <tr><td>18</td><td>Address</td>
            <td>
     {{--            <a href="{{url('knowledgebaseSearchblock')}}">
                  @if($settingval[0]->search_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif </a>--}}
            </td>
          </tr>         
          <tr><td>19</td><td>Contact</td>
            <td>
     {{--            <a href="{{url('knowledgebaseSearchblock')}}">
                  @if($settingval[0]->search_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif </a>--}}
            </td>
          </tr>        
          <tr><td>20</td><td>Featured Image On View Page</td>
            <td>
              <a href="{{url('knowledgebaseviewImageblock')}}">
              @if($settingval[0]->viewimg_block==1)
              {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
            </div>' !!}
            @else
            {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
          </div>' !!}
          @endif 
        </a>
            </td>
          </tr>         
          <tr><td>21</td><td>Featured Image On Home Page</td>
            <td>
                 <a href="{{url('knowledgebasehomeImageblock')}}">
                  @if($settingval[0]->homeimg_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif 
            </a>
            </td>
          </tr>         
          <tr><td>22</td><td>Featured Image On List Page</td>
            <td>
   {{--               <a href="{{url('knowledgebaselistImageblock')}}">
                  @if($settingval[0]->listimg_block==1)
                  {!! '<div class ="text-success text-toggle-color"><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                </div>' !!}
                @else
                {!! '<div class="text-secondary"><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
              </div>' !!}
              @endif 
            </a> --}}
            <input data-id="toggle" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $settingval[0]->listimg_block===1 ? 'checked' : '' }}>
            </td>
          </tr>
        </tbody>
        
      </table>
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
 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var listimg_block = $(this).prop('checked') == 1 ? 1 : 0; 
        // var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route('list_image_block')}}',
            data: {'listimg_block': listimg_block},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
{{-- <script type="text/javascript">
  $('.confirmation').on('click', function () {
    return confirm('Are you sure want to delete?');
  });
</script> --}}
{{-- <script type="text/javascript">
   $(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#liknowledge").addClass('menu-open');        
        $("#ulknowledge").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#knowlagesetting").addClass("active");
      });
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

      if(confirm("Are you sure, you want to delete the selected users?")){  
        var strIds = idsArr.join(","); 
          $.ajax({
            url: "{{ route('social.multiple-delete') }}",
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids='+strIds,
            success: function (data) {
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
</script> --}} 
@endsection