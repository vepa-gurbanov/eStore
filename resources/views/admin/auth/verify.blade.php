<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-auth.css') }}">
    <title>Verify</title>

    <style>
        .height-100 {
            height: 100vh
        }

        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .card h6 {
            color: red;
            font-size: 20px
        }

        .inputs input {
            width: 40px;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: red
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid red
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: red;
            border: 1px solid red;
            width: 140px
        }
    </style>
</head>
<body class="text-center">
@include('admin.app.alert')
<main class="form-signin w-100 m-auto">
    <form action="{{ route('admin.verify', $id) }}" method="POST">
        @csrf
        @honeypot
        <div class="form-floating">
            <input type="text" class="form-control" name="otp_code" id="otp_code">
            <label for="otp_code">OTP Code</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary signin" type="submit">Verify</button>
    </form>
</main>

<div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="position-relative">
        <div class="card p-2 text-center">
            <h6>Please enter the one time password <br> to verify your account</h6>
            <div> <span>A code has been sent to</span> <small>*******9897</small> </div>
            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
            </div>
            <div class="mt-4"> <button class="btn btn-danger px-4 validate">Validate</button> </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        function OTPInput() {
            const inputs = document.querySelectorAll('#otp > *[id]');
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].addEventListener('keydown', function(event) {
                    if (event.key==="Backspace" ) {
                        inputs[i].value='' ; if (i !==0) inputs[i - 1].focus();
                    } else {
                        if (i===inputs.length - 1 && inputs[i].value !=='' ) {
                            return true;
                        } else if (event.keyCode> 47 && event.keyCode < 58) {
                            inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        } else if (event.keyCode> 64 && event.keyCode < 91) {
                            inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault();
                        }
                    }
                });
            }
        }
        OTPInput();
    });
</script>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
