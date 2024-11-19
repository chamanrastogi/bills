@props(['template'])
@php
    $modal = App\Models\SiteSetting::select(
        'company_address',
        'email',
        'support_phone',
        'facebook',
        'twitter',
        'gplus',
        'linkdin',
        'map',
        'about',
        'copywrite',
    )->find(1);
	$phone = str_replace('-', '', $modal->support_phone);


@endphp
<footer id="footerCntr">
    <div class="inner_bg">
        <div class="wrapper">
            <div class="contact">
                <h3>Contact us</h3>
                <p>Office Address:<br>
                    {!! $modal->company_address !!}<br></p>
                <p>Email ID: <span><a href="mailto:{{ $modal->email }}">{{ $modal->email }}</a></span></p>
                <p>Contact No: <a href="tel:{{ '+91'.$phone }}">+91-{{ $phone }}</a></p>
                <div class="search">
                    <input name="email" type="text" class="input" value="Email Address" />
                    <input name="signup" type="button" class="button" value="Sign up" />
                </div>
                <div class="social">

                    <a href="{{ $modal->facebook }}" class="fb" target="_blank"></a>
                    <a href="{{ $modal->twitter }}" class="tw" target="_blank"></a>
                    <a href="{{ $modal->gplus }}" class="gplus" target="_blank"></a>
                    <a href="{{ $modal->linkdin }}" class="linkdin" target="_blank"></a>
                </div>
            </div>
            <div class="about">
                <h3>About us</h3>
                <p>{{ $modal->about }}
                    <a href="{{ route('about-us') }}">Read More</a>
                </p>
            </div>
            <div class="map"> <img src="{{ asset($modal->map) }}" alt="F-map" /> </div>
            <div class="bottom_details">
                <ul class="link">
                    <li><a href="{{ route('home') }}">Home</a></li>

                    @foreach (App\Models\Menu::select('title', 'url')->where('group_id', 1)->where('status', 0)->where('type', 2)->get() as $menu)
                        <li><a href="{{ $menu->url }}">{{ $menu->title }}</a></li>
                    @endforeach

                </ul>
                <p>© {{ $modal->copywrite }}</p>
            </div>
        </div>
    </div>
</footer>
