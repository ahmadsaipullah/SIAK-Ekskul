<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Akun | SMK PGRI CIKUPA</title>

    @include('includes.style')

    <style>
        body {
            background: linear-gradient(135deg, #1b1c3c, #4b6cb7);
        }

        .register-box {
            max-width: 450px;
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

        .register-box-msg {
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ asset('assets/img/logoft.png') }}" alt="Logo SMK">
                <h6 class="mt-2 text-white">SMK PGRI CIKUPA</h6>
            </div>
            <div class="card-body">
                <p class="register-box-msg">Daftarkan akun baru Anda</p>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="input-group mb-3">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- No HP -->
                    <div class="input-group mb-3">
                        <input type="number" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="Nomor Handphone" value="{{ old('no_hp') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-phone"></span></div>
                        </div>
                    </div>
                    @error('no_hp') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Email -->
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Konfirmasi Password -->
                    <div class="input-group mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Konfirmasi Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror

                    <!-- Terms -->
                    <div class="row mb-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms"> Saya menyetujui syarat & ketentuan </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">Saya sudah punya akun</a>
            </div>
        </div>
    </div>

    @include('includes.script')
</body>

</html>
