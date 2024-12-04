<x-dashboard-layout>
    @section('title', breadcrumb())

    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <h2 class="mb-4">Billing and Payments from {{ $startDate }} to {{ $endDate }}</h2>
                    @php
                        $modes = explode(',', MODE);
                    @endphp
                    
                        <table id="billing_ledger" class="table dt-table-hover">
                            <thead>
                                <tr>
                                    <th>Billing ID</th>
                                    <th>Grand Total (Dr)</th>
                                    <th>Payment (Cr)</th>
                                    {{-- <th>Payment Mode</th> --}}
                                    <th>Created Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mergedResults as $result)
                                    <tr>
                                        <td>{{ $result['billing_id'] }}</td>
                                        <td>
                                            @if ($result['debit_credit'] == 'Dr')
                                                {{ MONEY }} {{ number_format($result['grand_total'], 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result['debit_credit'] == 'Cr')
                                                {{ MONEY }} {{ number_format($result['payment'], 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        {{-- <td>{{ $modes[$result['payment_mode']] }}</td> --}}
                                        <td>{{ \Carbon\Carbon::parse($result['billing_created_at'])->format('d-m-Y') }}
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@section('script')
<script>
$(document).ready(function() {
$('#billing_ledger').DataTable({
              
       "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l  B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
       "<'table-responsive'tr>" +
       "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
       buttons: {
               buttons: [{
                       extend: 'copy',
                       className: 'btn btn-sm'
                   },
                   {
                       extend: 'csv',
                       className: 'btn btn-sm'
                   },
                   {
                       extend: 'excel',
                       className: 'btn btn-sm'
                   },
                   {
                       extend: 'print',
                       className: 'btn btn-sm'
                   }
               ]
           },
           "oLanguage": {
               "oPaginate": {
                   "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                   "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
               },
               "sInfo": "Showing page _PAGE_ of _PAGES_",
               "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
               "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
           },

           "lengthMenu": [
               [10, 25, 50, 100, 1000, 2000, 3000, 10000, -1],
               [10, 25, 50, 100, 1000, 2000, 3000, 10000]
           ],
           "pageLength": 10,
    } );
} );
</script>

@stop

</x-dashboard-layout>
