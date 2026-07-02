@extends('frontend.layout.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>

.login-section{

    min-height:100vh;

    background:
    linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('{{ asset('UI/images/bg_3.jpg') }}');

    background-size:cover;
    background-position:center;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:80px 15px;

}

.register-card{

    width:100%;
    max-width:500px;

    background:rgba(255,255,255,.12);

    backdrop-filter:blur(18px);

    border-radius:20px;

    padding:45px;

    color:#fff;

    border:1px solid rgba(255,255,255,.2);

    box-shadow:0 20px 60px rgba(0,0,0,.35);

}

.brand{

    text-align:center;
    margin-bottom:30px;

}

.brand h2{

    font-weight:700;

}

.input-group{

    margin-bottom:18px;

}

.input-group-text{

    border:none;

    background:#fff;

    border-radius:12px 0 0 12px;

}

.form-control{

    height:55px;

    border:none;

    border-radius:0 12px 12px 0;

}

.form-control:focus{

    box-shadow:none;

}

.btn-register{

    height:55px;

    background:#01d28e;

    border:none;

    border-radius:12px;

    font-size:17px;

    font-weight:600;

}

.btn-register:hover{

    background:#00b57c;

}

.divider{

    display:flex;

    align-items:center;

    margin:25px 0;

}

.divider::before,
.divider::after{

    content:"";

    flex:1;

    height:1px;

    background:rgba(255,255,255,.3);

}

.divider span{

    padding:0 15px;

}

.google-btn{

    height:52px;

    border-radius:12px;

}

</style>

<section class="login-section">

<div class="register-card">

<div class="brand">

<h2>

<span class="text-white">CAR</span>

<span class="text-success">BOOK</span>

</h2>

<p>Create Your Account</p>

</div>

@if ($errors->any())

<div class="alert alert-danger">

{{ $errors->first() }}

</div>

@endif

<form method="POST" action="{{ route('register.otp') }}">

@csrf

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-person-fill"></i>

</span>

<input
type="text"
name="name"
class="form-control"
placeholder="Full Name"
required>

</div>

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

<div class="input-group">

<span class="input-group-text">

<i class="bi bi-shield-lock-fill"></i>

</span>

<input
type="password"
name="password_confirmation"
class="form-control"
placeholder="Confirm Password"
required>

</div>

<button class="btn btn-register text-white w-100">

Create Account

</button>

<div class="divider">

<span>OR</span>

</div>

<a href="{{ route('google.login') }}" class="btn btn-light google-btn w-100">

<img src="https://developers.google.com/identity/images/g-logo.png"
width="22"
class="me-2">

Continue with Google

</a>

<div class="text-center mt-4">

Already have an account?

<a href="{{ route('login') }}" class="text-success fw-bold">

Login

</a>

</div>

</form>

</div>

</section>

@endsection