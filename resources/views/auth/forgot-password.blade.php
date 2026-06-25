<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>

        body{
            background:#eef2f7;
            font-family:'Poppins',sans-serif;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .forgot-box{
            width:100%;
            max-width:450px;
            background:#fff;
            border-radius:18px;
            padding:40px;
            box-shadow:0 15px 40px rgba(0,0,0,.08);
        }

        .icon-box{
            width:90px;
            height:90px;
            margin:auto;
            border-radius:50%;
            background:#edf4ff;
            display:flex;
            justify-content:center;
            align-items:center;
            margin-bottom:20px;
        }

        .icon-box i{
            color:#0d6efd;
            font-size:38px;
        }

        h2{
            text-align:center;
            font-weight:700;
            margin-bottom:10px;
        }

        p{
            text-align:center;
            color:#666;
            margin-bottom:30px;
        }

        .form-control{
            height:52px;
            border-radius:10px;
        }

        .btn-reset{
            width:100%;
            height:52px;
            border-radius:10px;
            font-size:17px;
            font-weight:600;
        }

        .back-login{
            text-align:center;
            margin-top:25px;
        }

        .back-login a{
            text-decoration:none;
            font-weight:600;
        }

    </style>

</head>

<body>

<div class="forgot-box">

    <div class="icon-box">
        <i class="fa-solid fa-lock"></i>
    </div>

    <h2>Forgot Password?</h2>

    <p>
        Enter your registered email address and we'll send you a password reset link.
    </p>

    {{-- Success Message --}}
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email"
                required
            >

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <button class="btn btn-primary btn-reset">
            <i class="fa-solid fa-paper-plane"></i>
            Send Reset Link
        </button>

    </form>

    <div class="back-login">

        <a href="{{ route('login') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Login
        </a>

    </div>

</div>

</body>
</html>