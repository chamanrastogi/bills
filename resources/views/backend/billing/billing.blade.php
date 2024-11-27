<x-dashboard-layout>
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
                                            <label for="Customer" class="form-label">Customer:</label>
                                            {!! Form::select('color', $customers, null, [
                                                'class' => 'form-control customer',
                                                'placeholder' => 'Select Customer',
                                            ]) !!}
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
                                            <label for="category" class="form-label">Category:</label>
                                            {!! Form::select('category', $categories, null, [
                                                'class' => 'form-control categorys',
                                                'required' => 'required',
                                                'placeholder' => 'Select Category',
                                            ]) !!}
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
                                            <button class="btn btn-primary w-100" id="addProductBtn">Add
                                                Product</button>
                                        </div>
                                    </div>

                                    <!-- Bill Table -->
                                    <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Id</th>
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
                                        <div class="form-group mb-2">
                                            <label for="discount">Discount (%):</label>
                                            <input type="number" id="discount" class="form-control" min="0"
                                                max="100" value="0">
                                            <small id="discountAmount" class="form-text text-muted">Discount Amount:
                                                {{ MONEY }}0</small>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="tax">Tax (%):</label>
                                            <input type="number" id="tax" class="form-control" min="0"
                                                max="100" value="{{ $template->tax }}">
                                            <small id="taxAmount" class="form-text text-muted">Tax Amount:
                                                {{ MONEY }}0</small>
                                        </div>
                                        <h3 id="grandTotal">Grand Total: {{ MONEY }}0</h3>
                                        <button class="btn btn-success" id="submitCartBtn">Add to Cart</button>
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

                const discountedTotal = grandTotal * (1 - (discount / 100));
                const taxAmount = discountedTotal * (tax / 100);
                const finalTotal = discountedTotal + taxAmount;
                const discountAmount = grandTotal - discountedTotal;

                $('#grandTotal').text(`Grand Total: {{ MONEY }}${finalTotal.toFixed(2)}`);
                $('#discountAmount').text(`Discount Amount: {{ MONEY }}${discountAmount.toFixed(2)}`);
                $('#taxAmount').text(`Tax Amount: {{ MONEY }}${taxAmount.toFixed(2)}`);
            }
            // Function to populate products based on selected category
            function datatable() {
                const category = $(".categorys").val();
                const productSelect = $("#productitems");

                productSelect.html('<option value="" disabled selected>Select Product</option>');

                if (category) {
                    $.ajax({
                        url: `{{ route('product.category', ['category' => ':category']) }}`.replace(':category',
                            category),
                        method: 'GET',
                        success: function(data) {
                            if (Array.isArray(data) && data.length > 0) {
                                $.each(data, function(index, product) {
                                    productSelect.append(
                                        `<option value="${product.price}-${product.id}">${product.name} ${product.unit.name}</option>`
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
                $('#billing_system').hide();
                $(".categorys").on("change", function() {
                    datatable();
                });
                $('#discount').on('input', function() {
                    updateGrandTotal();
                });
                $('#tax').on('input', function() {
                    updateGrandTotal();
                });
                $(".customer").on("change", function() {
                    $('#billing_system').show();
                });

                $('#addProductBtn').on('click', function() {

                    const categoryText = $('.categorys option:selected').text();
                    const productText = $('#productitems option:selected').text();
                    const productValue = $('#productitems').val();
                    const quantity = parseFloat($('#quantity').val()); // Use parseFloat here

                    if (!productValue) {
                        alert('Please select a product.');
                        return;
                    }

                    const [price, productId] = productValue.split('-').map(item => item.trim());
                    const priceFloat = parseFloat(price);

                    if (!productText || isNaN(priceFloat) || isNaN(quantity) || quantity <= 0) {
                        alert('Please select a valid product and quantity.');
                        return;
                    }

                    // Reset inputs
                    $('#quantity').val(1);
                    $('.categorys').val('');
                    $('#productitems').html('<option value="" disabled selected>Select a product</option>');

                    // Calculate total based on decimal quantity
                    const total = priceFloat * quantity;
                    grandTotal += total;

                    // Extract unit name from product text (assuming format "Product Name-Per Unit")
                    const unitName = productText.split('-Per ')[1] || '';

                    // Append a new row to the bill table
                    $('#billTable').append(`
        <tr>
            <td>${productId}</td>
            <td>${categoryText}</td>
            <td>${productText}</td>
            <td>${unitName}</td> <!-- Add Unit here -->
            <td>{{ MONEY }}${priceFloat.toFixed(2)}</td>
            <td>${quantity}</td>
            <td class="rowTotal">{{ MONEY }}${total.toFixed(2)}</td>
            <td><button class="btn btn-danger btn-sm removeProductBtn">Remove</button></td>
        </tr>
    `);

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
                    const customerId = $('.customer').val();

                    const cartItems = [];
                    $('#billTable tr').each(function() {
                        const row = $(this);
                        const productId = row.find('td').eq(0).text();
                        const category = row.find('td').eq(1).text();
                        const product = row.find('td').eq(2).text();

                        const price = parseFloat(row.find('td').eq(4).text().replace(
                            '{{ MONEY }}', '').trim());
                        const quantity = parseInt(row.find('td').eq(5).text());
                        const total = parseFloat(row.find('.rowTotal').text().replace(
                            '{{ MONEY }}', '').trim());

                        cartItems.push({
                            productId,
                            quantity
                        });
                    });

                    // Calculate discounted total and apply tax
                    const discountedTotal = grandTotal * (1 - (discount / 100));
                    const taxAmount = discountedTotal * (tax / 100);
                    const finalTotal = discountedTotal + taxAmount;

                    const data = {
                        cart_items: cartItems,
                        grand_total: finalTotal, // Include tax in grand total
                        discount: discount,
                        discount_amount: grandTotal-discountedTotal,
                        tax: tax,
                        tax_amount: taxAmount, // Optional: send the tax amount separately
                        customer_id: customerId
                    };

                    const form = $('<form>', {
                        action: '{{ route('cart.submit') }}',
                        method: 'POST',
                        style: 'display: none'
                    });

                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: '{{ csrf_token() }}'
                    }));

                    form.append($('<input>', {
                        type: 'hidden',
                        name: 'cart_data',
                        value: JSON.stringify(data)
                    }));

                    $('body').append(form);
                    form.submit();
                });

            });
        </script>
    @stop
</x-dashboard-layout>
