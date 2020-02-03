@php
    use App\Seo;   
    use App\Frontlogo;  
    $seo = Seo::all()->first();   
    $flogo = Frontlogo::all()->first();
    $menu = DB::table('menus')->where('status',1)->get();   
    use App\Category;
    // $category = Category::all();
    $category = Category::where('delete_status','=','1')->take(6)->get();
    use Illuminate\Support\Str;
    use App\User;
    use App\Favicon;
    $favicon = Favicon::all()->first();   
    use App\ArticleFeedback; 
    $checktruefalse = DB::table('knowledgebaseSetting')->get();
    $checktruefalse[0]->category;
    $checktruefalse[0]->author;
    $checktruefalse[0]->posted_date;
    $checktruefalse[0]->save_post;
    $checktruefalse[0]->print;
    $checktruefalse[0]->views;
    $checktruefalse[0]->tags;
    $checktruefalse[0]->like_unlike;
    $checktruefalse[0]->related_post;
    $checktruefalse[0]->category_block;
    $checktruefalse[0]->search_block;
    $checktruefalse[0]->viewimg_block;
@endphp
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="{{$seo['meta_desc']}}">
      <meta name="author" content="">
      <title>{{$seo['site_title']}}</title>
      @if($favicon['image']!=null)
      <link rel="icon" href="{{url('uploads/logo/'.$favicon->image)}}" type="image/x-icon" />
      @endif
      {{-- Font --}}
      <link href="fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <script src="https://kit.fontawesome.com/a2189951ff.js" crossorigin="anonymous"></script>
      <!-- Bootstrap core CSS -->
      <link href="{{asset('public/themes/theme1/assests/css/bootstrap.min.css')}}" rel="stylesheet"> 
      <link href="{{asset('public/themes/theme1/assests/css/carousel.css')}}" rel="stylesheet">       
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="{{asset('public/themes/theme1/assests/css/custom.css')}}" rel="stylesheet">
 
   </head>
   <script>
       function myFunction() {
           window.print();
       }
   </script>
   <body>

    {{-- Later rename extends into include and remove section start and end part --}}
    {{-- @extends('theme1/includes/header') --}}
    @include('theme1/includes/header')
    <!--Header part start-->
{{--     @section('header')

    <div class="overlay"></div>
      
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="{{asset('public/themes/theme1/assests/coverr.mp4')}}" type="video/mp4">
    </video>
    <div class="container h-100">
      <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white">
          <h1 class="display-3">KSPN</h1>
          <p class="lead mb-0">Technology powered by imagination!</p>
        </div>
      </div>
    </div>
    @endsection --}}


<!--Header part end-->
{{-- @section('content') --}}
<!--Body part start-->
    <div class="container">
      <div class="row blog-img">
        @if($totaltag>0)
        <div class="col-md-12">
          <h3 class="block-title-internal mt-5 mb-4">{{$articleview[0]['title']}}</h3>
        </div>
        
        <div class="col-md-12">
        <div class="blog-info-footer mb-3">
            @if($checktruefalse[0]->posted_date==1)
            <span>{{ \Carbon\Carbon::parse($articleview[0]['created_at'])->format('j F Y ')}}</span>
            @endif

            @if($checktruefalse[0]->author ==1)
                @if(!empty($articleview[0]['user']['image']))
            <span><a href="#"><img src="{{url('uploads/Profile/admin/'.$articleview[0]['user']['image'])}}" align="left" class="img-fluid profile-img" alt="..."> {{$articleview[0]['user']['name']}}</a></span>
                @else
            <span><a href="#"><img src="{{url('uploads/Profile/admin/noImage-agent.jpg')}}" align="left" class="img-fluid profile-img" alt="..."> {{$articleview[0]['user']['name']}}</a></span>
                @endif
            @endif
            
            {{-- Category name start --}}
            @if($checktruefalse[0]->category ==1)
            @php
            $categorySlug = $articleview[0]['category']['slug']
            @endphp
            <a href="{{url('articleViewMore/'.$categorySlug)}}"><span>{{$articleview[0]['category']['name']}}</span></a>
            @endif
            {{-- Category name end --}}

        </div>
        </div>
        <div class="col-md-9">
          <div class="latest-post mb-4">
{{-- Featured image start --}}
@if($checktruefalse[0]->viewimg_block===1)
            @if(!empty($articleview[0]['image']))
            <img src="{{url('uploads/BlogImage/'.$articleview[0]['image'])}}" class="img-fluid" alt="...">
            @else
            <img class="img-fluid" src="{{url('uploads/BlogImage/No-Image-Available-article.jpg')}}" alt="">
            @endif
@endif
{{-- Featured image End --}}
            <div class="card-body">
              <p class="blog-desc">{!! $articleview[0]['description'] !!}</p>
            </div>
            
            <div class="card-footer">
            <div class="blog-info-with-border">
            <div class="float-left">

                <?php
                      if($checktruefalse[0]->like_unlike==1){
                      $clientIP = request()->ip();
                      $whereFilter = [
                              ['ipaddress','=',$clientIP],
                              ['article_id','=', $articleview[0]['id']],
                              
                      ];

                      $count = ArticleFeedback::where($whereFilter)->count();
                      $feedback = ArticleFeedback::where($whereFilter)->get();
                      
                      if($count>0){

                          if($feedback[0]['like']==1){?>

                            

                            <span id="thumbsup"><i class="fas fa-thumbs-up"></i>  <?php echo $articleview[0]['thumbsup'];?></span>
                         <?php }if($feedback[0]['deslike']==1){?>
                          <span id="thumbsdown"> <i class="fas fa-thumbs-down"></i> <?php echo ($articleview[0]['thumbsdown']) ;?></span>


                           <?php }if($feedback[0]['like']==0){?>
                              {{'amresh'}}
                            <span><a href="JavaScript:Void(0);"  id="aa" onClick = " articleThumbsup(<?php echo $articleview[0]['id']; ?>)"><i class="fas fa-thumbs-up"></i>  <?php echo $articleview[0]['thumbsup']?></a></span>

                             <?php }if($feedback[0]['deslike']==0){?>
                              {{'amresh'}}
                              <span> <a href="JavaScript:Void(0);" id="bb" onClick="articleThumbsdown(<?php echo $articleview[0]['id'];?>);" ><i class="fas fa-thumbs-down"></i> <?php echo ($articleview[0]['thumbsdown'])?> </a>  </span>
                         <?php }

                      }else{?>

                           <span><a href="JavaScript:Void(0);"  id="aa" onClick = " articleThumbsup(<?php echo $articleview[0]['id']; ?>)"><i class="fas fa-thumbs-up"></i>  0 </a></span>

                      <span> <a href="JavaScript:Void(0);" id="bb" onClick="articleThumbsdown(<?php echo $articleview[0]['id'];?>);" ><i class="fas fa-thumbs-down"></i> 0 </a>  </span>
                   <?php   }
                      }
                      ?>
            {{-- <span><a href="#"><i class="fas fa-thumbs-up"></i> Like</a></span>
            <span><a href="#"><i class="fas fa-thumbs-down"></i> Dislike</a></span> --}}
            </div>
            
            <div class="float-right">
            @if($checktruefalse[0]->save_post==1)
            <span><a href="{{url('saveArticle/'.$articleview[0]['id'])}}"><i class="fas fa-save"></i> Save</a></span>
            @endif

            @if($checktruefalse[0]->print==1)
            <span><a href="{{url('printArticle/'.$articleview[0]['title'])}}"><i class="fa fa-print" aria-hidden="true"></i> Print</a></span>
            @endif

            @if($checktruefalse[0]->views==1)
            <span><i class="fa fa-eye" aria-hidden="true"></i> {{$articleview[0]['visit_count'] }} </span>
            @endif

{{-- Future work Tags field --}}
{{--              @if( $checktruefalse[0]->tags==1)
             @if(!empty($tag[0]['name']))
               <div class="tags">  
                  Tagged
                 @foreach(explode(',',$tag[0]['name']) as $tag)
                  <a href="{{url('knowledgebase/'. str_slug($tag, '-'))}}" class="tagged" >{{ str_slug($tag, '-')}}</a>

                 @endforeach
                 </div>
               @endif
            @endif --}}

            </div>
            </div>
            </div>
          </div>
          @else

          <div>Not Found</div>

          @endif


    {{-- Related post section  Status ON--}}
@if($checktruefalse[0]->related_post==1)
            @if(!$articleRelatedCategory->isEmpty())
              <div class="row">
                  <div class="col-md-12">
                    <h3 class="block-title-sub-internal mb-4">Related Posts</h3>
                    @foreach($articleRelatedCategory as $ra)
                    <ul class="list-unstyled">
                        <li class="media">
                            @if(!empty($ra->image))
                          <img src="{{url('uploads/BlogImage/'.$ra->image)}}" class="mr-3 related-img" alt="...">
                            @else
                          <img src="{{url('uploads/BlogImage/No-Image-Available-article.jpg')}}" class="mr-3 related-img" alt="...">
                            @endif
                          <div class="media-body">
                            <h5 class="mt-0 mb-1"><a href="{{url('viewArticle/'.$ra->aslug)}}">{{$ra->title}}</a></h5>
                            <p>{!!  Str::substr($ra['description'], 0,240);  !!}</p>
                        </div>
                    </li>
                </ul>
            @endforeach
            </div>
        </div>
        @else
        <div>No Related Posts</div>            
            @endif
@endif
{{-- Status off --}}
{{--             @else

            <div>Not Found</div>

            @endif --}}
    </div><!--col md-9 end-->

    {{-- Search Box AND Category List --}}
        <div class="col-md-3">
    @if($checktruefalse[0]->search_block===1)
          <aside id="text-1" class="widget widget_text mb-4">
            <form role="search" method="post" class="search-form" action="{{url('/search')}}">
              @csrf
              <input type="search" class="form-control" placeholder="Search and hit enter..." name="searchArticle" title="Search for:">
            </form>
        </aside>
        @endif

        @if($checktruefalse[0]->category_block===1)
        <aside id="text-3" class="widget widget_text mb-4">
            <h3 class="widget-title">Categories</h3>
            <div class="textwidget">
              @foreach($category as $cat)
              @php
              $count = DB::table('articles')->where('category_id','=',$cat->id)->count();
              @endphp
                <p><a href="{{url('articleViewMore/'.$cat->slug)}}">{{$cat->name}} </a>[{{($count)}}]</p>
              @endforeach
            </div>
              <a href="{{url('category')}}"><p class="text-right" style="color: #FE9C46;">All categories</p></a>
        </aside>
        @endif
        </div>
    <!-- col-md-3 End -->
    </div>
</div>
<script type="text/javascript">
     function articleThumbsup(id){
        
      var value = id;
      
      if(value) {
        $.ajax({
            url: "{{ route('articles.thumbsup') }}",
              type: 'GET',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: 'ids=' +value,
              dataType: "json",
                success:function(data) {
                 // console.log(data);
                  //$("#thumbsup").text(value);
                  //alert(data.ip);
                   $("#aa").html('<i class="fas fa-thumbs-up text-success"></i> '+data.thumbsup);
                   $("#aa").attr('onClick','return false');
                   $("#bb").attr('onClick','return false');
                   
                }
            });
        }
     }

     function articleThumbsdown(id){
        
        var value = id;
      if(value) {
        $.ajax({
            url: "{{ route('articles.thumbsdown') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              type: 'GET',
              data: 'ids='+value,
              dataType: "json",
                success:function(data) {
                  //console.log(data);
                  //alert(data.thumbsdown);
                  $("#bb").html('<i class="fas fa-thumbs-down text-danger"></i> '+data.thumbsdown);
                   $("#bb").attr('onClick','return false');
                   $("#aa").attr('onClick','return false');
                }
            });
        }

     }
    
</script>
<script src="{{asset('public/themes/theme1/assests/js/jquery-3.4.1.slim.min.js')}}"></script>
<script src="{{asset('public/themes/theme1/assests/js/bootstrap.bundle.min.js')}}"></script>
       {{-- @endsection() --}}
       @include('theme1.includes.mainFooter')
   </body>
   </html>