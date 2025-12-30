<x-dashboard-layout>
    @section('title', breadcrumb())

    @section('style')
        <link href="{{ asset('backend/assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('backend/assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('backend/assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
            type="text/css">
    @stop
    <div class="seperator-header layout-top-spacing">
        <a href="{{ route('customers.index') }}">
            <h4 class="">Show Customer</h4>
        </a>
    </div>
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Ledger</h6>

                        <x-form.form
                            :route="route('billing.payments', $customer)"
                            method="POST"
                            enctype="multipart/form-data"
                            class="forms-sample needs-validation"
                            novalidate
                        >

                            <div class="row">
                                <div class="col-6 mb-3">

                                    <x-form.input-label
                                        for="daterange"
                                        value="Date Range"
                                    />

                                    <x-form.text-input
                                        name="daterange"
                                        id="rangeCalendarFlatpickrs"
                                        :value="\Carbon\Carbon::now()->format('d-m-Y')"
                                        placeholder="Date Range"
                                        required
                                    />

                                    <x-form.input-error
                                        :messages="$errors->get('daterange')"
                                    />

                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <x-form.button type="submit" class="btn-outline-primary">
                                Submit
                            </x-form.button>

                        </x-form.form>

                    </div>
                </div>
            </div>
        </div>

    </div>



    @section('script')
    <script src="{{ asset('backend/assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>

    <script>
        $(document).ready(function() {
            var f1 = flatpickr(document.getElementById('rangeCalendarFlatpickrs'), {
                mode: "range"
            });


        });
    </script>

@stop


</x-dashboard-layout>
