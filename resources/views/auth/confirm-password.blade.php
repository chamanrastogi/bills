<x-main-layout>
    @section('title', breadcrumb())

 
 <div class="seperator-header layout-top-spacing">
        <a href="{{ route('admin.dashboard') }}">
            <h4 class="">Home</h4>
        </a>
    </div>
    <div class="page-content">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Show Confirm Password</h6>
                        {{ Form::open(['route' => 'password.confirm', 'class' => 'text-left login-form needs-validation', 'id' => 'login', 'method' => 'post', 'novalidate' => 'novalidate']) }}

                        
                        <div class="mb-3">

                            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

                            {!! Form::text('password', $value = null, ['class' => 'form-control','required' => 'required', 'placeholder' => 'Password']) !!}
                            @error('password')
                                <span class="text-danger pt-3">{{ $errors->get('password') }}</span>
                            @enderror
                        </div>
                        
                        {!! Form::submit('Confirm', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>

    
    
    
</x-main-layout>
