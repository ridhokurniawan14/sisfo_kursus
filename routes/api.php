<?php

use App\Http\Controllers\DaftarOnlineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/midtrans/webhook', function (Request $request) {
    Log::info('Webhook diterima', $request->all());

    $status = $request->transaction_status;
    $id = $request->input('order_id'); // Midtrans harus mengirim 'order_id' yang sesuai dengan 'id' di tabel tb_ppdb

    if ($status == 'settlement') {
        $update = DB::table('tb_ppdb')
            ->where('id', $id)
            ->update(['status' => 'paid']);

        if ($update) {
            Log::info("Status pembayaran berhasil diupdate untuk ID: $id");
        } else {
            Log::error("Gagal update status pembayaran untuk ID: $id");
        }
    }

    return response()->json(['message' => 'Webhook diterima']);
});

Route::post('/midtrans/callback', [DaftarOnlineController::class, 'paymentCallback']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
