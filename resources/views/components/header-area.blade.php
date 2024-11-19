<header id="headerCntr">
  <div class="wrapper">
    <h1 class="logo"><a href="{{route('home')}}"><span><img src="{{asset(App\Models\SiteSetting::select('logo')->find(1)->logo)}}" alt=""></span> <span class="logotext">{{App\Models\SiteSetting::find(1)->site_title}}</span></a></h1>
    <div class="mobile_menu"> <a href="#nav" class="mobileMenu"><img src="{{asset('frontend/assets/images/mobile_menu.png')}}" alt=""></a> </div>


    <nav class="navbar">
      <ul>
        <li class="{{ (request()->is('/')==1) ? 'active'  :'' }}"><a href="{{route('home')}}">Home</a></li>
        @foreach(App\Models\Menu::select('url','title','type')->active(0)->get() as $menu)
        <li class="{{ active_class(($menu->url)) }} {{ ($menu->url == 'contact-us') ? 'contact':'' }}">
          <a href="{{ $menu->url!='#' &&  $menu->type ==2  ? route($menu->url) : $menu->url}}" {{$menu->type ==1 ?'target="_blank"' :''}}>{{$menu->title}} </a></li>
        @endforeach
      </ul>
    </nav>
  </div>
</header>
