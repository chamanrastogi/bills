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
                        <x-backend.backend_component.supplier-report-form :$suppliers :$categories :$purities :$units
                            :isEdit="false" />

                        {{-- Report Table --}}
                        <div class="mt-4">
                            <h6 class="card-title fw-bold">Report Results</h6>
                            {{ $dataTable->table() }}

                            <div id="unit-summary" class="mb-3"></div>
                            <div id="category-purity-summary" class="mb-3"></div>
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

            $('#unit_id').select2({
                placeholder: 'Select a Unit',
                allowClear: true,
                width: '100%'
            });
$('#supplier-report-table').on('xhr.dt', function (e, settings, json) {

    if (!json.unitWiseTotal) return;

    /* =========================
       UNIT WISE SUMMARY (TABLE)
    ========================= */

    let html = `
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-2">
            <strong class="text-primary">
                <i data-feather="bar-chart-2" class="me-1"></i>
                Total Weight Summary (by Unit)
            </strong>
        </div>
        <div class="card-body p-2">
    `;

    if (json.unitWiseTotal.length === 0) {
        html += `
            <div class="text-center text-muted py-3">
                <i data-feather="alert-circle" class="mb-1"></i><br>
                No data available for selected filters
            </div>
        `;
    } else {
        html += `
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 py-1">Unit</th>
                            <th class="border-0 py-1 text-end">Total Weight</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        json.unitWiseTotal.forEach(row => {
            html += `
                <tr>
                    <td class="py-1">
                        <span class="badge bg-secondary">
                            ${row.unit ?? 'N/A'}
                        </span>
                    </td>
                    <td class="py-1 text-end">
                        <strong>${parseFloat(row.total_weight).toFixed(3)}</strong>
                    </td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;
    }

    html += `
        </div>
    </div>
    `;

    $('#unit-summary').html(html);

    /* =========================
       CATEGORY + PURITY SUMMARY
       (UNCHANGED)
    ========================= */

    let cpHtml = `
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-header bg-light py-2">
            <strong class="text-primary">
                <i data-feather="grid" class="me-1"></i>
                Total Weight Summary (by Category & Purity)
            </strong>
        </div>
        <div class="">
    `;

    if (!json.categoryPurityWiseTotal || json.categoryPurityWiseTotal.length === 0) {
        cpHtml += `
            <div class="text-center text-muted py-3">
                <i data-feather="alert-circle" class="mb-1"></i><br>
                No data available for selected filters
            </div>
        `;
    } else {
        cpHtml += `
            <div class="table-responsive">
                <table class="table table-striped dt-table-hover dataTable">
                    <thead class="bg-dark ">
                        <tr>
                            <th class="border-0 py-1 text-white">Category</th>
                            <th class="border-0 py-1 text-white">Purity</th>
                            <th class="border-0 py-1 text-white text-end">Total Weight</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        json.categoryPurityWiseTotal.forEach(row => {
            cpHtml += `
                <tr>
                    <td class="py-1">${row.category ?? 'N/A'}</td>
                    <td class="py-1">${row.purity ?? 'N/A'}</td>
                    <td class="py-1 text-end">
                        <strong>${parseFloat(row.total_weight).toFixed(3)}</strong>
                    </td>
                </tr>
            `;
        });

        cpHtml += `
                    </tbody>
                </table>
            </div>
        `;
    }

    cpHtml += `
        </div>
    </div>
    `;

    $('#category-purity-summary').html(cpHtml);

    // Re-render icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
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
        <script>
            $(document).ready(function() {
                $('#categories').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: '/admin/reports/get-types-purities/' + categoryId,
                            type: 'GET',
                            success: function(data) {

                                // Clear and populate purities
                                $('#purity_id').empty();
                                $('#purity_id').append(
                                '<option value="">--All Purities--</option>');
                                $.each(data.purities, function(key, value) {
                                    $('#purity_id').append('<option value="' + key + '">' +
                                        value + '</option>');
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error loading types and purities:', error);
                            }
                        });
                    } else {
                        // Reset to all options if no category selected
                        location.reload();
                    }
                });
            });
        </script>
    @stop


</x-dashboard-layout>
