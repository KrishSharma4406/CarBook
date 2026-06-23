<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration | CarBook</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            min-height:100vh;
            background:#f5f7fb;
            overflow:hidden;
            font-family:'Segoe UI',sans-serif;
        }

        .main-wrapper{
            min-height:100vh;
        }

        .left-panel{
            background:linear-gradient(rgba(0,0,0,.55),
                       rgba(0,0,0,.55)),
                       url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070');
            background-size:cover;
            background-position:center;
            color:#fff;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .logo{
            font-size:42px;
            font-weight:700;
            margin-bottom:50px;
        }

        .logo span{
            color:#2d7df7;
        }

        .welcome-title{
            font-size:56px;
            font-weight:700;
            line-height:1.2;
        }

        .welcome-title span{
            color:#2d7df7;
        }

        .feature-box{
            display:flex;
            gap:20px;
            margin-top:30px;
        }

        .feature-icon{
            width:60px;
            height:60px;
            background:#2d7df7;
            border-radius:15px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:24px;
        }

        .right-panel{
            display:flex;
            align-items:center;
            justify-content:center;
            background:#f8f9fc;
        }

        .register-card{
            width:100%;
            max-width:650px;
            background:#fff;
            border-radius:25px;
            padding:50px;
            box-shadow:0 15px 50px rgba(0,0,0,.08);
        }

        .avatar{
            width:90px;
            height:90px;
            background:#2d7df7;
            color:#fff;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            margin-top:-95px;
            font-size:35px;
        }

        .register-card h2{
            font-weight:700;
            text-align:center;
        }

        .register-card p{
            text-align:center;
            color:#6c757d;
        }

        .form-control{
            height:58px;
            border-radius:12px;
        }

        .input-group-text{
            border-radius:12px 0 0 12px;
            background:#fff;
        }

        .btn-register{
            height:55px;
            border:none;
            border-radius:12px;
            background:linear-gradient(90deg,#2d7df7,#1957c2);
            font-size:18px;
            font-weight:600;
        }

        @media(max-width:991px){

            .left-panel{
                display:none;
            }

            .register-card{
                margin:30px;
            }
        }

    </style>
</head>

<body>

<div class="container-fluid main-wrapper">

    <div class="row h-100">

        <div class="col-lg-6 left-panel">

            <div class="logo">
                Car<span>Book</span>
            </div>

            <h1 class="welcome-title">
                Welcome to <br>
                <span>CarBook</span> Admin
            </h1>

            <p class="mt-4">
                Create your admin account and start managing
                your platform with ease.
            </p>

            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>

                <div>
                    <h5>Secure & Reliable</h5>
                    <p>Top level protection for your data.</p>
                </div>
            </div>

            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>

                <div>
                    <h5>Fast & Efficient</h5>
                    <p>Manage everything quickly.</p>
                </div>
            </div>

            <div class="feature-box">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>

                <div>
                    <h5>Smart Dashboard</h5>
                    <p>Analytics at your fingertips.</p>
                </div>
            </div>

        </div>

        <div class="col-lg-6 right-panel">

            <div class="register-card">

                <div class="avatar">
                    <i class="fas fa-user"></i>
                </div>

                <h2 class="mt-4">
                    Create Admin Account
                </h2>

                <p>
                    Fill in the details to register
                </p>

                @if ($errors->has('admin'))
                <div class="alert alert-danger">
                    {{ $errors->first('admin') }}
                </div>
                @endif

                <form method="POST" action="{{ route('admin.register.store') }}">
                    @csrf

                    <div class="input-group mb-3">

                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter your full name">
                    </div>

                    <div class="input-group mb-3">

                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>

                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Enter your email">
                    </div>

                    <div class="input-group mb-3">

                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Enter password">
                    </div>

                    <div class="input-group mb-4">

                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Confirm password">
                    </div>

                    <button class="btn btn-primary btn-register w-100">
                        <i class="fas fa-user-plus me-2"></i>
                        Register Admin
                    </button>

                </form>

                <div class="text-center mt-4">

                    Already have an account?

                    <a href="{{ route('admin.login') }}">
                        Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>