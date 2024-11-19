<x-dashboard-layout>
    @section('title', 'Dashboard')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6 class="">Welcome Screen</h6>

            </div>
            <div class="display-5 text-center">
                <img src="{{ asset($template->logo) }}" alt="{{ $template->site_title }}">
                {{ $template->site_title }}</div>

        </div>

    </div>



</x-dashboard-layout>
