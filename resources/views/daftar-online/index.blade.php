<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $halaman }} - PTCC</title>
    <link rel="icon" type="image/png"
        href="{{ isset($profile->logo) && $profile->logo ? '/storage/' . $profile->logo : '/img/unknownb.png' }}" />

    <!-- Font Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Main css -->
    <style>
        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1055;
        }

        .border-md {
            border-width: 2px;
        }

        .btn-facebook {
            background: #405D9D;
            border: none;
        }

        .btn-facebook:hover,
        .btn-facebook:focus {
            background: #314879;
        }

        .btn-twitter {
            background: #42AEEC;
            border: none;
        }

        .btn-twitter:hover,
        .btn-twitter:focus {
            background: #1799e4;
        }

        body {
            min-height: 100vh;
        }

        .form-control:not(select) {
            padding: 1.5rem 0.5rem;
        }

        select.form-control {
            height: 52px;
            padding-left: 0.5rem;
        }

        .form-control::placeholder {
            color: #ccc;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>

    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <!-- Navbar Brand -->
                <a class="navbar-brand">
                    <img src="{{ isset($profile->logo) && $profile->logo ? '/storage/' . $profile->logo : '/img/unknownb.png' }}"
                        alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="10%">
                    <span class="brand-text font-weight-light">Registration Form</span>
                </a>
            </div>
        </nav>
    </header>


    <div class="container">
        <div class="row align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt=""
                    class="img-fluid mb-3 d-none d-md-block">
                <h1>New Student</h1>
                <p class="font-italic text-muted mb-0">Please fill in the registration form completely</p>
            </div>

            <!-- Registeration Form -->
            <div class="col-md-7 col-lg-6 ml-auto">
                <div class="container mt-5">
                    <form action="{{ route('daftar-online.store') }}" method="POST">
                        @csrf
                        <div id="step1">
                            <div class="row">
                                <!-- Full Name -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-user text-muted"></i>
                                        </span>
                                    </div>
                                    <input required ="nm_lengkap" autofocus autocomplete="off" type="text"
                                        name="nm_lengkap" placeholder="Nama Lengkap"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Gender -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-venus-mars text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="gender" name="gender"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="l">Laki-laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-map-marker text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="tmp_lahir" type="text" name="tmp_lahir"
                                        placeholder="Tempat Lahir"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-calendar text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="tgl_lahir" type="date" name="tgl_lahir"
                                        placeholder="Tanggal Lahir"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Agama -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-star text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="agama" name="agama"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Pilih Agama</option>
                                        <option value="islam">Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="khonghucu">Khonghucu</option>
                                    </select>
                                </div>

                                <!-- Kewarganegaraan -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-flag text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="kewarganegaraan" name="kewarganegaraan"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>

                                <!-- Status Pekerjaan -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-briefcase text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="status_pekerjaan" name="status_pekerjaan"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Pilih Status Pekerjaan</option>
                                        <option value="pelajar">Pelajar</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="belum bekerja">Belum Bekerja</option>
                                        <option value="nelayan">Nelayan</option>
                                        <option value="petani">Petani</option>
                                        <option value="peternak">Peternak</option>
                                        <option value="pns/tni/polri">PNS/TNI/Polri</option>
                                        <option value="guru">Guru</option>
                                        <option value="karyawan swasta">Karyawan Swasta</option>
                                        <option value="pedagang/wiraswasta">Pedagang/Wiraswasta</option>
                                        <option value="buruh">Buruh</option>
                                        <option value="pensiunan">Pensiunan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <!-- Hobi -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-heart text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="hobi" type="text" name="hobi" placeholder="Hobi"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- No HP -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-phone text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="no_hp" type="text" name="no_hp" placeholder="No HP"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Pendidikan Terakhir -->
                                <div class="input-group col-lg-6 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-graduation-cap text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="pend_akhir" name="pend_akhir"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                        <option value="tidak sekolah">Tidak Sekolah</option>
                                        <option value="sd">SD</option>
                                        <option value="smp">SMP</option>
                                        <option value="slta">SLTA</option>
                                        <option value="d3">D3</option>
                                        <option value="d4/s1">D4/S1</option>
                                        <option value="s2">S2</option>
                                        <option value="s3">S3</option>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="input-group col-lg-12 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-home text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="alamat" type="text" name="alamat"
                                        placeholder="Alamat" class="form-control bg-white border-left-0 border-md">
                                </div>
                            </div>

                            <!-- Next Button -->
                            <div class="form-group col-lg-12 mx-auto">
                                <button type="button" id="nextStep" class="btn btn-primary btn-block py-2">
                                    <span class="font-weight-bold">Lanjut</span>
                                </button>
                            </div>
                        </div>

                        <div id="step2" style="display:none;">
                            <div class="row">
                                <!-- Nama Orang Tua -->
                                <div class="input-group col-lg-12 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-user text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="nm_ortu" type="text" name="nm_ortu"
                                        placeholder="Nama Orang Tua"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Pekerjaan Orang Tua -->
                                <div class="input-group col-lg-12 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-briefcase text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="pek_ortu" name="pek_ortu"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" selected disabled>Pilih Pekerjaan Orang Tua</option>
                                        <option value="pelajar">Pelajar</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="belum bekerja">Belum Bekerja</option>
                                        <option value="nelayan">Nelayan</option>
                                        <option value="petani">Petani</option>
                                        <option value="peternak">Peternak</option>
                                        <option value="pns/tni/polri">PNS/TNI/Polri</option>
                                        <option value="guru">Guru</option>
                                        <option value="karyawan/swasta">Karyawan Swasta</option>
                                        <option value="pedagang/wiraswasta">Pedagang/Wiraswasta</option>
                                        <option value="buruh">Buruh</option>
                                        <option value="pensiunan">Pensiunan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>


                                <!-- Alamat Orang Tua -->
                                <div class="input-group col-lg-12 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-home text-muted"></i>
                                        </span>
                                    </div>
                                    <input required id="alamat_ortu" type="text" name="alamat_ortu"
                                        placeholder="Alamat Orang Tua"
                                        class="form-control bg-white border-left-0 border-md">
                                </div>

                                <!-- Informasi Dari -->
                                <div class="input-group col-lg-12 mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white px-4 border-md border-right-0">
                                            <i class="fa fa-info text-muted"></i>
                                        </span>
                                    </div>
                                    <select id="info_dari" name="info_dari"
                                        class="form-control custom-select bg-white border-left-0 border-md">
                                        <option value="" disabled selected>Informasi Dari</option>
                                        <option value="teman">Teman</option>
                                        <option value="google">Google</option>
                                        <option value="saudara">Saudara</option>
                                        <option value="radio">Radio</option>
                                        <option value="koran">Koran</option>
                                        <option value="sosial media">Sosial Media (IG/FB)</option>
                                        <option value="website">Website</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Button Group -->
                            <div class="form-group col-lg-12 d-flex justify-content-between">
                                <button type="button" id="prevStep" class="btn btn-secondary m-2 btn-block mx-1">
                                    <span class="font-weight-bold">KEMBALI</span>
                                </button>
                                <button type="submit" class="btn btn-success btn-block mx-1 m-2">
                                    <span class="font-weight-bold">DAFTAR</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
            data-delay="100000">
            <div class="toast-header">
                <strong class="mr-auto">Notification</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Pendaftaran Berhasil, Silahkan ke kantor pada hari kerja <a
                    href="https://maps.app.goo.gl/Xgdn6HrGycGAwwDH9" target="_blank">klik disini</a>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                $('#successToast').toast('show');
            @endif
        });
        $(document).ready(function() {
            $('#nextStep').click(function() {
                $('#step1').hide();
                $('#step2').show();
            });

            $('#prevStep').click(function() {
                $('#step2').hide();
                $('#step1').show();
            });
        });
    </script>
    <script>
        $(function() {
            $('input, select').on('focus', function() {
                $(this).parent().find('.input-group-text').css('border-color', '#80bdff');
            });
            $('input, select').on('blur', function() {
                $(this).parent().find('.input-group-text').css('border-color', '#ced4da');
            });
        });
    </script>
</body>

</html>
