<x-dashboard-layout>
    @section('title', breadcrumb())

    <div class="seperator-header layout-top-spacing">
        <a href="{{ route('category.create') }}">
            <h4 class="">Add Service</h4>
        </a>

    </div>
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

                                    <th>Name</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="category-{{ $category->id }}">
                                        <td style="width:1%"><span class="form-check form-check-primary"><input
                                                    class="form-check-input mixed_child " value="{{ $category->id }}"
                                                    type="checkbox"></span></td>
                                        <td>{{ $category->id }}</td>

                                        <td>{{ !empty($category->name) ? $category->name : '-' }}</td>

                                        <td class="text-center">
                                            <button type="button"
                                                onClick="statusFunction({{ $category->id }},'Category')"
                                                class="shadow-none badge badge-light-{{ $category->status == 1 ? 'danger' : 'success' }} warning changestatus{{ $category->id }}  bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Status"
                                                data-original-title="Status">{{ $category->status == 1 ? 'Deactive' : 'Active' }}</button>

                                        </td>

                                        <td class="text-center">
                                            <div class="action-btns">


                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                                    data-placement="top" title="Edit" data-bs-original-title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                    onClick="deleteFunction({{ $category->id }},'Categories')"
                                                    class="action-btn btn-edit bs-tooltip me-2 delete{{ $category->id }}"
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
                        @if ($categories->count() != 0)
                            <div class="ms-3">
                               <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="form-check-default">
                                        <label class="form-check-label" for="form-check-default">
                                            Checked All
                                        </label>
                                    </div>
                                <button id="deleteall" onClick="deleteAllFunction('Categories')"
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
    @if ($categories->count() != 0)
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
                            var elems = document.querySelector('.category-' + checkbox.value);
                            elems.remove();
                        }
                    });
                    // console.log("Checked Checkbox Values: ", checkedValues);
                    var crf = '{{ csrf_token() }}';
                    $.post("{{ route('category.delete') }}", {
                        _token: crf,
                        id: checkedValues,
                        table: table
                    }, function(data) {
                        toastr.success("Selected Data Deleted");
                    });
                }
            }

            function statusFunction(id, table) {
                // event.preventDefault(); // prevent form submit
                // var form = event.target.form; // storing the form
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                document.querySelector('.warning.changestatus' + id).addEventListener('click', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to change the status!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Change it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            swalWithBootstrapButtons.fire(
                                'Changed!',
                                'Your status has been changed.',
                                'success'
                            )
                            setTimeout(function() {
                                var crf = '{{ csrf_token() }}';
                                $.post("{{ route('category.status') }}", {
                                    _token: crf,
                                    id: id,
                                    table: table
                                }, function(data) {

                                    var elems = document.querySelector('.warning.changestatus' +
                                        id);
                                    if (data == 'active') {
                                        elems.classList.remove("badge-light-danger");
                                        elems.classList.add("badge-light-success");
                                        elems.innerText = 'Active';
                                        toastr.success("Status Active");
                                    } else {
                                        elems.classList.remove("badge-light-success");
                                        elems.classList.add("badge-light-danger");
                                        elems.innerText = 'Deactive';
                                        toastr.warning(" Status Deactived");
                                    }

                                });

                            }, 1000);
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your status is not Changed :)',
                                'error'
                            )
                        }
                    })
                })

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
                            var elems = document.querySelector('.category-' + id);
                            elems.remove();
                            var crf = '{{ csrf_token() }}';
                            $.post("{{ route('category.delete') }}", {
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
