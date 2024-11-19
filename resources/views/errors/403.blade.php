<x-front-layout>
    @php
        $template = App\Models\SiteSetting::select('site_title')->find(1);
   @endphp
    @section('main')
    @section('title', '403 - Authentication error')


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
                        <h1>403</h1>
                     </div>
                     <h2 >Authentication error</h2>
                        <p >Forbidden – You don’t have permission to access / on this server
                            403 – Forbidden: Access is denied</p>
                      <a href="{{ url('/') }}">Go to Home</a>
                  </div>
               </div>
            </div>
         </div>
         <!-- error area end -->
      </div>
   </div>


</x-front-layout>
