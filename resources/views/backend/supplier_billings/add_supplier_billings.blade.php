<x-main-layout>
    @section('title', breadcrumb())

    @php
        // Dynamic model name passed from generation command
        $name = 'supplier_billings';
         $title = Str::title(str_replace('_', ' ', $name));
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
                        <h6 class="card-title fw-bold">Add {{ $title }}</h6>

                        {{-- Auto-generated form component --}}
                        {{-- Located at: resources/views/components/backend/backend_component/supplier_billings-form.blade.php --}}
                        <x-backend.backend_component.supplier_billings-form :isEdit="false" :$supplier />
                    </div>
                </div>
            </div>
        </div>
    </div>
     @section('script')

    @stop
</x-main-layout>
