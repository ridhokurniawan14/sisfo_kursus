<!DOCTYPE html>
<html>

<head>
    <title>Sertifikat</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Sertifikat</h1>
        <p>Merger Certificate: {{ $merger_certificate }}</p>
        <div class="qrcode">
            <img src="{{ public_path('storage/' . $qrcodePath) }}" alt="QR Code">
        </div>
    </div>
</body>

</html>
