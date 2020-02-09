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
      {{-- Google Recaptcha js file add --}}
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 
   </head>
   <script>
       function myFunction() {
           window.print();
       }
   </script>
   <body>

     @include('theme1/includes/header')
     <div class="container">
      <div class="row">
       <div class="col-md-12">
         <h3 class="block-title-internal mt-5 mb-4">Contact-Us</h3>
         <p>To contact us please use the form below. </p>
          @include('includes/flashmessage')
         @if(session('success'))
         <div class='col-lg-12 alert alert-success'>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{session('success')}}
         </div>
         @endif

         @if(session('error'))
         <div class='col-lg-12 alert alert-danger'>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{session('error')}}
         </div>
         @endif

         @if(session('info'))
         <div class='col-lg-12 alert alert-warning'>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{session('info')}}
         </div>
         @endif
       </div>
       <div class="col-md-9">
        <div class="row">
          <div class="col-md-7">
            <form name="createticket" action="{{url('contact-us')}}" method="post">
              {!! Form::open(array('url' => 'new-ticket.store', 'method' => 'post','role'=>'form')) !!}  
              {{csrf_field()}}

              <div class="form-group">
                <label for="name">First Name</label>

                {!! Form::text('name',null, array('class'=>'form-control','value'=>old('name'))) !!}
              </div>
              <div class="form-group">
                <label for="lname">Last Name</label>

                {!! Form::text('lname',null ,array('class' =>'form-control','value'=>old('lname'))) !!}
              </div>
              <div class="form-group">
                <label for="email">Email ID</label>

                {!! Form::email('email',null, array('class'=>'form-control','value'=>old('email'))) !!}
              </div>
              <div class="form-group">
                <label for="mobile">Mobile</label>

                {!! Form::text('mobile', null , array('class' =>'form-control','value'=>old('mobile'))) !!}
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>

                {!! Form::text('subject',null, array('class'=>'form-control','value'=>old('subject'))) !!}
              </div>
              <div class="form-group">

                <label for="description">Message</label>
                {!! Form::textarea('description',null, array('class'=>'form-control','rows'=>'3' ,'value'=>old('description'))) !!}
              </div>

              {{-- google reCaptcha --}}
              <div class="form-group">
              <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' is-invalid' : '' }}" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">                  
              </div>
                    @if($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>                
                        </span>
                    @endif
              </div>
              {{-- End tag --}}
              <button type="submit" class="btn btn-primary">Send</button>
              {!! Form::close() !!}  
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-3">
                    <aside id="text-1" class="widget widget_text mb-4">
                      <form role="search" method="post" class="search-form" action="{{url('/search')}}">
                        @csrf
                        <input type="search" class="form-control" placeholder="Search and hit enter..." name="searchArticle" title="Search for:">
                      </form>
                  </aside>
                  <aside id="text-2" class="widget widget_text mb-4">
                    <h3 class="widget-title">Welcome to KSPN</h3>
                    <div class="textwidget">
                      <img alt="avatar" src="http://marstheme.com/theme/saturn/wp-content/uploads/2014/12/about-1.png" class="float-right">
                      <p>Rig Veda muse about the carbon in our apple pies across the centuries quasar, cosmic fugue Apollonius of Perga permanence of the stars Vangelis.</p>
                    </div>
                  </aside>

                  {{-- category --}}
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
                      {{-- <a href="{{url('allcategory')}}"><p class="text-right" style="color: #FE9C46;">List categories</p></a> --}}
                      <a href="{{url('category')}}"><p class="text-warning">All categories</p></a>
                  </aside>
                  </div>
                  <!-- col-md-3 End -->
                </div>
              </div>
    </div>
  </div>


            @include('theme1.includes.mainFooter')
            <script src="{{('public/themes/theme1/assests/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('public/themes/theme1/assests/js/jquery-3.4.1.slim.min.js')}}"></script>
              <script>
              $("document").ready(function(){
                  setTimeout(function(){
                      $("div.alert").remove();
                  }, 5000 ); // 5 secs
              });
            </script>
  </body>
</html>