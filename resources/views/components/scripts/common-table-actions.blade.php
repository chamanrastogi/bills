@props([
    'deleteRoute' => null,
    'statusRoute' => null,
])


<script type="text/javascript">
    function deleteAllFunction(table) {
        var checkboxes = document.querySelectorAll('.mixed_child');
        var checkedValues = [];

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checkedValues.push(checkbox.value);
            }
        });

        if (checkedValues.length === 0) {
            toastr.warning("Please check at least one checkbox.");
        } else {
            var crf = '{{ csrf_token() }}';
            $.post("{{ $deleteRoute }}", {
                _token: crf,
                id: checkedValues,
                table: table
            }, function(data) {
                toastr.success("Selected items deleted successfully");
                checkedValues.forEach(function(val) {
                    document.querySelector('.' + table + '-' + val).remove();
                });
            });
        }
    }

    function statusFunction(id, table) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

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
                var crf = '{{ csrf_token() }}';
                $.post("{{ $statusRoute }}", {
                    _token: crf,
                    id: id,
                    table: table
                }, function(data) {
                    var elems = document.querySelector('.warning.changestatus' + id);
                    if (data == 'active') {
                        elems.classList.remove("badge-light-danger");
                        elems.classList.add("badge-light-success");
                        elems.innerText = 'Active';
                        toastr.success("Status Activated");
                    } else {
                        elems.classList.remove("badge-light-success");
                        elems.classList.add("badge-light-danger");
                        elems.innerText = 'Deactive';
                        toastr.warning("Status Deactivated");
                    }
                });
            }
        });
    }

    function deleteFunction(id, table) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

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
                var crf = '{{ csrf_token() }}';
                $.post("{{ $deleteRoute }}", {
                    _token: crf,
                    id: id,
                    table: table
                }, function(data) {
                    console.log(`.${table}-${id}`);
                    document.querySelector(`.${table}-${id}`).remove();
                    toastr.success(table + " " + id + " Deleted");
                });
            }
        });
    }
</script>
