<x-dashboard-layout>
    @section('title', 'Dashboard')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6 class="">Welcome Screen</h6>

            </div>
            <div class="display-5 text-center">
                <img src="{{ asset($template->logo) }}" alt="{{ $template->site_title }}">
                {{ $template->site_title }}
            </div>

        </div>

    </div>

    <!-- Current Stock Summary -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" style="margin-top: 30px;">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6>Current Stock Summary (By Category & Purity)</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover dataTable">
    <thead>
        <tr>
            <th>Category</th>
            <th>Purity</th>
            <th>Purchased Weight</th>
            <th>Sold Weight</th>
            <th>Balance Weight</th>
        </tr>
    </thead>

    <tbody>
        @foreach($stock as $row)
            <tr>
                <td>{{ $row['category_name'] }}</td>
                <td>{{ $row['purity_name'] }}</td>

                <td class="text-info font-weight-bold">
                    {{ number_format($row['purchased'], 3) }}
                </td>

                <td class="text-danger font-weight-bold">
                    {{ number_format($row['sold'], 3) }}
                </td>

                <td class="font-weight-bold {{ $row['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ number_format($row['balance'], 3) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
                <div class="row mb-4">
    @foreach($summary as $category => $data)
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header font-weight-bold">
                    {{ $category }} Stock Summary
                </div>

                <div class="card-body">
                    <ul class="list-group mb-3">
                        @foreach($data['purities'] as $purity => $weight)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $purity }}</span>
                                <strong class="{{ $weight >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($weight, 3) }} g
                                </strong>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-right font-weight-bold">
                        Total {{ $category }} Stock :
                        <span class="{{ $data['total'] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($data['total'], 3) }} g
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


            </div>
        </div>
    </div>

</x-dashboard-layout>
