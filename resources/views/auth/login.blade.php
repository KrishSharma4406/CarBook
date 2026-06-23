<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarBook | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            min-height:100vh;
            background:url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070')
            center center/cover no-repeat;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:'Segoe UI',sans-serif;
        }

        .overlay{
            position:absolute;
            inset:0;
            background:rgba(0,0,0,.55);
        }

        .login-card{
            position:relative;
            z-index:2;
            width:100%;
            max-width:450px;
            padding:40px;
            border-radius:20px;
            backdrop-filter:blur(15px);
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.2);
            box-shadow:0 8px 32px rgba(0,0,0,.25);
            color:#fff;
        }

        .brand{
            text-align:center;
            margin-bottom:30px;
        }

        .brand h2{
            font-weight:700;
            margin-bottom:5px;
        }

        .brand p{
            color:#ddd;
        }

        .form-control{
            height:50px;
            border-radius:10px;
        }

        .btn-login{
            height:50px;
            border-radius:10px;
            background:#ff6b00;
            border:none;
            font-weight:600;
        }

        .btn-login:hover{
            background:#e05f00;
        }

        .extra-links a{
            color:#fff;
            text-decoration:none;
        }

        .extra-links a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

<div class="overlay"></div>

<div class="login-card">

    <div class="brand">
        <h2>CarBook</h2>
        <p>Welcome Back</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>
        </div>

        <div class="d-flex justify-content-between mb-3">

            <div class="form-check">
                <input type="checkbox"
                       class="form-check-input"
                       name="remember">

                <label class="form-check-label">
                    Remember Me
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-white">
                    Forgot Password?
                </a>
            @endif

        </div>

        <button type="submit"
                class="btn btn-login text-white w-100">
            Sign In
        </button>

        <div class="text-center mt-4 extra-links">

            <span>Don't have an account?</span>

            <a href="{{ route('register') }}">
                Register
            </a>

        </div>

    </form>

</div>

</body>
</html>