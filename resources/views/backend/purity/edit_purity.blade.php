<x-main-layout>
    @section('title', breadcrumb())

    @php
        // Dynamic model name injected during generation
        $name = 'purity';
        $title = Str::title($name);
    @endphp

    <div class="seperator-header layout-top-spacing">
        <a href="{{ route($name . '.index') }}">
            <h4 class="">Show {{ $title }}</h4>
        </a>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Edit {{ $title }}</h6>

                        {{-- Auto-generated form component --}}
                        {{-- Located at: resources/views/components/backend/backend_component/purity-form.blade.php --}}
                        <x-backend.backend_component.purity-form :$purity :isEdit="true" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')

    @stop
</x-main-layout>
