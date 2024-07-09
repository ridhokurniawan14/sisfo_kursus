<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $halaman }} - SIS</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="/img/Logo-PTCC.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/css/util.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="{{ route('login.siswa') }}" method="POST" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-20">
                        <img src="{{ isset($profile->logo) && $profile->logo ? '/storage/' . $profile->logo : '/img/unknownb.png' }}"
                            alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8"
                            width="40%">
                    </span>
                    <span class="login100-form-title p-b-30">
                        <h4>Sistem Informasi Siswa</h4>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid no_induk is: a@b.c">
                        <input autofocus autocomplete="off" class="input100 @error('no_induk') is-invalid @enderror"
                            value="{{ old('no_induk') }}" type="no_induk" name="no_induk">
                        <span class="focus-input100" data-placeholder="No. Induk"></span>
                        @error('no_induk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-15">
                        <span class="txt1">
                            Lupa Password?
                        </span>

                        <a class="txt2" href="#">
                            <a href="https://api.whatsapp.com/send/?phone=6289682154449&text=Assalamualaikum,%20Mas%20lupa%20password,%20bisa%20kirim%20password%20baru?"
                                target="_blank">Bantuan</a>
                        </a>
                        <p class="mt-1 text-muted">Copyright &copy; 2017–<?= date('Y') ?><br><b><a target="_blank"
                                    href="https://www.instagram.com/ridhoo_kurniawaan/">Ridho Kurniawan</a></b>. All
                            rights reserved </p>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/bootstrap/js/popper.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/daterangepicker/moment.min.js"></script>
    <script src="/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="/js/main.js"></script>
    <!--===============================================================================================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!--===============================================================================================-->
    @if (session('error'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            };
            toastr.error('{{ session('error') }}', 'Failed!', {
                timeOut: 5000
            });
        </script>
    @endif
    @if ($messages = Session::get('info'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            }
            toastr.info('{{ $messages }}', 'Information', {
                timeOut: 5000
            });
        </script>
    @endif
</body>

</html>
