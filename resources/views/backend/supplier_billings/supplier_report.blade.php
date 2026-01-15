<x-dashboard-layout>
    @section('title', breadcrumb())

    @section('style')
        <link href="{{ asset('backend/assets/src/plugins/src/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    @stop

    @php
        // Dynamic model name passed from generation command
        $name = 'supplier';
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
                        <h6 class="card-title fw-bold">Show Purchase Report</h6>

                        {{-- Auto-generated form component --}}
                        {{-- Located at: resources/views/components/backend/backend_component/supplier-form.blade.php --}}
                        <x-backend.backend_component.supplier-report-form :$suppliers :$types :$categories :$purities
                            :$units :isEdit="false" />

                        {{-- Report Table --}}
                        <div class="mt-4">
                            <h6 class="card-title fw-bold">Report Results</h6>
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script src="{{ asset('backend/assets/src/plugins/src/select2/select2.min.js') }}"></script>
        <script>
            $('#suppliers').select2({
                placeholder: 'Select a Supplier',
                allowClear: true,
                width: '100%'
            });
             $('#categories').select2({
                placeholder: 'Select a Category',
                allowClear: true,
                width: '100%'
            });
            $('#metal_type_id').select2({
                placeholder: 'Select a Metal Type',
                allowClear: true,
                width: '100%'
            });
            $('#purity_id').select2({
                placeholder: 'Select a Purity',
                allowClear: true,
                width: '100%'
            });
            $('#unit_id').select2({
                placeholder: 'Select a Unit',
                allowClear: true,
                width: '100%'
            });
            $(document).ready(function() {

                $('#supplier-report-form').on('submit', function(e) {
                    e.preventDefault();

                    // Get form data
                    var formData = $(this).serialize();

                    // Update URL without reloading
                    var newUrl = $(this).attr('action') + '?' + formData;
                    window.history.pushState({}, '', newUrl);

                    // Reload the DataTable
                    $('#supplier-report-table').DataTable().ajax.reload();
                });
            });
        </script>

    @stop


</x-dashboard-layout>
