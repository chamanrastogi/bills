<x-dashboard-layout>
    @section('title', breadcrumb())

    @section('style')
    <link href="{{ asset('backend/assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('backend/assets/src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

    <link href="{{ asset('backend/assets/src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/assets/src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

    @stop
  
    <div class="page-content">
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                       <div class="row">
                        <div class="col-xl-12">
                            <div class="invoice-content">
    
                                <div class="invoice-detail-body">
    
                                    <div class="invoice-detail-title">
    
                                        <div class="invoice-logo">
                                            <div class="profile-image">
    
                                                <!-- // The classic file input element we'll enhance
                                                // to a file pond, we moved the configuration
                                                // properties to JavaScript -->
                            
                                                <div class="img-uploader-content">
                                                    <input type="file" class="filepond"
                                                        name="filepond" accept="image/png, image/jpeg, image/gif"/>
                                                </div>
                            
                                            </div>
                                        </div>
                                        
                                        <div class="invoice-title">
                                            <input type="text" class="form-control" placeholder="Invoice Label" value="Invoice Label">
                                        </div>
    
                                    </div>
    
                                    <div class="invoice-detail-header">
    
                                        <div class="row justify-content-between">
                                            <div class="col-xl-5 invoice-address-company">
    
                                                <h4>From:-</h4>
    
                                                <div class="invoice-address-company-fields">
    
                                                    <div class="form-group row">
                                                        <label for="company-name" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="company-name" placeholder="Business Name">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="company-email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="company-email" placeholder="name@company.com">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="company-address" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="company-address" placeholder="XYZ Street">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="company-phone" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="company-phone" placeholder="(123) 456 789">
                                                        </div>
                                                    </div>                                                                
                                                    
                                                </div>
                                                
                                            </div>
    
    
                                            <div class="col-xl-5 invoice-address-client">
    
                                                <h4>Bill To:-</h4>
    
                                                <div class="invoice-address-client-fields">
    
                                                    <div class="form-group row">
                                                        <label for="client-name" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="client-name" placeholder="Client Name">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="client-email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="client-email" placeholder="name@company.com">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="client-address" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="client-address" placeholder="XYZ Street">
                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="client-phone" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm" id="client-phone" placeholder="(123) 456 789">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                        
                                    </div>
    
                                    <div class="invoice-detail-terms">
    
                                        <div class="row justify-content-between">
    
                                            <div class="col-md-3">
    
                                                <div class="form-group mb-4">
                                                    <label for="number">Invoice Number</label>
                                                    <input type="text" class="form-control form-control-sm" id="number" placeholder="#0001">
                                                </div>
    
                                            </div>
    
                                            <div class="col-md-3">
    
                                                <div class="form-group mb-4">
                                                    <label for="date">Invoice Date</label>
                                                    <input type="text" class="form-control form-control-sm" id="date" placeholder="Add date picker">
                                                </div>
    
                                            </div>
    
                                            <div class="col-md-3">
                                                <div class="form-group mb-4">
                                                    <label for="due">Due Date</label>
                                                    <input type="text" class="form-control form-control-sm" id="due" placeholder="None">
                                                </div>
                                                
                                            </div>
    
                                        </div>
                                        
                                    </div>
    
    
                                    <div class="invoice-detail-items">
    
                                        <div class="table-responsive">
                                            <table class="table item-table">
                                                <thead>
                                                    <tr>
                                                        <th class=""></th>
                                                        <th>Description</th>
                                                        <th class="">Rate</th>
                                                        <th class="">Qty</th>
                                                        <th class="text-right">Amount</th>
                                                        <th class="text-center">Tax</th>
                                                    </tr>
                                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
    
                                        <button class="btn btn-dark additem">Add Item</button>
                                        
                                    </div>
    
    
                                    <div class="invoice-detail-total">
    
                                        <div class="row">
    
                                            <div class="col-md-6">
                                                
                                                <div class="form-group row invoice-created-by">
                                                    <label for="payment-method-account" class="col-sm-3 col-form-label col-form-label-sm">Account #:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-sm" id="payment-method-account" placeholder="Bank Account Number">
                                                    </div>
                                                </div>
    
                                                <div class="form-group row invoice-created-by">
                                                    <label for="payment-method-bank-name" class="col-sm-3 col-form-label col-form-label-sm">Bank Name:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-sm" id="payment-method-bank-name" placeholder="Insert Bank Name">
                                                    </div>
                                                </div>
    
                                                <div class="form-group row invoice-created-by">
                                                    <label for="payment-method-code" class="col-sm-3 col-form-label col-form-label-sm">SWIFT code:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control form-control-sm" id="payment-method-code" placeholder="Insert Code">
                                                    </div>
                                                </div>
    
                                                <div class="form-group row invoice-created-by">
                                                    <label for="payment-method-country" class="col-sm-3 col-form-label col-form-label-sm">Country:</label>
                                                    <div class="col-sm-9">
                                                        <select name="country_code" class="form-select country_code  form-control-sm" id="payment-method-country">
                                                            <option value="">Choose Country</option>
                                                            
                                                            <option value="India">India</option>
                                                           
                                                            </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
    
                                            <div class="col-md-6">
                                                <div class="totals-row">
                                                    <div class="invoice-totals-row invoice-summary-subtotal">
    
                                                        <div class="invoice-summary-label">Subtotal</div>
    
                                                        <div class="invoice-summary-value">
                                                            <div class="subtotal-amount">
                                                                <span class="currency">$</span><span class="amount">0.00</span>
                                                            </div>
                                                        </div>
    
                                                    </div>
    
                                                    
    
                                                    <div class="invoice-totals-row invoice-summary-total">
    
                                                        <div class="invoice-summary-label">Discount</div>
    
                                                        <div class="invoice-summary-value">
                                                            <div class="total-amount">
                                                                <span class="currency">$</span><span>0.00</span>
                                                            </div>
                                                        </div>
    
                                                    </div>
    
                                                    <div class="invoice-totals-row invoice-summary-tax">
    
                                                        <div class="invoice-summary-label">Tax</div>
    
                                                        <div class="invoice-summary-value">
                                                            <div class="tax-amount">
                                                                <span>0%</span>
                                                            </div>
                                                        </div>
    
                                                    </div>
    
                                                    <div class="invoice-totals-row invoice-summary-balance-due">
    
                                                        <div class="invoice-summary-label">Total</div>
    
                                                        <div class="invoice-summary-value">
                                                            <div class="balance-due-amount">
                                                                <span class="currency">$</span><span>0.00</span>
                                                            </div>
                                                        </div>
    
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>
                                        
                                    </div>
    
                                    <div class="invoice-detail-note">
    
                                        <div class="row">
                                        
                                            <div class="col-md-12 align-self-center">
    
                                                <div class="form-group row invoice-note">
                                                    <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">Notes:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="invoice-detail-notes" placeholder='Notes - For example, "Thank you for doing business with us"' style="height: 88px;"></textarea>
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


     <script src="{{ asset('backend/assets/src/plugins/src/filepond/filepond.min.js') }}"></script>
     
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('backend/assets/src/assets/js/apps/invoice-add.js') }}"></script>
    @stop
</x-dashboard-layout>
