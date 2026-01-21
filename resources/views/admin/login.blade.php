<x-other-layout>

    <!-- Session Status -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">
                <div
                    class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
						@php
				$template = \App\Models\SiteSetting::select('logo','site_title')->find(1);
			@endphp
				<div class="text-center">
						<img src="{{ asset($template->logo) }}" alt="{{ $template->site_title }}">
                           </div>
						   <hr>
							<div class="row">
                                <div class="col-md-12 mb-3">
                                    <h2>Sign In</h2>
                                    <p>Enter your username and password to login</p>
                                </div>
                                <form action="{{ route('admin.login') }}" method="POST" class="text-left login-form needs-validation" id="login" novalidate>
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username"
                                class="form-control {{ $errors->get('username') ? 'is-invalid' : '' }}" type="text"
                                name="username" :value="old('username')" autofocus required />
                            <div class="valid-feedback">
                                Looks good!
                            </div>

                            <x-input-error :messages="$errors->get('username')" class="invalid-feedback" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">

                                            <x-form.input-label for="password" :value="__('Password')" />

                                            <x-form.text-input id="password" type="password"
                                                class="form-control {{ $errors->get('password') ? 'is-invalid' : '' }}"
                                                name="password" required autocomplete="current-password" />
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>

                                            <x-form.input-error :messages="$errors->get('password')" class="invalid-feedback" />

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox" id="remember_me"
                                                    name="remember">
                                                <label class="form-check-label" for="form-check-default">
                                                    {{ __('Remember me') }}
                                                </label>
                                            </div>
                                            <div class="form-check form-check-primary form-check-inline float-end">

                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="toggle-password">
                                                    <label class="form-check-label" for="toggle-password">Show
                                                        Password</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">

                                            <x-primary-button name="submit"
                                                class="loginButton btn btn-secondary w-100">
                                                {{ __('Log in') }} <span id="loginSpinner" class="d-none">
                                                    @php
                                                        echo LOADER;
                                                    @endphp </span>
                                            </x-primary-button>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



</x-other-layout>
