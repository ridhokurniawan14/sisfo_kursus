<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/png" href="/img/Logo-PTCC.png">
    <title>Cetak Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }

        .qrcode {
            margin-top: 20px;
        }

        /* Style untuk halaman kedua (penilaian) */
        .page-two {
            page-break-before: always;
        }

        /* Style untuk konten halaman kedua */
        .assessment {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Halaman Pertama: Sertifikat -->
    <div class="container">
        <h1>Sertifikat</h1>
        <p>Merger Certificate: {{ $merger_certificate }}</p>
        <div class="qrcode">
            {{-- <img src="{{ asset('storage/' . $qrCodePath) }}" alt="QR Code"> --}}
        </div>
    </div>
    <!-- Halaman Kedua: Penilaian -->
    <div class="page-two">
        <div class="assessment">
            <h1>Penilaian</h1>
            <!-- Konten penilaian disini -->
        </div>
    </div>
</body>

</html>
