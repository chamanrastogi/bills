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
                        <h6 class="card-title fw-bold">Reset Password</h6>
                        {{ Form::open(['route' => 'password.store', 'class' => 'text-left needs-validation', 'id' => 'login', 'method' => 'post', 'novalidate' => 'novalidate']) }}
                        
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="mb-3">   
                        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}                     
                        <x-text-input id="email" class="form-control" type="email" name="email"
                                :value="old('email', $request->email)" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="text-danger pt-3" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                        {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}    
                        <x-text-input id="password" class="form-control" type="password" name="password"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="text-danger pt-3" />
                        </div>

                           <!-- Confirm Password -->
                         <div class="mb-3">
                        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-label']) !!}    
                        <x-text-input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger pt-3" />
                        </div>
                        
                        {!! Form::submit('Reset Password', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>

    
    
    
</x-main-layout>
