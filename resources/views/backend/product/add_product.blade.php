<x-main-layout>
    @section('title', breadcrumb())


    <div class="seperator-header layout-top-spacing">
        <a href="{{ route('products.index') }}">
            <h4 class="">Show Product</h4>
        </a>
    </div>
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Add Product</h6>

                        {{-- resources/views/components/backend/backend_component/product-form.blade.php --}}
                        <x-backend.backend_component.product-form :$purities :$units :$types :$categories
                            :isEdit="false" />

                    </div>
                </div>
            </div>
        </div>

    </div>



    @section('script')
        <script>
            function mainThamUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(document).ready(function() {

                $(document).ready(function() {

                    $('#category_id').on('change', function() {

                        let category_id = $(this).val();
                        let _token = '{{ csrf_token() }}';
						
                        function loadData(url, target) {
                            $.post(url, {
                                _token,
                                category_id,								
                            }, function(result) {
                                $(target).html(result);
                            });
                        }

                        loadData("{{ route('product.purity_units') }}", '#prurities_name');
                        loadData("{{ route('category.types.all') }}", '#types_name');

                    });

                });

            });
        </script>

    @stop

</x-main-layout>
