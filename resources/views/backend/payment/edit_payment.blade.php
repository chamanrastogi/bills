<x-main-layout>
    @section('title', breadcrumb())
    <div class="seperator-header layout-top-spacing">
         <a href="{{ route('customers.index') }}">
            <h4 class="">Show Customers</h4>
        </a>
    </div>
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Edit Payment </h6>
                        {{-- resources/views/components/backend/backend_component/payment-form.blade.php --}}
                        <x-backend.backend_component.payment-form :modes=$payment_modes :$billing
                            :isEdit="true" />

                        </div>
                </div>
            </div>
        </div>

    </div>
   
    </x-dashboard-layout>
