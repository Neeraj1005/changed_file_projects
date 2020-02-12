<header class="">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
          @if($flogo['image']!=null)
          <a class="navbar-brand" href="{{url('/root')}}">
            <img src="{{url('uploads/logo/'.$flogo['image'])}}">
          </a>
          @endif
          <!--<a class="text-help" href="#" style="margin: 0 0 0 0;color: #808080;">Help</a>-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              @php
              use App\Content;
              use App\Menu;

              // $content = Menu::with('content')->where([['status','=',1],['delete_status','=',1],['menu_status','=',1]])->latest()->get();
              $content = Menu::with('content')->where([['status','=',1],['delete_status','=',1],['menu_status','=',1],['parent_id','=',0]])->latest()->get();
              // $content = Menu::where([['status','=',1],['delete_status','=',1]])->with('Content')->latest()->get();
              // $contentMenu=$content->toArray();

              // $contentD = Menu::with('content')->where([['status','=',1],['delete_status','=',1],['menu_status','=',1]])->latest()->get();
              // $contentDrop=$contentD->toArray();
              @endphp
            <ul class="navbar-nav ml-auto">
              @foreach($content as $menu)
        @if($menu->children->count() > 0)

        <div class="dropdown mt-2">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{$menu->name}}
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($menu->children as $submenu)
            {{-- <a class="dropdown-item" href="#">{{$submenu->name}}</a> --}}
              @if(is_numeric($submenu['content_id']))
              <a class="dropdown-item" href="{{url('contentview/'.$submenu['content']['slug'])}}">{{$submenu->name}}</a>
              @else
              <a class="dropdown-item" href="{{url(''.$submenu['content_id'])}}">{{$submenu->name}}</a>
            </li>
            @endif
            @endforeach
          </div>
        </div>
   {{--      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{$menu->name}}
            <b class="caret"></b></a>
            <ul class="dropdown-menu">
              @foreach($menu->children as $submenu)
              <li><a href="#">{{$submenu->name}}</a></li>
              @endforeach
            </ul>
          </li> --}}



               @else

{{--  --}}
                <li class="nav-item">
                  @if(is_numeric($menu['content_id']))
                  <a class="nav-link" href="{{url('contentview/'.$menu['content']['slug'])}}">{{$menu['name']}}</a>
                  @else
                  <a class="nav-link" href="{{url(''.$menu['content_id'])}}">{{$menu['name']}}</a>
                </li>
                @endif
              {{--  --}}
               
               @endif
                


              @endforeach   
            </ul>
{{-- @php
  $categories = Menu::with('content')->where([['status','=',1],['delete_status','=',1],['menu_status','=',1],['parent_id','=',0]])->latest()->get();
@endphp
            <ul class="navbar-nav ml-auto">
                  @foreach($categories as $item)
                  @if($item->children->count() > 0)
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      {{$item->name}}
                      <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        @foreach($item->children as $submenu)
                        <li><a href="#">{{$submenu->name}}</a></li>
                        @endforeach
                      </ul>
                    </li>
                    @else
                    <li><a href="">{{$item->name}}</a></li>
                    @endif
                    @endforeach
                  </ul> --}}


      {{--       @foreach($contentDrop as $menuDrop)
            <div class="dropdown">
              <a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">ad</a>
              </div>
            </div>
            @endforeach --}}
            <!--<div class=""> -->
            <div class="flex-center position-ref full-height">
              @if (Route::has('login'))
                <ul class="navbar-nav ml-auto">
                  @auth
                  <li>
                  <a class="nav-link" href="{{ url('/logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      Logout
                  </a>
                  </li>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                  </form>
                  @else
                  <li>
                    <a class="nav-link" href="{{ route('login') }}">Login</a></li>
                   <li><a class="nav-link" href="{{ route('register') }}">Register</a> 
                 </li>
                  @endauth
              </div>
              @endif
            </div>
          </ul>
        </div>
      </nav>
              @section('header')

              @show

    </header>
    @yield('content')