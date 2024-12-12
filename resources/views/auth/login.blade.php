@extends('layouts.app')

@section('auth')
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="logo" width="50" class="shadow-light">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Login</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.form') }}" class="needs-validation">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email"
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                name="email" tabindex="1" placeholder="Ex: budi@gmail.com" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-block mb-4">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        tabindex="2" placeholder="Enter Password Here ...">
                                    <div class="input-group-append">
                                        <span id="togglePassword" class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                    </form>

                    <div class="mb-3 text-center">
                        Don't have an account? <a href="{{ route('register') }}">Create One</a>
                    </div>
                </div>
            </div>
            @include('partials.auth-wm')
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Toggle password visibility for the login form
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);

                var icon = $(this).find('i');
                if (type === 'text') {
                    icon.removeClass('fa-lock').addClass('fa-unlock');
                } else {
                    icon.removeClass('fa-unlock').addClass('fa-lock');
                }
            });
        });
    </script>
@endpush
