<x-dashboard-layout>
    @section('title', breadcrumb())
    @php
        $name = 'purity';
    @endphp
    <div class="seperator-header layout-top-spacing">
        <a href="{{ route($name.'.create') }}">
            <h4 class="">Add {{ Str::title($name) }}</h4>
        </a>
    </div>
    <div class="page-content">


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">All {{ Str::title($name) }}</h6>

                        <div class="table-responsive">
                             {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @section('script')
        {!! $dataTable->scripts() !!}
          <x-scripts.common-table-actions
          :delete-route="route($name . '.delete')"
        :status-route="route($name . '.status')"
    />
    @stop
</x-dashboard-layout>
