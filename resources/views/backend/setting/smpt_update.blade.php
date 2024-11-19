<x-main-layout>
    @section('title', breadcrumb())
    @section('title', breadcrumb())


    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title fw-bold pb-4">Update SMTP Setting </h6>

                {{-- resources/views/components/backend/backend_component/smtp-settings-form.blade.php --}}
                <x-backend.backend_component.smtp-settings-form :setting="$setting" />

            </div>
        </div>
    </div>

    </x-dashboard-layout>
