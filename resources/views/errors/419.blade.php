<x-front-layout>
      @php
        $template = App\Models\SiteSetting::select('site_title')->find(1);
    @endphp
    @section('main')
    @section('title', '419 - Page Expired')


    @section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    @stop
    <!-- error area end -->
    <div class="contactCntr">
      <div class="contactCntr">
         <div class="bannerimg"> </div>
         <!-- error area start -->
          <div class="wrapper">
            <div class="contact_details">
         <div id="notfound">
            <div class="notfound">
               <div class="notfound-page">
                  <h1>419</h1>
               </div>
               <h2>Page Expired</h2>
               <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
               <a href="{{ url('/') }}">Go to Home</a>
            </div>
         </div>
         </div>
         </div>
         <!-- error area end -->
      </div>
   </div>


</x-front-layout>
