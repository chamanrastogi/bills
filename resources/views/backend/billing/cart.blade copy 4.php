<x-dashboard-layout>
    @section('title', breadcrumb())

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @section('style')
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/light/apps/invoice-preview.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/dark/apps/invoice-preview.css') }}">
    @stop


    @php

        $cart = json_decode($billing['cart']);
        $i = 1;
        $customer = App\Models\Customer::find($billing['customer_id']);
        $bill = App\Models\Billing::find($billing['id']);
        $subtotal = 0;

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

                                                            <div class="invoice-header text-center">
                                                                <img class="company-logo"
                                                                    src="{{ asset($template->logo) }}" alt="company">
                                                                <div class="h4 text-dark">{{ $template->site_title }}
                                                                </div>
                                                                <div class="p"> {{ $template->address }}</div>
                                                            </div>
                                                            <hr>


                                                            <div class="row">

                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">GSTIN No :</span>
                                                                        09BBJPA6980N1Z1
                                                                    </p>

                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Invoice No :</span>
                                                                        B2B316
                                                                    </p>

                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Invoice Date :</span>
                                                                        31-Aug-2024
                                                                    </p>

                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">State :</span>
                                                                        Uttar Pradesh (09)
                                                                    </p>

                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Date of Supply :</span>
                                                                        31-Aug-2024
                                                                    </p>


                                                                </div>

                                                                <div class="col-sm-6 text-sm-end">
                                                                    {{-- <p>
                                                                        <span class="fw-bold">IRN No :</span>
                                                                        <span>19b3c011c08f34ef22ff86ea...
                                                                            (truncated)</span>
                                                                    </p>

                                                                    <p>
                                                                        <span class="fw-bold">ACK No :</span>
                                                                        <span>142415551004600</span>
                                                                    </p>

                                                                    <p>
                                                                        <span class="fw-bold">ACK Date :</span>
                                                                        <span>2024-08-31</span>
                                                                    </p>

                                                                    <p>
                                                                        <span class="fw-bold">Place of Supply :</span>
                                                                        <span>Madhya Pradesh</span>
                                                                    </p> --}}
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="inv--detail-section inv--customer-detail-section">

                                                            <div class="row">

                                                                <div
                                                                    class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Details of Receiver | Bill To</p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                                    <h6 class=" inv-title">Details of Consignee :
                                                                        Shipped to</h6>
                                                                </div>

                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name">{{ $customer?->name }}
                                                                    </p>
                                                                    <p class="inv-street-addr">{{ $customer?->address }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer?->email }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer?->phone }}
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
                                                                            <th scope="col">S.No</th>
                                                                            {{-- <th scope="col">Category</th> --}}
                                                                            <th scope="col" class="px-3 text-start">
                                                                                Description of Goods</th>
                                                                            <th scope="col" class="px-2">Unit</th>
                                                                            {{-- <th scope="col">Gross</th> --}}
                                                                            <th scope="col">Net</th>
                                                                            <th class="text-end" scope="col">Qty</th>
                                                                            <th class="text-end" scope="col">Rate
                                                                            </th>
                                                                            {{-- <th class="text-end" scope="col">GST %
                                                                            </th>
                                                                            <th class="text-end" scope="col">GST Amt
                                                                            </th> --}}
                                                                            {{-- <th class="text-end" scope="col">Making
                                                                            </th> --}}
                                                                            <th class="text-end" scope="col">Amount
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($cart as $item)
                                                                            @php
                                                                                $product = App\Models\Product::with(
                                                                                    'unit',
                                                                                    'type',
                                                                                )->find(
                                                                                    $item->productId ??
                                                                                        ($item->product_id ?? null),
                                                                                );
                                                                                $productPrice = floatval(
                                                                                    $item->price ??
                                                                                        ($product->price ?? 0),
                                                                                );
                                                                                $quantity = floatval(
                                                                                    $item->quantity ??
                                                                                        ($item->qty ?? 1),
                                                                                );
                                                                                $gstPercent = floatval(
                                                                                    $item->gst ?? ($product->gst ?? 0),
                                                                                );
                                                                                $lineBase = $productPrice * $quantity;
                                                                                $gstAmount = round(
                                                                                    $lineBase * ($gstPercent / 100),
                                                                                    2,
                                                                                );
                                                                                $making = floatval(
                                                                                    $item->making ??
                                                                                        ($product->making_charge ?? 0),
                                                                                );
                                                                                $lineTotal = round(
                                                                                    $lineBase + $gstAmount + $making,
                                                                                    2,
                                                                                );
                                                                                $subtotal += $lineBase + $making;
                                                                                $productGrandTotal = $item->grandTotal;
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $i++ }}</td>
                                                                                {{-- <td>{{ $product->category->name ?? '-' }} --}}
                                                                                </td>
                                                                                <td>
                                                                                    <strong>{{ $product->name ?? ($item->name ?? '-') }}</strong>
                                                                                    <div class="text-muted small">
                                                                                        {{ $product->sku ?? ($item->sku ?? '') }}<br>
                                                                                        <span
                                                                                            class="fw-bold">Making</span>:{{ $item->making ?? 0 }}<br>
                                                                                        <span
                                                                                            class="fw-bold">GST:</span>{{ $item->gst ?? 0 }}%<br>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $product->unit->name ?? '-' }}
                                                                                </td>
                                                                                {{-- <td>{{ isset($product->gross_weight) ? number_format($product->gross_weight, 3) : '-' }}
                                                                                </td> --}}
                                                                                <td>{{ isset($product->net_weight) ? number_format($product->net_weight, 3) : '-' }}
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    {{ number_format($quantity, 3) }}
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    {{ number_format($productPrice, 2) }}
                                                                                </td>
                                                                                {{-- <td class="text-end">
                                                                                    {{ number_format($gstPercent, 2) }}
                                                                                </td> --}}
                                                                                {{-- <td class="text-end">
                                                                                    {{ number_format($gstAmount, 2) }}
                                                                                </td> --}}
                                                                                {{-- <td class="text-end">
                                                                                    {{ number_format($making, 2) }}
                                                                                </td> --}}
                                                                                <td class="text-end">
                                                                                    {{ number_format($productGrandTotal, 2) }}
                                                                                </td>
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
                                                                                <p>Sub Total :</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{ MONEY }}{{ number_format($billing['grand_total'], 2) }}
                                                                                </p>
                                                                            </div>

                                                                            <div class="col-sm-8 col-7">
                                                                                <p>GST Total :</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{ MONEY }}{{ number_format($billing['gst'] ?? 0, 2) }}
                                                                                </p>
                                                                            </div>

                                                                            <!-- Discount Calculation -->
                                                                            <div class="col-sm-8 col-7">
                                                                                <p>Discount
                                                                                    ({{ $billing['discount'] ?? 0 }}%)
                                                                                    :
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{ MONEY }}{{ number_format($billing['discount_amount'] ?? 0, 2) }}
                                                                                </p>
                                                                            </div>

                                                                            <!-- Tax Calculation -->
                                                                            @if (floatval($billing['tax'] ?? 0) > 0)
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p>Tax ({{ $billing['tax'] }}%) :
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p>{{ MONEY }}{{ number_format($billing['tax_amount'] ?? 0, 2) }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif

                                                                            {{-- @if (floatval($billing['freight_charges'] ?? 0) > 0)
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p>Freight Charges :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p>{{ MONEY }}{{ number_format($billing['freight_charges'] ?? 0, 2) }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif --}}

                                                                            @if ((int)$billing['old_payment']>0)
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p>Old Payment :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p>{{ MONEY }}{{ number_format($billing['old_payment'] ?? 0, 2) }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif

                                                                            <div
                                                                                class="col-sm-8 col-7 grand-total-title">
                                                                                <p class="fw-bold">Grand Total :</p>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 col-5 grand-total-amount">
                                                                                <p>{{ MONEY }}{{ number_format($billing['payment'] ?? 0, 2) }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="inv--detail-section inv--customer-detail-section">

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
                                                                            class="inv-customer-name">A/c Holder Name
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
                                                                    <img class="company-logo w-50"
                                                                        src="{{ asset($template->bank_qr_code) }}"
                                                                        alt="company">
                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="inv--note">
                                                            <hr>
                                                            <div class="row mt-4">
                                                                <div
                                                                    class="col-sm-12 col-12 order-sm-0 order-1  text-left">
                                                                    <h6 class="fw-bolder">Declaration</h6>
                                                                    <p class="fw-light">{!! $template->declaration !!}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row mt-4">
                                                                <div class="col-6 ">
                                                                    <div style="height:40px;"></div>
                                                                    <div>Goods Received By<br>Receiver's Signature</div>
                                                                </div>

                                                                <div class="col-6 text-end">
                                                                    <div style="height:40px;"></div>
                                                                    <div>Certified that the particulars are correct<br>
                                                                        <strong>for NEW JEWAR KOTHI</strong><br>
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
