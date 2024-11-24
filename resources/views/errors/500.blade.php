<x-error-layout>
    @php
    $template = App\Models\SiteSetting::select('site_title')->find(1);
    @endphp
    @section('main')
    @section('title', '500 - Internal Server Error')



    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">500</h1>
            <p class="mini-text">Internal Server</p>
            <p class="error-text mb-5 mt-1">The page you are looking for doesn't exist</p>
            <img src="{{asset('backend/assets/src/assets/img/error.svg')}}" alt="cork-admin-404" class="error-img">
            <a href="{{ url('/') }}" class="btn btn-dark mt-5">Go Back</a>
        </div>
    </div>


</x-error-layout>
