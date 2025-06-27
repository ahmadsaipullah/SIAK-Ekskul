<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SMK PGRI CIKUPA</title>

    @include('includes.style')

    <style>
        body {
            background: linear-gradient(135deg, #1b1c3c, #4b6cb7);
        }

        .login-box {
            max-width: 400px;
            margin: 60px auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #1b1c3c;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-header img {
            width: 90px;
            margin-top: 10px;
        }

        .login-box-msg {
            font-weight: 500;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #1b1c3c;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #1b1c3c;
            border-color: #1b1c3c;
        }

        .btn-primary:hover {
            background-color: #3344a0;
            border-color: #3344a0;
        }

        .icheck-primary input:checked + label::before {
            background-color: #1b1c3c;
            border-color: #1b1c3c;
        }

        .text-danger {
            font-size: 12px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo SMK" class="img-fluid">
                <h6 class="mt-2 text-white">SMK PGRI CIKUPA</h6>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silakan login untuk melanjutkan</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-3 text-success" :status="session('status')" />

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <!-- Email -->
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Daftar akun baru</a>
                </p>
            </div>
        </div>
    </div>

    @include('includes.script')
</body>

</html>
