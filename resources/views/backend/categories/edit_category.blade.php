<x-main-layout>
     @section('title', breadcrumb())
    <div class="seperator-header layout-top-spacing">
        <a href="{{ route('category.index') }}">
            <h4 class="">Show Service</h4>
        </a>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Edit Service</h6>
                        {{-- resources/views/components/backend/backend_component/category-form.blade.php --}}
                        <x-backend.backend_component.category-form :category="$category" :isEdit="true" />

                    </div>
                </div>
            </div>
        </div>

    </div>
   <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-main-layout>
