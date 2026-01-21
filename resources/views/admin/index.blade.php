<x-dashboard-layout>
    @section('title', 'Dashboard')

    <!-- Welcome -->
    <div class="col-xl-12 layout-spacing">
        <div class="widget widget-six text-center">
            <div class="widget-heading">
                <h6>Welcome Screen</h6>
            </div>

            <div class="display-5">
                <img src="{{ asset($template->logo) }}" alt="{{ $template->site_title }}">
            </div>
        </div>
    </div>

    <!-- Totals -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Purchased</h6>
                    <h4 class="text-info font-weight-bold">
                        {{ number_format($totalPurchased, 3) }} g
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Sold</h6>
                    <h4 class="text-danger font-weight-bold">
                        {{ number_format($totalSold, 3) }} g
                    </h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Current Balance</h6>
                    <h4 class="font-weight-bold {{ $totalBalance >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($totalBalance, 3) }} g
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Gold & Silver Totals -->
    <div class="col-xl-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6>Gold & Silver Balance Summary</h6>
            </div>

            <div class="table-responsive">
                <table id="gold-silver-table" class="table dt-table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Purchased</th>
                            <th>Sold</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($goldSilverData as $row)
                            <tr>
                                <td class="font-weight-bold">{{ $row['category'] }}</td>
                                <td class="text-info font-weight-bold">
                                    {{ number_format($row['purchased'], 3) }} g
                                </td>
                                <td class="text-danger font-weight-bold">
                                    {{ number_format($row['sold'], 3) }} g
                                </td>
                                <td class="font-weight-bold {{ $row['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($row['balance'], 3) }} g
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Stock Table -->
    <div class="col-xl-12 layout-spacing">
        <div class="widget widget-six">
            <div class="widget-heading">
                <h6>Current Stock Summary (By Category & Purity)</h6>
            </div>

            <div class="table-responsive">
                <table id="stock-table" class="table dt-table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Purity</th>
                            <th>Purchased</th>
                            <th>Sold</th>
                            <th>Balance</th>
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
            </div>
        </div>
    </div>

    <!-- Category Summary -->
    <div class="row mb-4">
        @foreach($summary as $category => $data)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header font-weight-bold">
                        {{ $category }} Summary
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
                            Total {{ $category }} :
                            <span class="{{ $data['total'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($data['total'], 3) }} g
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @section('script')
    <script>
        $(document).ready(function () {

            $('#stock-table').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'btn' },
                        { extend: 'csv', className: 'btn' },
                        { extend: 'excel', className: 'btn' },
                        { extend: 'print', className: 'btn' }
                    ]
                },
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 10
            });


            $('#gold-silver-table').DataTable({
               "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                    "<'table-responsive'tr>" +
                    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'btn' },
                        { extend: 'csv', className: 'btn' },
                        { extend: 'excel', className: 'btn' },
                        { extend: 'print', className: 'btn' }
                    ]
                },
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 10
            });
            console.log('DataTables initialized.');
        });
    </script>
@stop
</x-dashboard-layout>
