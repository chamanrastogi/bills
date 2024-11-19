<x-main-layout>
    @section('title', breadcrumb())

 
 <div class="seperator-header layout-top-spacing">
        <a href="{{ route('admin.dashboard') }}">
            <h4 class="">Home</h4>
        </a>
    </div>
    <div class="page-content">
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Forget Password</h6>
                        {{ Form::open(['route' => 'password.email', 'class' => 'text-left login-form needs-validation', 'id' => 'login', 'method' => 'post', 'novalidate' => 'novalidate']) }}
                   
                        <div class="mb-3">

                            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

                            <x-text-input id="email" class="form-control" type="email" name="email"
                                :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="text-danger pt-3" />
                        </div>
                        
                        {!! Form::submit('Email Password Reset Link', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>

    
    
    
</x-main-layout>
