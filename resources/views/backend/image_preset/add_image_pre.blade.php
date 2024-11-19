<x-main-layout>
    @section('title', breadcrumb())
    <div class="seperator-header layout-top-spacing">
        <a href="{{ route('image_preset.index') }}">
            <h4 class="">Show All Image Preset</h4>
        </a>
    </div>
    <div class="page-content">


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Add Image Preset</h6>

                        {{-- resources/views/components/backend/backend_component/image-preset-form.blade.php --}}
                        <x-backend.backend_component.image-preset-form :isEdit="false" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-main-layout>
