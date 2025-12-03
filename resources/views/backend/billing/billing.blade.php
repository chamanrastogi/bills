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

                                            <select name="customer" id="customer" class="form-control customer">
                                                <option value="" disabled selected>Select Customer</option>
                                                @if (is_array($customers) || $customers instanceof \Illuminate\Support\Collection)
                                                    @foreach ($customers as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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
                                                <div class="col-md-2">
                                                    <label class="form-label">SKU</label>
                                                    <input type="text" id="pd_sku" class="form-control" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Gross Wt</label>
                                                    <input type="number" id="pd_gross" class="form-control"
                                                        step="0.0001" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Net Wt</label>
                                                    <input type="number" id="pd_net" class="form-control"
                                                        step="0.0001" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Making</label>
                                                    <input type="number" id="pd_making" class="form-control"
                                                        step="0.01">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Rate/gram</label>
                                                    <input type="number" id="pd_rate" class="form-control"
                                                        step="0.01">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">GST %</label>
                                                    <input type="number" id="pd_gst" class="form-control"
                                                        step="0.01">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-3">
                                                    <label class="form-label">Purity</label>
                                                    <select id="pd_purity" class="form-control">
                                                        <option value="">Select Purity</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Computed Price</label>
                                                    <input type="text" id="pd_computed_price" class="form-control"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="discount">Discount (%):</label>
                                                    <input type="number" id="discount" class="form-control"
                                                        min="0" max="100" value="0">
                                                    <small id="discountAmount" class="form-text text-muted">Discount
                                                        Amount: {{ MONEY }}0</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tax">Tax (%):</label>
                                                    <input type="number" id="tax" class="form-control"
                                                        min="0" max="100" value="{{ $template->tax }}">
                                                    <small id="taxAmount" class="form-text text-muted">Tax Amount:
                                                        {{ MONEY }}0</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gst">Gst ({{ MONEY }}):</label>
                                                    <input type="number" id="gst" class="form-control"
                                                        min="0" step="0.01" value="0">
                                                    <small id="gstAmount" class="form-text text-muted">Gst Added:
                                                        {{ MONEY }}0</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Update Grand Total and Submit Button Section -->
                                        <h3 id="grandTotal">Grand Total: {{ MONEY }}0</h3>
                                        <button type="button" class="btn btn-success" id="submitCartBtn">Add to
                                            Cart</button>
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
            let grandTotal = 0;

            function updateGrandTotal() {
                const discount = parseFloat($('#discount').val()) || 0;
                const tax = parseFloat($('#tax').val()) || 0;
                const gstAmount = parseFloat($('#gst').val()) || 0;

                const discountedTotal = grandTotal * (1 - (discount / 100));
                const taxAmount = discountedTotal * (tax / 100);
                const finalTotal = discountedTotal + taxAmount + gstAmount; // Add GST amount
                const discountAmount = grandTotal - discountedTotal;

                $('#grandTotal').text(`Grand Total: {{ MONEY }}${finalTotal.toFixed(2)}`);
                $('#discountAmount').text(`Discount Amount: {{ MONEY }}${discountAmount.toFixed(2)}`);
                $('#taxAmount').text(`Tax Amount: {{ MONEY }}${taxAmount.toFixed(2)}`);
                $('#gstAmount').text(`Gst Added: {{ MONEY }}${gstAmount.toFixed(2)}`);

            }
            // Function to populate products based on selected type
            function datatable() {
                const type = $("#type_names").val();
                console.log(type);
                const productSelect = $("#productitems");

                productSelect.html('<option value="" disabled selected>-Select Product-</option>');

                if (type) {
                    $.ajax({
                        url: `{{ route('product.type', ['type' => ':type']) }}`.replace(':type',
                            type),
                        method: 'GET',
                        success: function(data) {
                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(index, product) {
                                    // include rich data as data-attributes on the option, include purity
                                    const img = product.image ? product.image : '';
                                    const unitName = (product.unit && product.unit.name) ? product.unit
                                        .name : '';
                                    productSelect.append(
                                        `<option value="${product.id}" data-price="${product.price}" data-sku="${product.sku}" data-unit="${unitName}" data-image="${img}" data-making="${product.making_charge}" data-rate="${product.rate_per_gram}" data-gst="${product.gst_percent}" data-gross="${product.gross_weight}" data-net="${product.net_weight}" data-stock="${product.stock_qty}" data-purity="${product.purity_id}">${product.name} - Per ${unitName}</option>`
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
                // gst input handled via updateGrandTotal when its value changes
                $('#billing_system').hide();
                $('#category_id').on('change', function() {

                    let category_id = $(this).val();
                    let _token = '{{ csrf_token() }}';

                    function loadData(url, target) {
                        $.post(url, {
                            _token,
                            category_id
                        }, function(result) {
                            $(target).html(result);
                        });
                    }

                    loadData("{{ route('category.types') }}", '#type_names');

                });
                $('#type_names').on('change', function() {

                    datatable();
                });
                // when product changes populate product details panel
                $('#productitems').on('change', function() {
                    const opt = $('#productitems option:selected');
                    if (!opt || !opt.val()) {
                        $('.product-details').addClass('d-none');
                        return;
                    }
                    const sku = opt.data('sku') || '';
                    const gross = parseFloat(opt.data('gross')) || 0;
                    const net = parseFloat(opt.data('net')) || 0;
                    const making = parseFloat(opt.data('making')) || 0;
                    const rate = parseFloat(opt.data('rate')) || 0;
                    const gst = parseFloat(opt.data('gst')) || 0;
                    const img = opt.data('image') || '';
                    const purity = opt.data('purity') || '';

                    $('#pd_sku').val(sku);
                    $('#pd_gross').val(gross);
                    $('#pd_net').val(net);
                    $('#pd_making').val(making);
                    $('#pd_rate').val(rate);
                    $('#pd_gst').val(gst);
                    $('#pd_image_preview').html(img ?
                        `<img src="${img}" style="max-width:120px;max-height:80px;object-fit:cover">` : '');
                    // fetch purities for selected type via existing endpoint
                    if ($('#type').val()) {
                        $.post(`{{ route('product.purity_units') }}`, {
                            type_id: $('#type').val(),
                            _token: '{{ csrf_token() }}'
                        }, function(html) {
                            $('#pd_purity').html(html);
                            if (purity) {
                                $('#pd_purity').val(purity);
                            }
                        });
                    }
                    // compute price: rate_per_gram * net_weight + making_charge
                    const computed = (rate * net) + making;
                    $('#pd_computed_price').val('{{ MONEY }}' + computed.toFixed(2));
                    $('.product-details').removeClass('d-none');
                });
                $('#discount').on('input', function() {
                    updateGrandTotal();
                });
                $('#tax').on('input', function() {
                    updateGrandTotal();
                });
                $('#gst').on('input', function() {
                    updateGrandTotal();
                });
                $(".customer").on("change", function() {
                    $('#billing_system').show();
                });

                function showProductError(msg) {
                    $('#productError').text(msg).show();
                }

                function clearProductError() {
                    $('#productError').text('').hide();
                }

                $('#addProductBtn').on('click', function() {

                    const typeText = $('#type option:selected').text();
                    const productText = $('#productitems option:selected').text();
                    const productValue = $('#productitems').val();
                    const quantity = parseFloat($('#quantity').val()); // Use parseFloat here

                    if (!productValue) {
                        alert('Please select a product.');
                        return;
                    }

                    const selectedOption = $('#productitems option:selected');
                    const productId = selectedOption.val();
                    const priceFromOption = parseFloat(selectedOption.data('price')) || 0;
                    const sku = selectedOption.data('sku') || '';
                    const image = selectedOption.data('image') || '';
                    const makingFromOption = parseFloat(selectedOption.data('making')) || 0;
                    const rateFromOption = parseFloat(selectedOption.data('rate')) || 0;
                    const gstFromOption = parseFloat(selectedOption.data('gst')) || 0;
                    const grossFromOption = parseFloat(selectedOption.data('gross')) || 0;
                    const netFromOption = parseFloat(selectedOption.data('net')) || 0;

                    // Allow user to adjust details in the product-details panel; fall back to option data
                    const pd_making = parseFloat($('#pd_making').val()) || makingFromOption;
                    const pd_rate = parseFloat($('#pd_rate').val()) || rateFromOption;
                    const pd_gst = parseFloat($('#pd_gst').val()) || gstFromOption;
                    const pd_gross = parseFloat($('#pd_gross').val()) || grossFromOption;
                    const pd_net = parseFloat($('#pd_net').val()) || netFromOption;
                    const pd_purity = $('#pd_purity').val() || selectedOption.data('purity') || '';
                    const stockQty = parseFloat(selectedOption.data('stock')) || 0;

                    // Compute price using rate_per_gram * net_weight + making_charge when available
                    let computedPrice = priceFromOption;
                    if (pd_rate > 0 && pd_net > 0) {
                        computedPrice = (pd_rate * pd_net) + pd_making;
                    }
                    const priceFloat = computedPrice;

                    if (!productText || isNaN(priceFloat) || isNaN(quantity) || quantity <= 0) {
                        showProductError('Please select a valid product and quantity.');
                        return;
                    }

                    // Validate against stock before adding
                    if (stockQty > 0 && quantity > stockQty) {
                        showProductError(`Only ${stockQty} unit(s) available in stock.`);
                        return;
                    }

                    // Calculate total based on decimal quantity and per-item GST
                    const lineBase = priceFloat * quantity;
                    const lineTotal = lineBase * (1 + (pd_gst / 100));
                    const total = lineTotal;
                    grandTotal += total;

                    // Extract unit name from the selected option's data attribute
                    const unitName = selectedOption.data('unit') || '';

                    // If product already exists in table, increase quantity (enforce stock)
                    const existingRow = $(`#billTable tr[data-product-id='${productId}']`);
                    if (existingRow.length) {
                        const qtyInput = existingRow.find('.rowQty');
                        const currentQty = parseFloat(qtyInput.val()) || 0;
                        const newQty = currentQty + quantity;
                        if (stockQty > 0 && newQty > stockQty) {
                            showProductError(
                                `Cannot add ${quantity}. Only ${stockQty - currentQty} more unit(s) available.`
                            );
                            return;
                        }
                        qtyInput.val(newQty.toFixed(2));
                        qtyInput.trigger('change');
                        clearProductError();
                        $('#quantity').val(1);
                        return;
                    }

                    // Append a new row to the bill table including sku, image and stock
                    $('#billTable').append(`
        <tr data-product-id="${productId}" data-price="${priceFloat}" data-sku="${sku}" data-unit="${unitName}" data-image="${image}" data-making="${pd_making}" data-rate="${pd_rate}" data-gst="${pd_gst}" data-gross="${pd_gross}" data-net="${pd_net}" data-purity="${pd_purity}" data-stock="${stockQty}">
            <td>${productId}</td>
            <td>${sku}</td>
            <td>${image ? `<img src="${image}" alt="img" style="width:40px;height:40px;object-fit:cover">` : ''}</td>
            <td>${typeText}</td>
            <td>${productText}</td>
            <td>${unitName}</td>
            <td>{{ MONEY }}${priceFloat.toFixed(2)}</td>
            <td><input type="number" step="0.01" min="0" class="form-control form-control-sm rowQty" value="${quantity.toFixed(2)}" style="width:90px"></td>
            <td class="rowTotal">{{ MONEY }}${total.toFixed(2)}</td>
            <td><button class="btn btn-danger btn-sm removeProductBtn">Remove</button></td>
        </tr>
    `);
                    clearProductError();
                    // Reset quantity only; keep type and product selected to remember selection
                    $('#quantity').val(1);

                    // Update displayed grand total
                    $('#grandTotal').text(`Grand Total: {{ MONEY }}${grandTotal.toFixed(2)}`);
                    updateGrandTotal();
                });

                // Delegated handler for when a row quantity changes
                $('#billTable').on('change', '.rowQty', function() {
                    const input = $(this);
                    let newQty = parseFloat(input.val()) || 0;
                    if (newQty < 0) newQty = 0;
                    const row = input.closest('tr');
                    const stock = parseFloat(row.data('stock')) || 0;
                    if (stock > 0 && newQty > stock) {
                        showProductError(`Only ${stock} unit(s) available in stock.`);
                        // revert to max allowed
                        input.val(stock.toFixed(2));
                        newQty = stock;
                    } else {
                        clearProductError();
                    }

                    const unitPrice = parseFloat(row.data('price')) || 0;
                    const gstRow = parseFloat(row.data('gst')) || 0;
                    const lineBase = unitPrice * newQty;
                    const lineTotal = lineBase * (1 + (gstRow / 100));
                    row.find('.rowTotal').text(`{{ MONEY }}${lineTotal.toFixed(2)}`);

                    // Recompute grandTotal by summing all row totals
                    let newGrand = 0;
                    $('#billTable tr').each(function() {
                        const r = $(this);
                        const qty = parseFloat(r.find('.rowQty').val()) || 0;
                        const p = parseFloat(r.data('price')) || 0;
                        const g = parseFloat(r.data('gst')) || 0;
                        const rb = p * qty;
                        const rt = rb * (1 + (g / 100));
                        newGrand += rt;
                    });
                    grandTotal = newGrand;
                    $('#grandTotal').text(`Grand Total: {{ MONEY }}${grandTotal.toFixed(2)}`);
                    updateGrandTotal();
                });

                $('#billTable').on('click', '.removeProductBtn', function() {
                    const row = $(this).closest('tr');
                    const rowTotal = parseFloat(row.find('.rowTotal').text().replace('{{ MONEY }}', '')
                        .trim()) || 0;

                    grandTotal -= rowTotal;
                    grandTotal = Math.max(0, grandTotal); // Ensure grandTotal doesn't go below 0
                    $('#grandTotal').text(`Grand Total: {{ MONEY }}${grandTotal.toFixed(2)}`);
                    row.remove();
                    updateGrandTotal();
                });
                $('#submitCartBtn').on('click', function() {
                    const discount = parseFloat($('#discount').val()) || 0;
                    const tax = parseFloat($('#tax').val()) || 0;
                    const gstAmount = parseFloat($('#gst').val()) || 0;
                    const customerId = $('.customer').val();
                    const cartItems = [];
                    $('#billTable tr').each(function() {
                        const row = $(this);
                        const productId = row.data('product-id');
                        const quantity = parseFloat(row.find('.rowQty').val()) || 0;
                        const price = parseFloat(row.data('price')) || 0;
                        const sku = row.data('sku') || '';
                        const name = row.find('td').eq(4).text();
                        const unit = row.data('unit') || '';
                        const image = row.data('image') || '';
                        const making = parseFloat(row.data('making')) || 0;
                        const rate = parseFloat(row.data('rate')) || 0;
                        const gst = parseFloat(row.data('gst')) || 0;
                        const gross = parseFloat(row.data('gross')) || 0;
                        const net = parseFloat(row.data('net')) || 0;
                        const purity = row.data('purity') || '';

                        cartItems.push({
                            productId,
                            sku,
                            name,
                            unit,
                            price,
                            quantity,
                            image,
                            making,
                            rate,
                            gst,
                            gross,
                            net,
                            purity,
                        });
                    });

                    // Calculate discounted total and apply tax
                    const discountedTotal = grandTotal * (1 - (discount / 100));
                    const taxAmount = discountedTotal * (tax / 100);
                    const finalTotal = discountedTotal + taxAmount + gstAmount;

                    const data = {
                        cart_items: cartItems,
                        grand_total: finalTotal,
                        discount,
                        discount_amount: grandTotal - discountedTotal,
                        tax,
                        tax_amount: taxAmount,
                        gst_amount: gstAmount,
                        customer_id: customerId,
                    };

                    const form = $('<form>', {
                        action: '{{ route('cart.submit') }}',
                        method: 'POST',
                        style: 'display: none',
                    });

                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: '{{ csrf_token() }}',
                    }));

                    form.append($('<input>', {
                        type: 'hidden',
                        name: 'cart_data',
                        value: JSON.stringify(data),
                    }));

                    $('body').append(form);
                    form.submit();
                    return false;
                });

            });
        </script>
    @stop
</x-main-layout>
