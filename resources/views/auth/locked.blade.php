{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <div class="mb-4 text-sm text-gray-600">--}}
{{--            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--        </div>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Locked') }}</div><div class="card-body">--}}
{{--                        <form method="POST" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">--}}
{{--                            @csrf                        --}}
{{--                            <div class="form-group row">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}
{{--                                    @if ($errors->has('password'))--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>                        --}}
{{--                            <div class="form-group row mb-0">--}}
{{--                                <div class="col-md-8 offset-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        {{ __('Unlock') }}--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Business Help - Inventory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
{{--    <style>--}}
{{--        input {outline: none;}--}}
{{--        input:-webkit-autofill {--}}
{{--            -webkit-box-shadow: inset 0 0 0 50px #fff !important; /* Цвет фона */--}}
{{--            -webkit-text-fill-color: # !important; /* цвет текста */--}}
{{--            color: #999 !important; /* цвет текста */--}}
{{--        }--}}
{{--    </style>--}}
</head>

<body class="left-side-menu-dark">

<div id="wrapper" class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <a href="{{ route('dashboard') }}">
                                <span><img src="{{ asset('assets/images/logo-new.png') }}" alt="" height="22"></span>
                            </a>
                        </div>

                        <div class="text-center w-75 m-auto">
{{--                            <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle avatar-lg img-thumbnail">--}}
                            <h4 class="text-dark-50 text-center mt-3">Hi ! {{ Auth::user()->name }} </h4>
                            <p class="text-muted mb-4">Enter your password to access the admin.</p>
                        </div>

                        <form method="POST" action="{{ route('login.unlock') }}" aria-label="{{ __('Locked') }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="password" type="password" autocomplete="off" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-8 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Unlock') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Not you? return <a href="pages-login.html" class="text-muted font-weight-medium ml-1">Sign In</a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>
</html>

