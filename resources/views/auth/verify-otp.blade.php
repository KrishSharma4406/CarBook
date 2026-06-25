<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification | CarBook</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body{
            background:linear-gradient(135deg,#0d6efd,#6610f2);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family:'Segoe UI',sans-serif;
        }

        .verify-card{
            width:100%;
            max-width:470px;
            border:none;
            border-radius:18px;
            overflow:hidden;
            box-shadow:0 20px 45px rgba(0,0,0,.18);
        }

        .verify-header{
            background:white;
            text-align:center;
            padding:35px 20px 20px;
        }

        .verify-header .icon{
            width:90px;
            height:90px;
            background:#e9f2ff;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            color:#0d6efd;
            font-size:38px;
        }

        .verify-header h3{
            margin-top:20px;
            font-weight:700;
        }

        .verify-body{
            background:white;
            padding:30px;
        }

        .otp-input{
            height:55px;
            font-size:22px;
            font-weight:700;
            text-align:center;
            letter-spacing:8px;
        }

        .btn-primary{
            height:52px;
            font-size:17px;
            font-weight:600;
            border-radius:10px;
        }

        .btn-outline-secondary{
            border-radius:10px;
            font-weight:600;
        }

        .timer{
            font-size:15px;
            color:#6c757d;
        }

        .brand{
            color:#0d6efd;
            font-weight:bold;
            font-size:24px;
        }

        .email{
            color:#0d6efd;
            font-weight:600;
        }
    </style>

</head>

<body>

<div class="card verify-card">

    <div class="verify-header">

        <div class="icon">
            <i class="fa-solid fa-envelope-circle-check"></i>
        </div>

        <div class="brand mt-3">
            CarBook
        </div>

        <h3>Email Verification</h3>

        <p class="text-muted mb-0">
            Enter the 6-digit OTP sent to your email
        </p>

        @if(session('register_email'))
            <div class="email mt-2">
                {{ session('register_email') }}
            </div>
        @endif

    </div>

    <div class="verify-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('verify.otp.post') }}" method="POST">

            @csrf

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Verification Code
                </label>

                <input
                    type="text"
                    class="form-control otp-input"
                    name="otp"
                    maxlength="6"
                    placeholder="000000"
                    autocomplete="off"
                    required>

            </div>

            <button class="btn btn-primary w-100">

                <i class="fa-solid fa-circle-check me-2"></i>

                Verify OTP

            </button>

        </form>

        <div class="text-center mt-4">

            <div class="timer mb-2">

                OTP expires in

                <span id="countdown">
                    05:00
                </span>

            </div>

            <a href="#" class="btn btn-outline-secondary">

                <i class="fa-solid fa-rotate-right me-2"></i>

                Resend OTP

            </a>

        </div>

    </div>

</div>

<script>

let duration=300;

const timer=document.getElementById('countdown');

setInterval(function(){

    let minutes=parseInt(duration/60);

    let seconds=parseInt(duration%60);

    minutes=minutes<10?"0"+minutes:minutes;

    seconds=seconds<10?"0"+seconds:seconds;

    timer.innerHTML=minutes+":"+seconds;

    if(duration>0){
        duration--;
    }

},1000);

</script>

</body>

</html>