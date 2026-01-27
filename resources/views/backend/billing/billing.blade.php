<x-main-layout>
    @section('title', breadcrumb())

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="row ">
                            <div class="col-xl-12">
                                <div class="container p-4">
                                    <h2 class="text-center">Customer</h2>
                                    <div class="row justify-content-center align-middle">
                                        <div class="col-md-6">
                                            <label for="customer" class="form-label">Customer:</label>

                                            <select name="customer" id="customer" class="form-control customer"
                                                onchange="checkBalance(this.value)">
                                                <option value="" disabled selected>Select Customer</option>
                                                @if (is_array($customers) || $customers instanceof \Illuminate\Support\Collection)
                                                    @foreach ($customers as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <a href="{{ route('customers.create') }}" class="btn btn-info">Add
                                                Customer</a>
                                        </div>
                                    </div>
                                    <div id="balance-section" style="display: none;">
                                        <div class="row mt-3">
                                            <div class="col-md-8">
                                                <p>Customer Balance: <span id="customer-balance">0</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="checkbox" id="pay-balance" /> Pay old balance
                                            </div>
                                        </div>
                                        <div id="payment-fields" style="display: none;">
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="payment-amount">Payment Amount:</label>
                                                    <input type="number" id="payment-amount" class="form-control"
                                                        min="0" step="0.01">
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="row pt-3" id="paymode" style="display: none;">
                                        <div class="col-md-6">
                                            <label for="payment-mode">Payment Mode:</label>

                                            <x-form.select name="payment_mode" id="payment-mode" :options="MODE"
                                                :selected="0" placeholder="Select Payment Mode" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="payment-mode">Payment Transaction No:</label>

                                            <input type="text" id="transaction_no" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="billing_system">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="container p-4">
                                    <h2 class="text-center">Billing System</h2>

                                    <!-- Services, Product Selection, Quantity -->
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <x-form.input-label for="category_id" value="Category" />
                                            <x-form.select name="category_id" id="category_id" :options="$categories"
                                                placeholder="Select Category" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-form.input-label for="type_id" value="Type" />
                                            <x-form.select name="type_id" id="type_names" :options="[]"
                                                placeholder="Select Type" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="product" class="form-label">Product:</label>
                                            <select id="productitems" class="form-control">
                                                <option value="" disabled selected>Select a product</option>
                                            </select>
                                        </div>



                                        <div class="col-md-2">
                                            <label for="quantity" class="form-label">Quantity:</label>
                                            <input type="number" id="quantity" class="form-control" min="0.01"
                                                step="0.01" value="1">
                                        </div>

                                        <div class="col-md-2 d-flex align-items-end pb-3 pb-md-0">
                                            <button type="button" class="btn btn-primary w-100" id="addProductBtn">Add
                                                Product</button>
                                        </div>
                                        <div class="col-md-12 mt-2 product-details d-none">
                                            <div class="row">

                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" id="pd_sku" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Category</label>
                                                    <input type="text" id="pd_category" class="form-control"
                                                        readonly>
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Product</label>
                                                    <input type="text" id="pd_product" class="form-control"
                                                        readonly>
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Purity</label>
                                                    <input type="text" id="pd_purity" class="form-control"
                                                        readonly>
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Computed Price</label>
                                                    <input type="text" id="pd_computed_price" class="form-control"
                                                        readonly>
                                                </div>
                                                 <div class="col-md-2 py-2">
                                                    <label class="form-label">GST %</label>
                                                    <input type="number" id="pd_gst"  class="form-control"
                                                        step="0.01" readonly>
                                                </div>
                                                <div class="col-md-3 py-2">
                                                    <label class="form-label">Gross Wt</label>
                                                    <input type="number" id="pd_gross" class="form-control"
                                                        step="0.0001" >
                                                </div>
                                                <div class="col-md-3 py-2">
                                                    <label class="form-label">Net Wt</label>
                                                    <input type="number" id="pd_net" class="form-control"
                                                        step="0.0001" >
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Making(%)</label>
                                                    <input type="number" id="pd_making" class="form-control"
                                                        step="0.01" min="0" max="100">
                                                </div>
                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Rate/gram</label>
                                                    <input type="number" id="pd_rate" class="form-control"
                                                        step="0.01">
                                                </div>



                                                <div class="col-md-2 py-2">
                                                    <label class="form-label">Preview</label>
                                                    <div id="pd_image_preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div id="productError" class="text-danger mt-2" style="display:none">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bill Table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>SKU</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th>Type</th>
                                                    <th>Unit</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="billTable">
                                                <!-- Rows will be added here -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Grand Total and Submit Button -->
                                    <div class="text-right">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="discount">Discount (%):</label>
                                                    <input type="number" id="discount" class="form-control"
                                                        min="0" max="100" value="0">
                                                    <small id="discountAmountHelper" class="form-text text-muted">Discount
                                                        Amount: {{ MONEY }}0</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tax">Gst Tax (%):</label>
                                                    <input type="number" id="tax" class="form-control"
                                                        min="0" max="100" value="{{ $template->tax }}">
                                                    <small id="taxAmount" class="form-text text-muted">Gst Tax Amount:
                                                        {{ MONEY }}0</small>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Update Grand Total and Submit Button Section -->
                                        <div id="totals-section" class="card p-3 mb-3"
                                            style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>Product Total:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="productTotal">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>Discount (<span id="discountPercent">0</span>):</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="discountAmount">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>GST Tax (<span id="gstPercent">0</span>):</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="gstPercentAmount">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>Old Balance:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="oldBalanceDisplay">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>Total Due:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="totalDue">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <strong>Payment:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <span id="paymentDisplay">{{ MONEY }}0</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <strong>Pay Amount:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                        {{ MONEY }}<input type="number" id="netBalance" class="form-control d-inline-block text-end" min="0" step="0.01" style="width:150px" value="0">
                                                    </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success" id="submitCartBtn"
                                            disabled>Add to Cart</button>
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
    $('.customer').select2({
        placeholder: 'Select an option'
    });

    // --- Helper: Format Money (Optional usage) ---
    const currencySymbol = '{{ MONEY }}';

    // --- 1. Customer Balance Logic ---
    function checkBalance(customerId) {
        if (!customerId) {
            $('#balance-section').hide();
            oldBalance = 0;
            updateGrandTotal();
            return;
        }
        $.ajax({
            url: '{{ route('billing.customer', ':id') }}'.replace(':id', customerId),
            method: 'GET',
            success: function(data) {
                if (data.status && data.customer.balance > 0) {
                    oldBalance = parseFloat(data.customer.balance);
                    $('#customer-balance').text(data.customer.balance);
                    $('#payment-amount').attr('max', data.customer.balance);
                    $('#balance-section').show();
                    $('#paymode').show();
                } else {
                    oldBalance = 0;
                    $('#balance-section').hide();
                }
                updateGrandTotal();
            },
            error: function(xhr) {
                alert('Unable to fetch customer balance');
                oldBalance = 0;
                updateGrandTotal();
            }
        });
    }

    $('#pay-balance').on('change', function() {
        if ($(this).is(':checked')) {
            $('#payment-fields').show();
            paymentAmount = parseFloat($('#payment-amount').val()) || 0;
        } else {
            $('#payment-fields').hide();
            paymentAmount = 0;
        }
        updateGrandTotal();
    });

    $('#payment-amount').on('input', function() {
        paymentAmount = parseFloat($(this).val()) || 0;
        updateGrandTotal();
    });

    // --- 2. Grand Total Calculation ---
    let grandTotal = 0;
    let oldBalance = 0;
    let paymentAmount = 0;

    function updateGrandTotal() {
        const discount = parseFloat($('#discount').val()) || 0;
        const tax = parseFloat($('#tax').val()) || 0;
        const gstAmount = parseFloat($('#gst').val()) || 0;

        const discountAmount = grandTotal * (discount / 100);
        const discountedTotal = grandTotal - discountAmount;
        const taxAmount = discountedTotal * (tax / 100);
        const productTotal = discountedTotal + taxAmount + gstAmount;
        const includeOldBalance = $('#pay-balance').is(':checked');
        const totalDue = productTotal + (includeOldBalance ? oldBalance : 0);
        const netBalance = totalDue - paymentAmount;

        $('#productTotal').text(`${currencySymbol}${productTotal.toFixed(2)}`);
        $('#discountPercent').text(`${discount}%`);
        $('#gstPercent').text(`${tax}%`);
        $('#gstPercentAmount').text(`${currencySymbol}${taxAmount.toFixed(2)}`);

        $('#oldBalanceDisplay').text(`${currencySymbol}${oldBalance.toFixed(2)}`);
        $('#totalDue').text(`${currencySymbol}${totalDue.toFixed(2)}`);
        $('#paymentDisplay').text(`${currencySymbol}${paymentAmount.toFixed(2)}`);
        $('#netBalance').val(netBalance.toFixed(2));
        $('#netBalance').attr('max', totalDue.toFixed(2));
        $('#discountAmount').text(`${currencySymbol}${discountAmount.toFixed(2)}`);
        $('#taxAmount').text(`Gst Tax Amount: ${currencySymbol}${taxAmount.toFixed(2)}`);

        // Enable/disable submit button
        if (grandTotal > 0) {
            $('#submitCartBtn').prop('disabled', false);
        } else {
            $('#submitCartBtn').prop('disabled', true);
        }
    }

    // --- 3. Dynamic Price Calculation Helper ---
    // This calculates the price based on the INPUT fields, not the select option
    function calculateDynamicPrice() {
        const net = parseFloat($('#pd_net').val()) || 0;
        const rate = parseFloat($('#pd_rate').val()) || 0;
        const making = parseFloat($('#pd_making').val()) || 0;

        // Logic: (Rate * Net Weight) + Making Charge as percentage
        // Price = (Rate * Net) * (1 + Making/100)
        let computed = 0;
        if (rate > 0 || making > 0) {
            computed = (rate * net) * (1 + making / 100);
        } else {
             // Fallback if rate/making are 0, usually just base price from select
             // We handle this in the 'Add Product' click if computed is 0
             const opt = $('#productitems option:selected');
             computed = parseFloat(opt.data('price')) || 0;
        }

        $('#pd_computed_price').val(currencySymbol + computed.toFixed(2));
    }

    function datatable() {
        const type = $("#type_names").val();
        const productSelect = $("#productitems");

        productSelect.html('<option value="" disabled selected>-Select Product-</option>');

        if (type) {
            $.ajax({
                url: `{{ route('product.type', ['type' => ':type']) }}`.replace(':type', type),
                method: 'GET',
                success: function(data) {
                    if (Array.isArray(data) && data.length > 0) {
                        $.each(data, function(index, product) {
                            const img = product.image ? product.image : '';
                            const unitName = (product.unit && product.unit.name) ? product.unit.name : '';
                            productSelect.append(
                                `<option value="${product.id}"
                                    data-product="${product.name}"
                                    data-category="${product.category}"
                                    data-price="${product.price}"
                                    data-sku="${product.sku}"
                                    data-unit="${unitName}"
                                    data-image="${img}"
                                    data-making="${product.making_charge}"
                                    data-rate="${product.rate_per_gram}"
                                    data-gst="0"
                                    data-gross="${product.gross_weight}"
                                    data-net="${product.net_weight}"
                                    data-stock="${product.stock_qty}"
                                    data-purity-name="${product.purity.name}"
                                    data-purity="${product.purity.id}">
                                    ${product.name} - Per ${unitName} - Qty ${product.stock_qty}
                                </option>`
                            );
                        });
                    } else {
                        productSelect.append('<option value="" disabled>No products available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching products:", error);
                    productSelect.append('<option value="" disabled>Error loading products</option>');
                }
            });
        }
    }

    $(document).ready(function() {
        const getCustomerUrl = "{{ route('billing.customer', ':id') }}";
        $('#billing_system').hide();

        // --- Category & Type Selection ---
        $('#category_id').on('change', function() {
            let category_id = $(this).val();
            let _token = '{{ csrf_token() }}';
            $.post("{{ route('category.types') }}", { _token, category_id }, function(result) {
                $('#type_names').html(result);
            });
        });

        $('#type_names').on('change', function() {
            datatable();
        });

        // --- Product Selection Change ---
        $('#productitems').on('change', function() {
            const opt = $('#productitems option:selected');
            if (!opt || !opt.val()) {
                $('.product-details').addClass('d-none');
                return;
            }
            // Populate inputs with default data from DB
            const sku = opt.data('sku') || '';
            const gross = parseFloat(opt.data('gross')) || 0;
            const net = parseFloat(opt.data('net')) || 0;
            const making = parseFloat(opt.data('making')) || 0;
            const rate = parseFloat(opt.data('rate')) || 0;
            const gst = parseFloat(opt.data('gst')) || 0;
            const img = opt.data('image') || '';
            const purity = opt.data('purity') || '';
            const purity_name = opt.data('purity-name') || '';
            const category = opt.data('category') || '';
            const product = opt.data('product') || '';

            $('#pd_sku').val(sku);
            $('#pd_gross').val(gross); // Set initial Gross
            $('#pd_net').val(net);     // Set initial Net
            $('#pd_making').val(making);
            $('#pd_rate').val(rate);
            $('#pd_gst').val(0);
            $('#pd_category').val(category);
            $('#pd_product').val(product);
            $('#pd_purity').val(purity_name);

            $('#pd_image_preview').html(img ?
                `<img src="${img}" style="max-width:120px;max-height:80px;object-fit:cover">` : '');

            $('.product-details').removeClass('d-none');

            // Calculate price based on these initial values
            calculateDynamicPrice();
        });

        // --- Live Calculation on Input Change ---
        // NEW: Listen to Gross, Net, Making, and Rate changes
        $('#pd_gross, #pd_net, #pd_making, #pd_rate').on('input', function() {
            calculateDynamicPrice();
        });

        $('#discount, #tax, #gst').on('input', function() {
            updateGrandTotal();
        });

        $(".customer").on("change", function() {
            const customerId = $(this).val();
            $('#paymode').show();
            if (!customerId) {
                $('#billing_system').hide();
                return;
            }
            const url = getCustomerUrl.replace(':id', customerId);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() { $('#billing_system').hide(); },
                success: function(response) {
                    if (response.status) { $('#billing_system').show(); }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message ?? 'Unable to fetch customer');
                }
            });
        });

        function showProductError(msg) { $('#productError').text(msg).show(); }
        function clearProductError() { $('#productError').text('').hide(); }

        // --- Add Product to Cart Logic ---
        $('#addProductBtn').on('click', function() {
            const selectedOption = $('#productitems option:selected');
            const productId = selectedOption.val();

            if (!productId) {
                alert('Please select a product.');
                return;
            }

            const typeText = $('#type_names option:selected').text();
            const productText = selectedOption.data('product') || '';
            const sku = selectedOption.data('sku') || '';
            const image = selectedOption.data('image') || '';
            const unitName = selectedOption.data('unit') || '';
            const stockQty = parseFloat(selectedOption.data('stock')) || 0;
            const quantity = parseFloat($('#quantity').val());

            // --- IMPORTANT: Get values directly from Inputs, not data attributes ---
            const pd_gross = parseFloat($('#pd_gross').val()) || 0;
            const pd_net = parseFloat($('#pd_net').val()) || 0;
            const pd_making = parseFloat($('#pd_making').val()) || 0;
            const pd_rate = parseFloat($('#pd_rate').val()) || 0;
            const pd_gst = parseFloat($('#pd_gst').val()) || 0;
            const pd_category = $('#pd_category').val();
            const pd_purity = selectedOption.data('purity') || '';

            // Determine Price
            let computedPrice = parseFloat(selectedOption.data('price')) || 0;
            // If Rate and Net exist, use the formula
            if (pd_rate > 0 || pd_making > 0) {
                computedPrice = (pd_rate * pd_net) * (1 + pd_making / 100);
            }
            const priceFloat = computedPrice;

            // Validations
            if (!productText || isNaN(priceFloat) || isNaN(quantity) || quantity <= 0) {
                showProductError('Please select a valid product and quantity.');
                return;
            }
            if (stockQty > 0 && quantity > stockQty) {
                showProductError(`Only ${stockQty} unit(s) available in stock.`);
                return;
            }

            // Calculate Line Totals
            const lineBase = priceFloat * quantity;
            const lineTotal = lineBase * (1 + (pd_gst / 100));
            grandTotal += lineTotal;

            // Check if product exists in table
            const existingRow = $(`#billTable tr[data-product-id='${productId}']`);

            // Note: If you want to allow different weights for the same product ID,
            // you might need to remove this existing check or match by weight too.
            // For now, we assume same ID merges quantity.
            if (existingRow.length) {
                const qtyInput = existingRow.find('.rowQty');
                const currentQty = parseFloat(qtyInput.val()) || 0;
                const newQty = currentQty + quantity;

                if (stockQty > 0 && newQty > stockQty) {
                    showProductError(`Cannot add ${quantity}. Only ${stockQty - currentQty} more unit(s) available.`);
                    grandTotal -= lineTotal; // revert total addition
                    return;
                }

                // Update existing row (Note: updating weight on existing row is tricky if they differ, usually you'd overwrite or add new row)
                // Here we simply update quantity and recalculate total based on ORIGINAL added price
                qtyInput.val(newQty.toFixed(2)).trigger('change');
                clearProductError();
                $('#quantity').val(1);
                // Revert grandTotal calculation here because trigger('change') handles it
                grandTotal -= lineTotal;
                return;
            }

            // Append new row
            // We save pd_gross and pd_net in data attributes
            $('#billTable').append(`
                <tr data-product-id="${productId}"
                    data-price="${priceFloat}"
                    data-sku="${sku}"
                    data-unit="${unitName}"
                    data-image="${image}"
                    data-making="${pd_making}"
                    data-rate="${pd_rate}"
                    data-gst="${pd_gst}"
                    data-gross="${pd_gross}"
                    data-net="${pd_net}"
                    data-purity="${pd_purity}"
                    data-stock="${stockQty}">
                    <td>${productId}</td>
                    <td>${sku}</td>
                    <td>${image ? `<img src="${image}" style="width:40px;height:40px;object-fit:cover">` : ''}</td>
                    <td>${pd_category}</td>
                    <td>${productText} <br><small class="text-muted">Net: ${pd_net} | Gross: ${pd_gross}</small></td>
                    <td>${typeText}</td>
                    <td>Per ${unitName}</td>
                    <td>${currencySymbol}${priceFloat.toFixed(2)}</td>
                    <td><input type="number" step="0.01" min="0" class="form-control form-control-sm rowQty" value="${quantity.toFixed(2)}" style="width:90px"></td>
                    <td class="rowTotal" data-total="${lineTotal.toFixed(2)}">${currencySymbol}${lineTotal.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm removeProductBtn">Remove</button></td>
                </tr>
            `);

            clearProductError();
            $('#quantity').val(1);
            updateGrandTotal();
        });

        // --- Row Quantity Change ---
        $('#billTable').on('change', '.rowQty', function() {
            const input = $(this);
            let newQty = parseFloat(input.val()) || 0;
            if (newQty < 0) newQty = 0;
            const row = input.closest('tr');
            const stock = parseFloat(row.data('stock')) || 0;

            if (stock > 0 && newQty > stock) {
                showProductError(`Only ${stock} unit(s) available in stock.`);
                input.val(stock.toFixed(2));
                newQty = stock;
            } else {
                clearProductError();
            }

            const unitPrice = parseFloat(row.data('price')) || 0;
            const gstRow = parseFloat(row.data('gst')) || 0;
            const lineBase = unitPrice * newQty;
            const lineTotal = lineBase * (1 + (gstRow / 100));

            row.find('.rowTotal')
               .text(`${currencySymbol}${lineTotal.toFixed(2)}`)
               .data('total', lineTotal.toFixed(2)); // Update data attribute too

            // Recalculate Grand Total
            let newGrand = 0;
            $('#billTable tr').each(function() {
                const r = $(this);
                const t = parseFloat(r.find('.rowTotal').data('total')) || 0;
                // Or recalculate:
                // const q = parseFloat(r.find('.rowQty').val()) || 0;
                // const p = parseFloat(r.data('price')) || 0;
                // const g = parseFloat(r.data('gst')) || 0;
                // newGrand += (p * q) * (1 + (g/100));
                newGrand += t;
            });
            grandTotal = newGrand;
            updateGrandTotal();
        });

        // --- Remove Product ---
        $('#billTable').on('click', '.removeProductBtn', function() {
            const row = $(this).closest('tr');
            const rowTotal = parseFloat(row.find('.rowTotal').data('total')) || 0;
            grandTotal -= rowTotal;
            grandTotal = Math.max(0, grandTotal);
            row.remove();
            updateGrandTotal();
        });

        // --- Submit Cart ---
        $('#submitCartBtn').on('click', function() {
            const discount = parseFloat($('#discount').val()) || 0;
            const tax = parseFloat($('#tax').val()) || 0;
            const balancePay = parseFloat($('#netBalance').val()) || 0;
            const oldBalanceVal = parseFloat(oldBalance) || 0; // Use global variable
            const customerId = $('.customer').val();
            const cartItems = [];

            $('#billTable tr').each(function() {
                const row = $(this);

                // Read values from data attributes (which contain our custom inputs)
                const makingPercent = parseFloat(row.data('making')) || 0;
                const rate = parseFloat(row.data('rate')) || 0;
                const net = parseFloat(row.data('net')) || 0;
                const makingAmount = (rate * net) * (makingPercent / 100);

                cartItems.push({
                    productId: row.data('product-id'),
                    sku: row.data('sku'),
                    name: row.find('td').eq(4).text(), // grabs text including Net/Gross label
                    unit: row.data('unit'),
                    price: parseFloat(row.data('price')) || 0,
                    quantity: parseFloat(row.find('.rowQty').val()) || 0,
                    image: row.data('image'),
                    making: makingPercent,
                    making_amount: makingAmount,
                    rate: rate,
                    gst: parseFloat(row.data('gst')) || 0,
                    gross: parseFloat(row.data('gross')) || 0, // Gets the custom Gross Wt
                    net: net,     // Gets the custom Net Wt
                    purity: row.data('purity'),
                    grandTotalAmount: parseFloat(row.find('.rowTotal').data('total')) || 0,
                });
            });

            const discountedTotal = grandTotal * (1 - (discount / 100));
            const taxAmount = discountedTotal * (tax / 100);
            const finalTotal = discountedTotal + taxAmount;

            const data = {
                cart_items: cartItems,
                grand_total: finalTotal,
                discount,
                discount_amount: grandTotal - discountedTotal,
                tax,
                tax_amount: taxAmount,
                customer_id: customerId,
                oldBalance: oldBalanceVal,
                customer_balance: balancePay,
            };

            if ($('#pay-balance').is(':checked')) {
                data.payment = parseFloat($('#payment-amount').val()) || 0;
            }
            data.payment_mode = $('#payment-mode').val();
            data.transaction_no = $('#transaction_no').val();

            const form = $('<form>', {
                action: '{{ route('cart.submit') }}',
                method: 'POST',
                style: 'display: none',
            });
            form.append($('<input>', { type: 'hidden', name: '_token', value: '{{ csrf_token() }}' }));
            form.append($('<input>', { type: 'hidden', name: 'cart_data', value: JSON.stringify(data) }));

            $('body').append(form);
            form.submit();
            return false;
        });
    });
</script>
@stop
</x-main-layout>
