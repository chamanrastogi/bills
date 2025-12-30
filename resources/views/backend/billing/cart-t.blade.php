<x-dashboard-layout>
    @section('title', breadcrumb())

    @section('style')
        <style>
            .invoice-page {
                background: #fff;
                padding: 25px;
                border: 1px solid #ddd;
                max-width: 900px;
                margin: auto;
            }

            .invoice-header {
                border-bottom: 3px solid #111;
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            .store-name {
                font-size: 28px;
                font-weight: 700;
            }

            .store-sub {
                font-size: 12px;
            }

            .meta-table td {
                padding: 4px 6px;
                font-size: 13px;
            }

            .meta-label {
                font-weight: 600;
                width: 35%;
            }

            .border-box {
                border: 1px solid #dcdcdc;
                padding: 10px;
                font-size: 13px;
            }

            .items-table th {
                background: #f7f7f7;
                font-weight: 600;
            }

            .amount-box {
                border: 1px solid #dcdcdc;
                padding: 10px;
            }

            @media print {
                body {
                    background: #fff;
                }

                .no-print {
                    display: none !important;
                }

                .invoice-page {
                    border: none;
                    margin: 0;
                    width: 100%;
                }
            }
        </style>

    @stop
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    {{-- {{dd($data['cart_items'])}} --}}
    <div class="seperator-header layout-top-spacing">
        <a href="javascript:void(0);"
            class="btn btn-secondary btn-print action-print _effect--ripple waves-effect waves-light">Print</a>
    </div>

    <div class="row invoice layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="doc-container"></div>
            <div class="page-content">
                <div class="row">
                    <div class="invoice-page">

                        <!-- Print Button -->


                        <!-- Header -->
                        <div class="invoice-header text-center">
                            <div class="store-name">NEW JEWAR KOTHI</div>
                            <div class="store-sub">FIRST FLOOR, 2 KOTWALI ROAD · GANDHIGAR KA TAPRA, SAROFA BAZAR ·
                                JHANSI</div>
                        </div>

                        <!-- GST + Invoice Meta -->
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless meta-table">
                                    <tr>
                                        <td class="meta-label">GSTIN No :</td>
                                        <td>09BBJPA6980N1Z1</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">Invoice No :</td>
                                        <td>B2B316</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">Invoice Date :</td>
                                        <td>31-Aug-2024</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">State :</td>
                                        <td>Uttar Pradesh (09)</td>
                                    </tr>
                                    <tr>
                                        <td class="meta-label">Date of Supply :</td>
                                        <td>31-Aug-2024</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-8">
                                        <table class="table table-borderless meta-table">
                                            <tr>
                                                <td class="meta-label">IRN No :</td>
                                                <td>19b3c011c08f34ef22ff86ea...</td>
                                            </tr>
                                            <tr>
                                                <td class="meta-label">ACK No :</td>
                                                <td>142415551004600</td>
                                            </tr>
                                            <tr>
                                                <td class="meta-label">ACK Date :</td>
                                                <td>2024-08-31</td>
                                            </tr>
                                            <tr>
                                                <td class="meta-label">Place of Supply :</td>
                                                <td>Madhya Pradesh</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="border p-3" style="height:110px;">QR CODE</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Receiver + Consignee -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Details of Receiver | Bill To</h6>
                                <div class="border-box">
                                    <strong>AASTHA JEWELLERS</strong><br>
                                    0 Panna Khajuraho Road<br>
                                    Chhatarpur 471001<br>
                                    <strong>State :</strong> MP &nbsp; <strong>Code :</strong> 23<br>
                                    <strong>GSTIN :</strong> 23PYNPS4572P1Z4<br>
                                    <strong>PAN :</strong> PYNPS4572P
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h6 class="fw-bold">Details of Consignee | Shipped To</h6>
                                <div class="border-box">
                                    <strong>AASTHA JEWELLERS</strong><br>
                                    0 Panna Khajuraho Road<br>
                                    Chhatarpur 471001<br>
                                    <strong>State :</strong> MP &nbsp; <strong>Code :</strong> 23
                                </div>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="mt-4">
                            <table class="table table-bordered items-table">
                                <thead>
                                    <tr>
                                        <th>Description of Goods</th>
                                        <th>HSN Code</th>
                                        <th>Net Weight</th>
                                        <th class="text-end">Rate</th>
                                        <th>per</th>
                                        <th class="text-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SILVER ORNAMENTS</td>
                                        <td>71131120</td>
                                        <td>1273.000 GMS</td>
                                        <td class="text-end">38.130</td>
                                        <td>GMS</td>
                                        <td class="text-end">48,544.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">Total</td>
                                        <td class="text-end fw-bold">48,544.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bank + Totals -->
                        <div class="row">
                            <div class="col-md-7">

                                <h6 class="fw-bold">Bank Details</h6>
                                <div class="border-box">
                                    <strong>HDFC BANK LTD</strong><br>
                                    Civil Lines, Jhansi<br>
                                    A/C No: 50200079325902<br>
                                    IFSC: HDFC0000453<br><br>

                                    <strong>STATE BANK OF INDIA</strong><br>
                                    Manik Chowk, Jhansi<br>
                                    A/C No: 40500218670<br>
                                    IFSC: SBIN0003759
                                </div>

                                <p class="mt-3 fst-italic">
                                    <strong>Amount Chargeable (in words):</strong><br>
                                    Rs. Fifty Thousand Only
                                </p>
                                <p class="fst-italic">
                                    <strong>GST Chargeable (in words):</strong><br>
                                    Rs. One Thousand Four Hundred Fifty Six and Thirty Two Paise Only
                                </p>

                            </div>

                            <div class="col-md-5">
                                <div class="amount-box">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Taxable Amt</td>
                                            <td class="text-end">48,544.00</td>
                                        </tr>
                                        <tr>
                                            <td>IGST 3%</td>
                                            <td class="text-end">1,456.32</td>
                                        </tr>
                                        <tr>
                                            <td>Round Off</td>
                                            <td class="text-end">-0.32</td>
                                        </tr>
                                        <tr class="fw-bold fs-5">
                                            <td>Grand Total</td>
                                            <td class="text-end">50,000.00</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Declaration -->
                        <div class="mt-4">
                            <h6 class="fw-bold">Declaration</h6>
                            <ol>
                                <li>Goods Delivered at Jhansi (U.P.).</li>
                                <li>Invoice shows actual price; all particulars are correct.</li>
                                <li>Jurisdiction will be Jhansi only.</li>
                            </ol>

                            <div class="row mt-4">
                                <div class="col-6 text-center">
                                    <div style="height:40px;"></div>
                                    <div>Goods Received By<br>Receiver's Signature</div>
                                </div>

                                <div class="col-6 text-center">
                                    <div style="height:40px;"></div>
                                    <div>Certified that the particulars are correct<br>
                                        <strong>for NEW JEWAR KOTHI</strong><br>
                                        <em>Authorised Signatory</em>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <footer class="text-center mt-4 small">This is a Computer Generated Invoice</footer>

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
