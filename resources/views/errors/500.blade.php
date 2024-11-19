<x-front-layout>
    @php
    $template = App\Models\SiteSetting::select('site_title')->find(1);
   @endphp
    @section('main')
    @section('title', '500 - Internal Server Error')

    @section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    @stop

    <div class="contactCntr">
        <div class="contactCntr">
            <div class="bannerimg"> </div>
            <!-- error area start -->
            <div class="wrapper">
                <div class="contact_details">
                    <div id="notfound">
                        <div class="notfound">
                            <div class="notfound-page">
                                <h1>500</h1>
                            </div>
                            <h2>Internal Server</h2>
                            <p>The page you are looking for doesn't exist</p>
                            <a href="{{ url('/') }}">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- error area end -->
        </div>
    </div>


</x-front-layout>
