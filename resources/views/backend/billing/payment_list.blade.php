<x-dashboard-layout>
    @section('title', breadcrumb())

    <div class="page-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h2 class="mb-4">Billing and Payments from {{ $startDate }} to {{ $endDate }}</h2>
                        @php
                         $modes =explode(",",MODE);
                        @endphp
                    <div class="widget-content widget-content-area">
                        <table  class="table dt-table-hover">
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
                                        {{MONEY}}  {{ number_format($result['grand_total'], 2) }} 
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($result['debit_credit'] == 'Cr')
                                           {{MONEY}} {{ number_format($result['payment'], 2) }} 
                                        @else
                                            -
                                        @endif
                                    </td>
                                    {{-- <td>{{ $modes[$result['payment_mode']] }}</td> --}}
                                    <td>{{ \Carbon\Carbon::parse($result['billing_created_at'])->format('d-m-Y') }}</td>
                                    
                                </tr>
                            @endforeach
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>


</x-dashboard-layout>
