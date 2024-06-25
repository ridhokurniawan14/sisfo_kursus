<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Validation - PTCC</title>
    <link rel="icon" type="image/png" href="{{ asset('img/Logo-PTCC.webp') }}">
    <style>
        body {
            background-image: url('{{ url('img/lab.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            /* Warna latar belakang transparan */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            z-index: 1;
        }
    </style>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

</head>

<body>
    <div class="overlay">
        <!-- Main content -->
        <div class="container">
            <section class="content">
                <!-- Default box -->
                <div class="card-body pb-0">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-5">
                            <div class="card bg-light">
                                <div class="card-header text-muted border-bottom-0">
                                    <span class="badge badge-success"><i class="fas fa-check"></i>
                                        Document
                                        Valid</span>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ ucwords($data->nm_lengkap) }}</b></h2>
                                            <p class="text-muted text-sm">
                                                <b>No. Surat:
                                                </b>{{ str_repeat('*', 3) . substr($data->merger_certificate, 3) }}
                                            </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-lg fa-pen"></i></span>
                                                    Penandatangan: <br>Sunarto, SPd., SKom.
                                                </li>
                                                <li class="small">
                                                    <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                    Tgl. Pembuatan: <br>
                                                    {{ \Carbon\Carbon::parse($data->tgl_pembuatan)->isoFormat('D MMMM YYYY') }}
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-5 text-center">
                                            <img src="{{ asset('img/check.png') }}" alt="Check"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </section>
        </div>
    </div>


    <!-- /.content -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>

</html>
