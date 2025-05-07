<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarOnline; // Pastikan model sesuai dengan tabel tb_ppdb
use Midtrans\Config;
use Midtrans\Notification;
use Log;

class MidtransController extends Controller
{
    public function handleNotification(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Tangkap notifikasi dari Midtrans
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        // Cari data pendaftar berdasarkan order_id
        $pendaftar = PendaftarOnline::where('id', $orderId)->first();

        if (!$pendaftar) {
            return response()->json(['message' => 'Pendaftar tidak ditemukan'], 404);
        }

        // Cek status pembayaran
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            // Pembayaran sukses, ubah status jadi "paid"
            $pendaftar->status = 'paid';
        } elseif ($transactionStatus == 'pending') {
            // Masih menunggu pembayaran
            $pendaftar->status = 'unpaid';
        } elseif ($transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            // Pembayaran gagal atau expired
            $pendaftar->status = 'unpaid';
        }

        $pendaftar->save();

        return response()->json(['message' => 'Notification received'], 200);
    }
}
