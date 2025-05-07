<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
</head>
<body>
  
    <h2>Pembayaran untuk {{ $pendaftar->nm_lengkap }}</h2>
    <p>Total yang harus dibayar: Rp{{ number_format($pendaftar->total, 0, ',', '.') }}</p>

    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay("{{ $snapToken }}", {
                onSuccess: function(result) {
                    window.location.href = "/payment/success/" + result.order_id;
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran!");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                }
            });
        };
    </script>
</body>
</html>
