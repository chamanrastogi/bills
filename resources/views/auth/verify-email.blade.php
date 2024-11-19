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
                        @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="row mrg-r-10 mrg-l-10">
                                <div>
                                    <x-primary-button class="btn btn-midium theme-btn btn-radius ">
                                        {{ __('Resend Verification Email') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>

                        
                            <div class="row mrg-r-10 mrg-l-10">
                                <a href="{{ route('logout') }}"
                                    class="btn btn-midium btn-radius">
                                    {{ __('Log Out') }}
                                </a>
                            </div>
                       
                    </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    
    
    
</x-main-layout>
