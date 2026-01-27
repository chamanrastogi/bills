<x-dashboard-layout>
    @section('title', breadcrumb())

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @section('style')
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/light/apps/invoice-preview.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/dark/apps/invoice-preview.css') }}">
    @stop


    @php
        $template = App\Models\SiteSetting::find(1);
        $modes = MODE;

    @endphp

    {{-- {{ dd($id) }} --}}
    <div class="seperator-header layout-top-spacing">
        <div class="invoice-actions-btn">

            <div class="invoice-action-btn">

                <div class="row">

                    <div class="col-xl-12 col-md-3 col-sm-6">
                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row invoice layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="doc-container">

                <div class="row">

                    <div class="col-xl-12">

                        <div class="invoice-container">
                            <div class="invoice-inbox">

                                <div id="ct" class="">

                                    <div class="invoice-container" id="invoiceSection">
                                        <div class="invoice-inbox">

                                            <div id="ct" class="">

                                                <div class="invoice">
                                                    <div class="content-section">

                                                        <div class="inv--head-section inv--detail-section">

                                                            <div class="row">


                                                            <div class="invoice-header text-center">
                                                                <img class="pb-3" src="{{ asset($template->logo) }}"
                                                                    alt="company">

                                                                <div class="h5"> {{ $template->address }}</div>
                                                                <div class="h4 text-dark btn bg-white border border-">
                                                                    {{ $template->site_title }}
                                                                </div>
                                                            </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--detail-section inv--customer-detail-section">

                                                            <div class="row">

                                                                <div
                                                                    class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Pro. Vimal Soni (Imiliya Wale)</p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                                    <h6 class=" inv-title">Customer Details</h6>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">

                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">GSTIN No :</span>
                                                                        {{ $template->gst }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Pan No :</span>
                                                                        {{ $template->pan_no }}
                                                                    </p>


                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Invoice Date :</span>
                                                                        {{ date('d-M-Y') }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Contact No :</span>
                                                                        {{ $template->support_phone }}
                                                                    </p>


                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                                    <p class="inv-customer-name">{{ $customer?->name }}
                                                                    </p>
                                                                    <p class="inv-street-addr">
                                                                        {{ $customer?->billing_address ? $customer?->billing_address : $customer?->address }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        {{ $customer?->email }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        {{ $customer?->phone }}
                                                                    </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--product-table-section">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Date</th>
                                                                            <th scope="col">Particular</th>
                                                                            <th scope="col">Type</th>
                                                                            <th scope="col">Bill Amount</th>
                                                                            <th scope="col">Debit</th>
                                                                            <th scope="col">Credit</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($mergedResults as $result)
                                                                            <tr>
                                                                                <td>{{ \Carbon\Carbon::parse($result['billing_created_at'])->format('d-m-Y') }}
                                                                                </td>
                                                                                <td>{{ ($result['grand_total']>0)? 'Sales' : $modes[$result['payment_mode']] }}</td>
                                                                                <td>{{ ($result['grand_total']>0)? 'Sales' : 'Recipt' }}</td>
                                                                                 <td>
                                                                                    @if ($result['debit_credit'] == 'Dr')
                                                                                        {{ MONEY }}
                                                                                        {{ number_format($result['grand_total'], 2) }}
                                                                                    @else
                                                                                        -
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($result['payment'] != 0)
                                                                                        {{ MONEY }}
                                                                                        {{ number_format($result['payment'], 2) }}
                                                                                    @else
                                                                                        -
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($result['debit_credit'] == 'Cr')
                                                                                        {{ MONEY }}
                                                                                        {{ number_format($result['payment'], 2) }}
                                                                                    @else
                                                                                        -
                                                                                    @endif
                                                                                </td>
                                                                                {{-- <td>{{ $modes[$result['payment_mode']] }}</td> --}}


                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="inv--total-amounts">
                                                            <div class="row mt-4">
                                                                <div class="col-sm-5 col-12 order-sm-0 order-1"></div>
                                                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                    <div class="text-sm-end">
                                                                        <div class="row">
                                                                            <div class="col-sm-8 col-7">
                                                                                <p>Total Billing :</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{MONEY}} {{number_format($customer->bills()->sum('grand_total'),2)}}
                                                                                </p>
                                                                            </div>




                                                                            <!-- Tax Calculation -->

                                                                            <div class="col-sm-8 col-7">
                                                                                <p>Payments :</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{MONEY}} {{number_format($customer->bills()->sum('payment'),2)}}
                                                                                </p>
                                                                            </div>


                                                                            <!-- Grand Total Calculation with Discount and Tax -->

                                                                            <div
                                                                                class="col-sm-8 col-7 grand-total-title">
                                                                                <p class="fw-bold">Closting Balance :</p>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 col-5 grand-total-amount">
                                                                                <p> {{MONEY}} {{number_format($customer->balance(),2)}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div
                                                            class="inv--detail-section inv--customer-detail-section pb-2">

                                                            <div class="row">

                                                                <div
                                                                    class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Company's Bank Details</p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                                    <h6 class=" inv-title"></h6>
                                                                </div>

                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-street-addr"><span
                                                                            class="inv-customer-name">Bank Name
                                                                            : </span>{{ $template->bank_name }}</p>
                                                                    <p class="inv-email-address"><span
                                                                            class="inv-customer-name">A/c H. N.
                                                                            : </span>{{ $template->bank_holder_name }}
                                                                    </p>
                                                                    <p class="inv-street-addr"><span
                                                                            class="inv-customer-name">IFSC Code
                                                                            : </span>{{ $template->bank_ifsc }}</p>
                                                                    <p class="inv-email-address"><span
                                                                            class="inv-customer-name">Account No
                                                                            : </span>{{ $template->bank_account }}</p>
                                                                    <p class="inv-email-address"><span
                                                                            class="inv-customer-name">Branch Name
                                                                            : </span>{{ $template->bank_branch }}</p>
                                                                    <p class="inv-email-address"><span
                                                                            class="inv-customer-name">UPI ID
                                                                            : </span>{{ $template->pan_no }}
                                                                    </p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                                    <img class="company-logo" style="width:125px"
                                                                        src="{{ asset($template->bank_qr_code) }}"
                                                                        alt="company">
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--note">

                                                            <hr>
                                                            <div class="row mt-4">
                                                                <div class="col-6 ">
                                                                    <div style="height:40px;"></div>
                                                                    <div>Goods Received By<br>Customer's Signature</div>
                                                                </div>

                                                                <div class="col-6 text-end">
                                                                    <div>Authorised / Certified Seal and Signature<br>
                                                                        <em>Authorised Signatory</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4">
                                                                <div
                                                                    class="col-sm-12 col-12 order-sm-0 order-1 text-center">
                                                                    <p>{{ $template->message }}</p>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>



                </div>

            </div>

        </div>
    </div>


    @section('script')
        <script>
            document.querySelector('.action-print').addEventListener('click', function(event) {
                event.preventDefault();
                window.print();
            });
        </script>
    @stop
</x-dashboard-layout>
