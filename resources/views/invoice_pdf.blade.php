<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice Pendaftaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info, .biaya { margin-bottom: 10px; }
    </style>
</head>
<body>
    
      <a href="{{ route('invoice_pdf.download', ['id' => $pendaftar->id]) }}" target="_blank">Download PDF</a>

    <div class="header">
        <h2>Bukti Pembayaran</h2>
        <p>Nomor Pendaftaran: {{ $pendaftar->no_induk }}</p>
    </div>

    <div class="info">
        <strong>Nama:</strong> {{ $pendaftar->nm_lengkap }} <br>
        <strong>Program:</strong> {{ $pendaftar->program }} <br>
        <strong>Tanggal Daftar:</strong> {{ $pendaftar->tgl_daftar }} <br>
    </div>

    <div class="biaya">
        <strong>Biaya Pendaftaran:</strong> Rp{{ number_format($pendaftar->biaya_daftar) }} <br>
        <strong>Harga Program:</strong> Rp{{ number_format($pendaftar->harga) }} <br>
        <strong>Total Bayar:</strong> Rp{{ number_format($pendaftar->total) }}
    </div>

    <p><i>Terima kasih telah mendaftar.</i></p>
</body>
</html>
