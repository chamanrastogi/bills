<x-dashboard-layout>
    @section('title', breadcrumb())

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
{{-- {{dd($data['cart_items'])}} --}}
<div class="seperator-header layout-top-spacing">
    <a href="javascript:void(0);" class="btn btn-secondary btn-print action-print _effect--ripple waves-effect waves-light">Print</a>
</div>
<div class="page-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    
                    <div class="row invoice layout-top-spacing layout-spacing">
                        
                        <div class="col-xl-12">
                            <div class="container p-4">
                                <h2 class="text-center">Billing System</h2>

                                <div class="invoice-container" id="invoiceSection">
                                    <div class="invoice-inbox">

                                        <div id="ct" class="">

                                            <div class="invoice">
                                                <div class="content-section">

                                                    <div class="inv--head-section inv--detail-section">

                                                        <div class="row">

                                                            <div class="col-sm-6 col-12 mr-auto">
                                                                <div class="d-flex">
                                                                    <img class="company-logo"
                                                                        src="{{ asset($template->logo) }}"
                                                                        alt="company">
                                                                    <h3 class="in-heading align-self-center">{{$template->site_title}}</h3>
                                                                </div>
                                                                <p class="inv-street-addr mt-3">XYZ Delta Street</p>
                                                                <p class="inv-email-address">info@company.com</p>
                                                                <p class="inv-email-address">(120) 456 789</p>
                                                            </div>

                                                            <div class="col-sm-6 text-sm-end">
                                                                <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4">
                                                                    <span class="inv-title">Invoice : </span> <span
                                                                        class="inv-number">#0001</span></p>
                                                                <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                        class="inv-title">Invoice Date : </span>
                                                                    <span class="inv-date">20 Mar 2022</span></p>
                                                                <p class="inv-due-date"><span class="inv-title">Due
                                                                        Date : </span> <span class="inv-date">26 Mar
                                                                        2022</span></p>
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
                                                                <p class="inv-customer-name">Jesse Cory</p>
                                                                <p class="inv-street-addr">405 Mulberry Rd., NC,
                                                                    28649</p>
                                                                <p class="inv-email-address">jcory@company.com</p>
                                                                <p class="inv-email-address">(128) 666 070</p>
                                                            </div>

                                                            <div
                                                                class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                                <p class="inv-customer-name">Oscar Garner</p>
                                                                <p class="inv-street-addr">2161 Ferrell Street, MN,
                                                                    56545 </p>
                                                                <p class="inv-email-address">info@mail.com</p>
                                                                <p class="inv-email-address">(218) 356 9954</p>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="inv--product-table-section">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="">
                                                                    <tr>
                                                                        <th scope="col">S.No</th>
                                                                        <th scope="col">Category</th>
                                                                        <th scope="col">product</th>
                                                                        <th class="text-end" scope="col">Qty</th>
                                                                        <th class="text-end" scope="col">Price
                                                                        </th>
                                                                        <th class="text-end" scope="col">Amount
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($data['cart_items'] as $item)
                                                                        <tr>
                                                                            <td>{{ $item['productId'] }}</td>
                                                                            <td>{{ $item['category'] }}</td>
                                                                            <td>{{ $item['product'] }}</td>
                                                                            <td>{{ number_format($item['price'], 2) }}
                                                                            </td>
                                                                            <td>{{ $item['quantity'] }}</td>
                                                                            <td>{{ number_format($item['total'], 2) }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="inv--total-amounts">

                                                        <div class="row mt-4">
                                                            <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                            </div>
                                                            <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                <div class="text-sm-end">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-7">
                                                                            <p class="">Sub Total :</p>
                                                                        </div>
                                                                        <div class="col-sm-4 col-5">
                                                                            <p class="">$3155</p>
                                                                        </div>
                                                                        <div class="col-sm-8 col-7">
                                                                            <p class="">Tax 10% :</p>
                                                                        </div>
                                                                        <div class="col-sm-4 col-5">
                                                                            <p class="">$315</p>
                                                                        </div>
                                                                       
                                                                       
                                                                        
                                                                        <div
                                                                            class="col-sm-8 col-7 grand-total-title mt-3">
                                                                            <h4 class="">Grand Total : </h4>
                                                                        </div>
                                                                        <div
                                                                            class="col-sm-4 col-5 grand-total-amount mt-3">
                                                                            <h4 class="">{{MONEY}}{{$data['grand_total']}}</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="inv--note">

                                                        <div class="row mt-4">
                                                            <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                <p>Note: Thank you for doing Business with us.</p>
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
            
            // Get the HTML content of the invoice section
            const invoiceContent = document.getElementById('invoiceSection').innerHTML;
    
            // Open a new window for printing
            const printWindow = window.open('', '', 'height=600,width=800');
    
            // Write the content to the print window
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write('<style>');
            // Optionally, add custom styles for the print version
            printWindow.document.write('@media print { body { font-family: Arial, sans-serif; } }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
    
            // Close the document and trigger the print dialog
            printWindow.document.close();
            printWindow.print();
        });
    </script>
    @stop
</x-dashboard-layout>
