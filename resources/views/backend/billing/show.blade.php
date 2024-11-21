<x-dashboard-layout>
    @section('title', breadcrumb())


    <div class="page-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <table id="html5-extension" class="table dt-table-hover">
                            <thead>
                                <tr>
                                    <th>-</th>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Cart</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Total</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billings as $bill)
                                    @php
                                        $cart = json_decode($bill->cart);
                                        $customer = App\Models\Customer::Select('name', 'email', 'phone')->find(
                                            $bill->customer_id,
                                        );
                                    @endphp
                                    <tr class="billing-{{ $bill->id }}">
                                        <td style="width:1%"><span class="form-check form-check-primary"><input
                                                    class="form-check-input mixed_child " value="{{ $bill->id }}"
                                                    type="checkbox"></span></td>
                                        <td>#000{{ $bill->id }}</td>

                                        <td>{{ !empty($customer->name) ? $customer->name : '-' }}</td>
                                        <td>
                                            @foreach ($cart as $item)
                                                @php

                                                    $product = App\Models\Product::select('name', 'price')->find(
                                                        $item->productId,
                                                    );
                                                @endphp
                                                {{  $product->name }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $bill->discount }}</td>
                                        <td>{{ $bill->tax }}</td>
                                        <td>{{ $bill->grand_total }}</td>
                                        <td class="text-center">
                                            <div class="action-btns">

                                                <a href="{{ route('get.cart', $bill->id) }}"
                                                    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                                    data-placement="top" title="View" data-bs-original-title="View">
                                                    <i data-feather="eye"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    onClick="deleteFunction({{ $bill->id }},'Billing')"
                                                    class="action-btn btn-edit bs-tooltip me-2 delete{{ $bill->id }}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    data-bs-original-title="Delete">
                                                    <i data-feather="trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($billings->count() != 0)
                            <div class="ms-3">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                    data-placement="top" title="Edit" data-bs-original-title="Edit">
                                    <i data-feather="edit"></i>
                                </a>
                                <button id="deleteall" onClick="deleteAllFunction('Billing')"
                                    class="btn btn-danger mb-2 me-4">
                                    <span class="btn-text-inner">Delete Selected</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if ($billings->count() != 0)
        <script type="text/javascript">
            function deleteAllFunction(table) {
                // Get all checkboxes with the specified class name
                var checkboxes = document.querySelectorAll('.mixed_child');
                // Initialize an array to store checked checkbox values
                var checkedValues = [];
                // Iterate through each checkbox
                checkboxes.forEach(function(checkbox) {
                    // Check if the checkbox is checked
                    if (checkbox.checked) {
                        // Add the value to the array
                        checkedValues.push(checkbox.value);
                    }
                });
                if (checkedValues.length === 0) {
                    // Display an alert if none are checked
                    toastr.warning("Please check at least one checkbox.");
                } else {
                    // Output the array to the console (you can do whatever you want with the array)
                    checkboxes.forEach(function(checkbox) {
                        // Check if the checkbox is checked
                        if (checkbox.checked) {
                            // Add the value to the array
                            checkedValues.push(checkbox.value);
                            var elems = document.querySelector('.billing-' + checkbox.value);
                            elems.remove();
                        }
                    });
                    // console.log("Checked Checkbox Values: ", checkedValues);
                    var crf = '{{ csrf_token() }}';
                    $.post("{{ route('billing.delete') }}", {
                        _token: crf,
                        id: checkedValues,
                        table: table
                    }, function(data) {
                        toastr.success("Selected Data Deleted");
                    });
                }
            }



            function deleteFunction(id, table) {

                // event.preventDefault(); // prevent form submit
                // var form = event.target.form; // storing the form
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                document.querySelector('.delete' + id).addEventListener('click', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            var elems = document.querySelector('.billing-' + id);
                            elems.remove();
                            var crf = '{{ csrf_token() }}';
                            $.post("{{ route('billing.delete') }}", {
                                _token: crf,
                                id: id,
                                table: table
                            }, function(data) {
                                toastr.success("Entry no " + id + " Deleted");
                            });


                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your data is safe :)',
                                'error'
                            )
                        }
                    })
                })



            }
        </script>
    @endif
    @section('script')
    <script>
        $(document).ready(function() {
            // When the "Select All" checkbox is clicked
            $('#form-check-default').change(function() {
                console.log('cj');
                // Check or uncheck all checkboxes based on the "Select All" checkbox
                $('.mixed_child').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
@stop
</x-dashboard-layout>
