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

                        {{ Form::open([
                            'route' => ['billing.payments', $customer],
                            'class' => 'forms-sample needs-validation',
                            'method' => 'post',
                            'novalidate' => 'novalidate',
                            'files' => true,
                        ]) }}


                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    {!! Form::label('daterange', 'Date Range', ['class' => 'form-label']) !!}
                                    {!! Form::text('daterange', Carbon\Carbon::now()->format('d-m-Y'), [
                                        'class' => 'form-control',
                                        'id' => 'rangeCalendarFlatpickrs',
                                        'required' => 'required',
                                        'placeholder' => 'Date Range',
                                    ]) !!}
                                    @error('end')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {!! Form::submit('Submit', [
                            'class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0',
                        ]) !!}
                        {{ Form::close() }}

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
