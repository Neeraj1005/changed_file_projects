@php
    use App\Seo;   
    use App\Frontlogo;  
    $seo = Seo::all()->first();   
    $flogo = Frontlogo::all()->first();

    $menu = DB::table('menus')->where('status',1)->get();   
    use App\Category;
    $category = Category::where('delete_status','=','1')->take(6)->get();
    use App\Article;
    use App\Favicon;
    $favicon = Favicon::all()->first();   
    $widget = App\widget::all()->first();
    $apper = $widget->position;
    use App\User;
    use Illuminate\Support\Str;
    use App\mediaLibrary;
    use App\Slider;
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

    @extends('theme1/includes/header')
    @section('header')
@if($checktruefalse[0]->slider_block==1)
<div class="header">
    <!--Header part start-->
    <div class="overlay"></div>
      
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="{{asset('public/themes/theme1/assests/coverr.mp4')}}" type="video/mp4">
    </video>

    {{--       @php
          $medialib = Slider::latest()->get();
          @endphp
          @foreach($medialib as $key => $media)
        <img src="{{url($media->filename)}}" class="d-block w-100"  alt="...">
          @endforeach --}}
    <div class="container h-100">
      <div class="d-flex h-100 text-center align-items-center">
        <div class="w-100 text-white">
          <h1 class="display-3">KSPN</h1>
          <p class="lead mb-0">Technology powered by imagination!</p>
        </div>
      </div>
    </div>
</div>
@endif
    @endsection
<!--Header part end-->
@php
$wherelatested = [
  ['delete_status','=','1'],
  ['article_status','=','1'],
];
$wherePopularArticle = [
  ['delete_status','=','1'],
  ['article_status','=','1'],
];
$latestArticle = Article::with('user')->where($wherelatested)->orderBy('id','desc')->take(5)->get()->toArray();
$polularArticle = Article::with('user')->orderBy('visit_count','desc')->where($wherePopularArticle)->take(5)->get()->toArray();

$whereFeatured = [
  ['delete_status','=','1'],
  ['article_status','=','1'],
  ['status','=','1']
];
$featured = Article::with('user')->orderBy('id','desc')->where($whereFeatured)->take(3)->get()->toArray();
@endphp
@section('content')
{{-- Featured post start --}}
@if($checktruefalse[0]->featured_block==1)
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center mx-auto">
      <h3 class="block-title text-center my-4">Featured Posts</h3>
    </div>
    
  </div>
  <div class="row">
    <div class="col-md-12 text-right small" style="margin-top: -40px;">
      {{-- <a href="{{url('morepopularArticle')}}">More Featured</a> --}}
      <a href="{{url('moreFeaturedArticle')}}" style="color: #FE9C46;">More Featured >>></a>
    </div>
  </div>
  <div class="row">
    @foreach($featured as $fea)
     @if($fea['user']['login_status']!=0) 
    <div class="col-md-4">
      <div class="featured-post">        
        @if(!empty($fea['image']))
        <a href="{{url('viewArticle/'.$fea['aslug'])}}">
        <img src="{{url('uploads/BlogImage/'.$fea['image'])}}" class="img-fluid img-fix" alt="..."></a>
        @else
        <a href="{{url('viewArticle/'.$fea['aslug'])}}">
        <img class="img-fluid img-thumbnail in-cat-img" align="left" src="{{url('uploads/BlogImage/No-Image-Available-article.jpg')}}" alt=""></a>
        @endif
        <h5 class="c-title"><a href="{{url('viewArticle/'.$fea['aslug'])}}">{{$fea['title']}}</a></h5>
        <p class="c-date">{{ \Carbon\Carbon::parse($fea['created_at'])->format('j F Y ')}}</p>
      </div>
    </div>
    @endif
    @endforeach
  </div>
</div>
@endif{{-- featured post end --}}
<!--Blog post part-->
@php
// $articleview = Article::latest()->get()->paginate(20);
$articleview = Article::with('user')->orderBy('id','desc')->whereHas('user', function($query) {
    $query->where('login_status', '=',1);
})->paginate(5);
@endphp
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="block-title mt-5 mb-4">Latest Posts</h3>
    </div>
    <div class="col-md-9">
      @foreach($articleview as $article)  
      @if($article['article_status']==1)
      <div class="latest-post mb-4">
        {{-- Featured image start --}}
        @if($checktruefalse[0]->homeimg_block===1)
        @if(!empty($article['image']))
        <a href="{{url('viewArticle/'.$article['aslug'])}}"><img src="{{url('uploads/BlogImage/'.$article['image'])}}" class="img-fluid" alt="..."></a>
        @else
        <a href="{{url('viewArticle/'.$article['aslug'])}}">
        <img class="img-fluid img-thumbnail in-cat-img" align="left" src="{{url('uploads/BlogImage/No-Image-Available-article.jpg')}}" alt=""></a>
        @endif  
        @endif{{--End featured Image  --}}
        <div class="card-body">
          @php      
          $user = User::find($article->user_id)
          @endphp
          {{-- Date format --}}
          <div class="blog-info mb-3"><span>{{ \Carbon\Carbon::parse($article['created_at'])->format('j F Y ')}}</span> <span>BY: {{$user->name}}</span> 
            @if($checktruefalse[0]->category ==1)
            {{-- Category name --}}
            <a href="{{url('articleViewMore/'.$article->slug)}}"><span>{{$article['category']['name']}}</span></a>
          @endif
          </div>
          <h5 class="blog-title"><a href="{{url('viewArticle/'.$article['aslug'])}}">{{$article['title']}}</a></h5>
          <p class="blog-desc">{!!  Str::substr($article['description'], 0,200);  !!}</p>
        </div>
      </div>
      @endif
      @endforeach


      <nav aria-label="...">
        <ul class="pagination pagination-sm  justify-content-center">
{{--           <li class="page-item">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li> --}}
{{--           <li class="page-item active">
            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
          </li> --}}
          <li class="page-item" aria-current="page">
            {{$articleview->links()}}
          </li>
          {{-- <li class="page-item"><a class="page-link" href="#">3</a></li> --}}
{{--           <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li> --}}
        </ul>
      </nav>
    </div>

    <div class="col-md-3">
      {{-- Search ON/OFF --}}
      @if($checktruefalse[0]->search_block===1)
      <aside id="text-1" class="widget widget_text mb-4">
        <form role="search" method="post" class="search-form" action="{{url('/search')}}">
          @csrf
          <input type="search" class="form-control" placeholder="Search and hit enter..." name="searchArticle" title="Search for:">
        </form>
      </aside>
      @endif
      {{-- Search ON/OFF end --}}
@if($checktruefalse[0]->welcome_block==1)
      <aside id="text-2" class="widget widget_text mb-4">
        <h3 class="widget-title">Welcome to KSPN</h3>
        <div class="textwidget">
          <img alt="avatar" src="http://marstheme.com/theme/saturn/wp-content/uploads/2014/12/about-1.png" class="float-right">
          <p>Rig Veda muse about the carbon in our apple pies across the centuries quasar, cosmic fugue Apollonius of Perga permanence of the stars Vangelis.</p>
        </div>
      </aside>
@endif

      <!--Categories section AND ON/OFF-->
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
      @endif {{-- End ON/Off --}}
    </div>
  </div>
</div>


<!-- end below header part--> 
 
<!-- Scripting Part And Footerpart-->
  @include('theme1.includes.mainFooter')
<script src="{{asset('public/themes/theme1/assests/js/jquery-3.4.1.slim.min.js')}}"></script>
<script src="{{('public/themes/theme1/assests/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
@endsection()