<x-error-layout>
    @php
        $template = App\Models\SiteSetting::select('site_title')->find(1);
    @endphp
    @section('main')
    @section('title', '403 - Authentication error')



    <div class="container-fluid error-content">
      <div class="">
          <h1 class="error-number">403</h1>
          <p class="mini-text">Authentication error.</p>
          <p class="error-text mb-5 mt-1">The page you requested was not found!</p>
          <img src="{{asset('backend/assets/src/assets/img/error.svg')}}" alt="cork-admin-404" class="error-img">
          <a href="{{ url('/') }}" class="btn btn-dark mt-5">Go Back</a>
      </div>
  </div>


</x-front-layout>
