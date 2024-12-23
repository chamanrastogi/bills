<x-dashboard-layout>
    @php

        $cart = json_decode($billing['cart']);
        $i = 1;
        $customer = App\Models\Customer::find($billing['customer_id']);
        $bill = App\Models\Billing::find($billing['id']);
        $subtotal = 0;

    @endphp
    @section('title', "Invoice Bill - #000".$billing['id'])

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @section('style')
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/light/apps/invoice-preview.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/src/assets/css/dark/apps/invoice-preview.css') }}">
    @stop




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

                                                                <div class="col-sm-6 col-12 mr-auto">
                                                                    <div class="d-flex">

                                                                        <img class="w-50"
                                                                            src="{{ asset($template->logo) }}"
                                                                            alt="company">

                                                                    </div>
                                                                    <p class="inv-street-addr mt-3">
                                                                        <span class="text-info">Add:</span>
                                                                        {{ $template->address }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">E:</span>
                                                                        {{ $template->email }}
                                                                    </p>
                                                                    <p class="inv-email-address">
                                                                        <span class="text-info">Mob:</span>
                                                                        {{ $template->support_phone }}
                                                                    </p>

                                                                </div>

                                                                <div class="col-sm-6 text-sm-end">
                                                                    <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4">
                                                                        <span class="inv-title">Invoice : </span> <span
                                                                            class="inv-number">#000{{ $id }}</span>
                                                                    </p>
                                                                    <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                            class="inv-title text-info">Invoice Date : </span>
                                                                        <span
                                                                            class="inv-date">{{ date('d M Y') }}</span>
                                                                    </p>
                                                                    <p class="inv-due-date"><span
                                                                            class="inv-title"><span
                                                                                class="text-info">GST No:</span>
                                                                            {{ $template->gst }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="inv--detail-section inv--customer-detail-section">

                                                            <div class="row">

                                                                <div
                                                                    class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                    <p class="inv-to">Invoice To</p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                                    <h6 class=" inv-title">Invoice From</h6>
                                                                </div>

                                                                <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                    <p class="inv-customer-name">{{ $customer->name }}
                                                                    </p>
                                                                    <p class="inv-street-addr">{{ $customer->address }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer->email }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer->phone }}
                                                                    </p>
                                                                </div>

                                                                <div
                                                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                                    <p class="inv-customer-name">{{ $customer->name }}
                                                                    </p>
                                                                    <p class="inv-street-addr">
                                                                        {{ $customer->billing_address ? $customer->billing_address : $customer->address }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer->email }}
                                                                    </p>
                                                                    <p class="inv-email-address">{{ $customer->phone }}
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
                                                                            <th scope="col">Category</th>
                                                                            <th scope="col">Product</th>
                                                                            <th scope="col">Unit</th>
                                                                            <th class="text-start" scope="col">Qty
                                                                            </th>
                                                                            <th class="text-start" scope="col">Price
                                                                            </th>
                                                                            <th class="text-start" scope="col">Amount
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($cart as $item)
                                                                            @php
                                                                                $product = App\Models\Product::with(
                                                                                    'unit',
                                                                                )->find($item->productId);
                                                                                $productPrice = floatval(
                                                                                    $product->price,
                                                                                );
                                                                                $quantity = intval($item->quantity);
                                                                                $totalAmount =
                                                                                    $productPrice * $quantity;
                                                                                $subtotal += $totalAmount;
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $i++ }}</td>
                                                                                <td>{{ $product->name }}</td>
                                                                                <td>{{ $product->name }}</td>
                                                                                <td>{{ $product->unit->name }}</td>
                                                                                <td>{{ $quantity }}</td>
                                                                                <td>{{ number_format($productPrice, 2) }}
                                                                                </td>
                                                                                <td>{{ number_format($totalAmount, 2) }}
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
                                                                                <p>{{ MONEY }}{{ number_format($subtotal, 2) }}
                                                                                </p>
                                                                            </div>

                                                                            <!-- Discount Calculation -->
                                                                            @php
                                                                                $discountAmount =
                                                                                    floatval($subtotal) *
                                                                                    (floatval($billing['discount']) /
                                                                                        100);
                                                                            @endphp
                                                                            <div class="col-sm-8 col-7">
                                                                                <p>Discount {{ $billing['discount'] }}%
                                                                                    :</p>
                                                                            </div>
                                                                            <div class="col-sm-4 col-5">
                                                                                <p>{{ MONEY }}{{ number_format($billing['discount_amount'], 2) }}
                                                                                </p>
                                                                            </div>

                                                                            <!-- Tax Calculation -->
                                                                            @if (floatval($billing['tax']) > 0)
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p>GST {{ $billing['tax'] }}% :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p>{{ MONEY }}{{ number_format($billing['tax_amount'], 2) }}
                                                                                    </p>
                                                                                </div>
                                                                            @endif

                                                                            <!-- Grand Total Calculation with Discount and Tax -->

                                                                            <div
                                                                                class="col-sm-8 col-7 grand-total-title">
                                                                                <p class="fw-bold">Grand Total :</p>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 col-5 grand-total-amount">
                                                                                <p>{{ MONEY }}{{ number_format($billing['grand_total'], 2) }}
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
                                                            <div class="row mt-4">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1  text-center">
                                                                    <h6 class="fw-bolder">Declaration</h6>
                                                                    <p class="fw-light">{{ $template->declaration }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row mt-4">
                                                                <div class="col-sm-12 col-12 order-sm-0 order-1 text-center">
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
