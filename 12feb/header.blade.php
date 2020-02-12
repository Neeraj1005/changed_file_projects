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
              $content = Menu::with('content')->where([['status','=',1],['delete_status','=',1],['menu_status','=',1],['parent_id','=',0]])->latest()->get();
              @endphp

              <ul class="navbar-nav ml-auto">
                @foreach($content as $menu)
                
                @if($menu->children->count() > 0) {{-- first if start here --}}

                <div class="dropdown mt-2">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$menu->name}}
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    
                  {{-- ***Start foreach --}}  @foreach($menu->children as $submenu)
                    
                {{-- **Start if --}}    @if(is_numeric($submenu['content_id']))
                    <a class="dropdown-item" href="{{url('contentview/'.$submenu['content']['slug'])}}">{{$submenu->name}}</a>
                    @else
                    <a class="dropdown-item" href="{{url(''.$submenu['content_id'])}}">{{$submenu->name}}</a>
                  </li>
                  @endif {{-- End if** --}}
                 
                  @endforeach {{-- End foreach *** --}}
                </div>
              </div>


              @else {{-- first if-> else condition --}}

              <li class="nav-item">
                @if(is_numeric($menu['content_id']))
                <a class="nav-link" href="{{url('contentview/'.$menu['content']['slug'])}}">{{$menu['name']}}</a>
                @else
                <a class="nav-link" href="{{url(''.$menu['content_id'])}}">{{$menu['name']}}</a>
              </li>
              @endif  {{-- End first if condition --}}   

              @endif
              @endforeach   
            </ul>

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