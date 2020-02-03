@php
use App\Seo;   

use App\Frontlogo;  

$seo = Seo::all()->first();   

$flogo = Frontlogo::all()->first();

$menu = DB::table('menus')->where('status',1)->get();   

use App\Category;

$category = Category::all();

use Illuminate\Support\Str;

use App\User;
use App\Favicon;
$favicon = Favicon::all()->first();   
// category check active or not
$category = Category::where('delete_status','=','1')->take(6)->get();
$checktruefalse = DB::table('knowledgebaseSetting')->get();
$checktruefalse[0]->category;
$checktruefalse[0]->author;
$checktruefalse[0]->posted_date;
$checktruefalse[0]->welcome_block;
$checktruefalse[0]->slider_block;
$checktruefalse[0]->footer_block;
$checktruefalse[0]->featured_block;
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
   <body>
    @include('theme1/includes/header')
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="block-title-internal mt-5 mb-4">More Featured</h3>
            </div>
            <div class="col-md-9">
                <div class="row">
            @foreach($featuredArticle as $article) 
                  <div class="col-md-12">
                    <ul class="list-unstyled">
                      <li class="media">

{{-- Featured Image ON/OFF --}}@if($checktruefalse[0]->listimg_block===1)
                        @if(!empty($article->image))
                        <a href="{{url('viewArticle/'.$article->aslug)}}"><img src="{{url('uploads/BlogImage/'.$article->image)}}" class="mr-3 related-img-category" alt="..."></a>
                        @else
                        <a href="{{url('viewArticle/'.$article->aslug)}}"><img src="{{url('uploads/BlogImage/No-Image-Available-article.jpg')}}" class="mr-3 related-img-category" alt="..."></a>
                        @endif
                        @endif {{--Featured Image ON/OFF end --}}

                        <div class="media-body">
                          <h5 class="mt-0 mb-1"><a href="{{url('viewArticle/'.$article->aslug)}}">{{$article->title}}</a></h5>
                          <p>{!!  Str::substr($article->description, 0,225);  !!}</p>
              
                          @php
                          $cat = Category::find($article->category_id) ;
                          $user = User::find($article->user_id);
                          @endphp

                          {{-- Date format --}}
                          {{-- Date format --}}
                          <div class="blog-info-footer mb-3">
                            @if($checktruefalse[0]->posted_date==1)
                            <span>{{ \Carbon\Carbon::parse($article['created_at'])->format('j F Y ')}}</span>
                            @endif                          
{{-- OR othe method for date --}}
            {{--                 <div class="blog-info-footer mb-3">
                            <span>{{ \Carbon\Carbon::parse($article['created_at'])->format('j F Y ')}}</span> And other method--}}
                            


                            {{-- User name format --}}
                            {{--If errors occurs comment bleow code and uncomment this=>  <a href="#"> <span class="auth"><i class="fa fa-industry know-icons" aria-hidden="true"></i> {{$cat['name']}}</span></a> --}}
                            @if(!empty($user->image))
                            <span><a href="#"><img src="{{url('uploads/Profile/admin/'.$user->image)}}" align="left" class="img-fluid profile-img" alt="..."> {{$user->name}}</a></span>
                            @else
                            <span><a href="#"><img src="{{url('uploads/Profile/admin/no-image.png')}}" align="left" class="img-fluid profile-img" alt="..."> {{$user->name}}</a></span>
                            @endif
                            


                            {{-- Category name start --}}
                            
                            <span><a href="{{url('articleViewMore/'.$cat->slug)}}">{{$cat['name']}}</a></span>
                           
                            {{-- Category name end --}}
                        </div>
                    </div>
                </li>      
            </ul>
        </div>
@endforeach
    </div>
</div>
            <!-- col-md-9 End and loop ends-->


            {{-- Search And Category --}}
@if($checktruefalse[0]->search_block===1)
            <div class="col-md-3">
              <aside id="text-1" class="widget widget_text mb-4">
                <form role="search" method="post" class="search-form" action="{{url('/search')}}">
                  @csrf
                  <input type="search" class="form-control" placeholder="Search and hit enter..." name="searchArticle" title="Search for:">
                </form>
            </aside>
@endif
            {{-- category --}}
{{-- Cat ON/OFF --}}@if($checktruefalse[0]->category_block===1)
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
            @endif {{-- End ON/OFF categories --}}

            </div>
            <!-- col-md-3 End -->
          </div>
        </div>


        @include('theme1.includes.mainFooter')
<script src="{{asset('public/themes/theme1/assests/js/jquery-3.4.1.slim.min.js')}}"></script>
<script src="{{('public/themes/theme1/assests/js/bootstrap.bundle.min.js')}}"></script>







       
   </body>
   </html>