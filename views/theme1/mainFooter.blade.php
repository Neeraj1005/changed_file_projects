<footer class="footer bg-dark2 py-3 mt-4">
 @php
     use App\Content;
     use App\Menu;
     // $contentMenu = Content::with('menu')->get();
     $contentMenu = Menu::with('content')->where([['status','=',0],['delete_status','=',1],['menu_status','=',1]])->latest()->get();
     $contentMenu=$contentMenu->toArray();
     //dd($contentMenu);
     $server = Request::server ("SERVER_NAME");
     $year = date('Y');
     $checktruefalse = DB::table('knowledgebaseSetting')->get();
     $checktruefalse[0]->category;
     $checktruefalse[0]->author;
     $checktruefalse[0]->posted_date;
     $checktruefalse[0]->welcome_block;
     $checktruefalse[0]->slider_block;
     $checktruefalse[0]->footer_block;
 @endphp
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        {{-- <p class="copyright">2020<a href="{{url('/')}}">{{$server}}</a>All Rights Reserved</p> --}}
        <p class="copyright">2020<a href="{{url('/')}}">KSPN GROUP</a> All Rights Reserved</p>
        <p class="footer-nav">
          @foreach($contentMenu as $menu)
          {{-- @if($menu['menu']['status']==0) --}}
          {{-- <span><a href="{{url('contentview/'.$menu['slug'])}}">{{$menu['menu']['name']}}</a></span> --}}
          {{-- <span><a href="{{url('contentview/'.$menu['content']['slug'])}}">{{$menu['name']}}</a></span> --}}
          <span><a href="{{url(''.$menu['content_id'])}}">{{$menu['name']}}</a></span>
          {{-- @endif --}}
          @endforeach
        </p>
      </div>
    </div>
  </div>
</footer>
@if($checktruefalse[0]->footer_block==1)
<footer class="footer bg-dark py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="social-media-widget">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>
@endif