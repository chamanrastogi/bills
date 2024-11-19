<x-dashboard-layout>
    @section('title', breadcrumb())

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 <div class="seperator-header layout-top-spacing">
        <a href="{{ route('add.admin') }}">
            <h4 class="">Add User</h4>
        </a>
    </div>
    <div class="page-content">


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">All User</h6>

                        <div class="table-responsive">
                            <table id="user_ajax" class="table dt-table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Image</th>
                                        <th>Top</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th class="text-center">Action </th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
     @if ($users->count() != 0)
       
           
  <script type="text/javascript">
            $(document).ready(function() {
                $('#user_ajax').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('users.ajax_load') }}",
                    "aaSorting": [
                        [1, "desc"]
                    ],
                    "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l  B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                        "<'table-responsive'tr>" +
                        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                    buttons: {
                        buttons: [{
                                extend: 'copy',
                                className: 'btn btn-sm'
                            },
                            {
                                extend: 'csv',
                                className: 'btn btn-sm'
                            },
                            {
                                extend: 'excel',
                                className: 'btn btn-sm'
                            },
                            {
                                extend: 'print',
                                className: 'btn btn-sm'
                            }
                        ]
                    },
                    "oLanguage": {
                        "oPaginate": {
                            "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                        },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search...",
                        "sLengthMenu": "Results :  _MENU_",
                    },
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "image"
                        },
                        {
                            "data": "top"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "phone"
                        },
                        {
                            "data": "role"
                        },
                        {
                            "data": "action"
                        },
                    ],
                    "drawCallback": function( settings ) {
        feather.replace();
        
    },
                    "lengthMenu": [
                        [10, 25, 50, 100, 1000, 2000, 3000, 10000, -1],
                        [10, 25, 50, 100, 1000, 2000, 3000, 10000]
                    ],
                    "pageLength": 10,
                });
            })
        </script>
         <script type="text/javascript">
            function deleteFunction(id) {

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
                            var elems = document.querySelector('.admin-' + id);
                            elems.remove();
                            var crf = '{{ csrf_token() }}';
                            $.post("{{ route('delete.admin') }}", {
                                _token: crf,
                                id: id
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
</x-backend-layout>
