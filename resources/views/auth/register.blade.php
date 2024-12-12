@extends('layouts.app')

@section('auth')
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="logo" width="50" class="shadow-light">
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>Register</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.form') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" placeholder="Ex: Budi"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                name="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" placeholder="Ex: budi@gmail.com"
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                name="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" placeholder="Enter Password Here ..."
                                        class="form-control @error('password') is-invalid @enderror pwstrength"
                                        data-indicator="pwindicator" name="password">
                                    <div class="input-group-append">
                                        <span id="togglePassword" class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" placeholder="Enter Password Here ..."
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation">
                                    <div class="input-group-append">
                                        <span id="togglePasswordConfirmation" class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Register
                            </button>
                        </div>
                    </form>
                <div class="mb-3 text-center">
                    Already Have an account? <a href="{{ route('login') }}">Log In</a>
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
            // Toggle password visibility for the main password field
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

            // Toggle password visibility for the confirmation password field
            $('#togglePasswordConfirmation').click(function() {
                var passwordConfirmField = $('#password_confirmation');
                var type = passwordConfirmField.attr('type') === 'password' ? 'text' : 'password';
                passwordConfirmField.attr('type', type);

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
