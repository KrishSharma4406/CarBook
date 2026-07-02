@extends('frontend.layout.app')

@section('content')

<style>
    .login-section {

        min-height: calc(100vh - 220px);

        background: linear-gradient(rgba(0, 0, 0, .65), rgba(0, 0, 0, .65)),
        url('{{ asset("UI/images/bg_3.jpg") }}');

        background-size: cover;
        background-position: center;

        display: flex;
        justify-content: center;
        align-items: center;

        padding: 80px 15px;

    }

    .login-card {

        width: 100%;
        max-width: 450px;

        background: rgba(255, 255, 255, .12);

        backdrop-filter: blur(18px);

        border: 1px solid rgba(255, 255, 255, .2);

        border-radius: 20px;

        padding: 45px;

        box-shadow: 0 20px 60px rgba(0, 0, 0, .35);

        color: #fff;

    }

    .logo h2 {

        font-weight: 700;

    }

    .input-group {

        margin-bottom: 20px;

    }

    .input-group-text {

        background: #fff;

        border: none;

        border-radius: 12px 0 0 12px;

    }

    .form-control {

        height: 55px;

        border: none;

        border-radius: 0 12px 12px 0;

    }

    .form-control:focus {

        box-shadow: none;

    }

    .btn-login {

        height: 55px;

        border-radius: 12px;

        background: #01d28e;

        border: none;

        font-weight: 600;

    }

    .btn-login:hover {

        background: #00b57c;

    }

    .divider {

        display: flex;

        align-items: center;

        margin: 25px 0;

    }

    .divider::before,
    .divider::after {

        content: "";

        flex: 1;

        height: 1px;

        background: rgba(255, 255, 255, .3);

    }

    .divider span {

        padding: 0 15px;

    }

    .google-btn {

        height: 52px;

        border-radius: 12px;

    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<section class="login-section">

    <div class="login-card">

        <div class="logo text-center mb-4">

            <h2>

                <span class="text-white">CAR</span>

                <span class="text-success">BOOK</span>

            </h2>

            <p>Welcome Back</p>

        </div>

        @if ($errors->any())

        <div class="alert alert-danger">

            {{ $errors->first() }}

        </div>

        @endif

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-envelope-fill"></i>

                </span>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email Address"
                    required>

            </div>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-lock-fill"></i>

                </span>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required>

            </div>

            <div class="d-flex justify-content-between mb-3">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember">

                    <label class="form-check-label">

                        Remember Me

                    </label>

                </div>

                @if(Route::has('password.request'))

                <a href="{{ route('password.request') }}" class="text-white">

                    Forgot Password?

                </a>

                @endif

            </div>

            <button class="btn btn-login w-100 text-white">

                <i class="bi bi-box-arrow-in-right"></i>

                Sign In

            </button>

            <div class="divider">

                <span>OR</span>

            </div>

            <a
                href="{{ route('google.login') }}"
                class="btn btn-light w-100 google-btn align-center">

                <img
                    src="https://developers.google.com/identity/images/g-logo.png"
                    width="22"
                    class="me-2">

                Continue with Google

            </a>

            <div class="text-center mt-4">

                Don't have an account?

                <a
                    href="{{ route('register') }}"
                    class="text-success fw-bold">

                    Register

                </a>

            </div>

        </form>

    </div>

</section>

@endsection