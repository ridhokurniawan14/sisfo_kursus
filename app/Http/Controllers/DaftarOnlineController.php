<?php

namespace App\Http\Controllers;

use App\Models\PendaftarOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Pendaftar;
// use Barryvdh\DomPDF\Facade as PDF;

class DaftarOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $biayaPendaftaran = DB::table('tb_biaya_pendaftaran')

            ->orderBy('id', 'desc')
            ->first(); // Ambil data terbaru

        return view('daftar-online.index', [
            "halaman" => "Pendaftaran Online",
            "judul" => "Pendaftaran Online",
            "biayaPendaftaran" => $biayaPendaftaran,
            "program" => $request->query('program'),
            "harga" => $request->query('harga'),
            "id_program"=> $request->query('code'),
            "id_pilihan"=> $request->query('pilihan'),
            "pil_program"=> $request->query('pil_prog')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil no_induk dan nisn terakhir
        $lastPendaftar = DB::table('tb_pendaftar')->orderBy('no_induk', 'desc')->first();
        $newNoInduk = $lastPendaftar ? $lastPendaftar->no_induk + 1 : 1; // Jika belum ada, mulai dari 1
        $newNisn = $lastPendaftar ? $lastPendaftar->nisn + 1 : 1; // Jika belum ada, mulai dari 1

        // Kembali ke halaman pendaftaran
        return view('dashboard.pendaftaran.offline.create', [
            "halaman" => "Pendaftaran Peserta Didik",
            "title" => "Pendaftaran",
            "tab_title" => "Tambah Peserta Didik",
            "newNoInduk" => $newNoInduk,
            "newNisn" => $newNisn,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validasi data form
        $validatedData = $request->validate([
            'nm_lengkap' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'tmp_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'kewarganegaraan' => 'required|string|max:3',
            'status_pekerjaan' => 'required|string|max:50',
            'hobi' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'pend_akhir' => 'required|string|max:50',
            'nm_ortu' => 'required|string|max:255',
            'pek_ortu' => 'required|string|max:50',
            'alamat_ortu' => 'required|string|max:255',
            'info_dari' => 'required|string|max:50',
            'program' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'biaya_daftar' => 'required|numeric',
            'id_program' => 'nullable|numeric',
            'id_pilihan' => 'nullable|numeric',
            'pil_program' => 'required|string',
        ]);
        // Mengambil no_induk dan nisn terakhir
        $lastPendaftar = DB::table('tb_pendaftar')->orderBy('no_induk', 'desc')->first();
        $newNoInduk = $lastPendaftar ? $lastPendaftar->no_induk + 1 : 1; // Jika belum ada, mulai dari 1
        $newNisn = $lastPendaftar ? $lastPendaftar->nisn + 1 : 1; // Jika belum ada, mulai dari 1

        // Pastikan biaya_daftar ada di request
        // if (!$request->has('biaya_daftar')) {
        //     return back()->with('error', 'Biaya pendaftaran tidak ditemukan.');
        // }
        // Hitung total harga + biaya pendaftaran
        $validatedData['total'] = $validatedData['harga'] + $validatedData['biaya_daftar'];
        $validatedData['status'] = 'unpaid'; // Set default status

        // Tambahkan nilai default untuk no_induk dan nisn
        $validatedData['no_induk'] = $newNoInduk;
        $validatedData['nisn'] = $newNisn;
        $validatedData['tgl_daftar'] = now(); // current timestamp


        // Simpan data ke database
        $pendaftar =PendaftarOnline::create($validatedData);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat data transaksi Midtrans
        $transaction = [
            'transaction_details' => [
                'order_id' => 'PPDB-' . $pendaftar->id,
                'gross_amount' => $pendaftar->total,
            ],
            'customer_details' => [
                'first_name' => $pendaftar->nm_lengkap,
                'phone' => $pendaftar->no_hp,
            ],

            'callbacks' => [
                'finish' => config('services.midtrans.success_redirect'), // Redirect setelah sukses
                'error' => config('services.midtrans.failed_redirect'), // Redirect jika gagal
            ],
        ];

        // Buat token Midtrans
        $snapToken = Snap::getSnapToken($transaction);

        // Kirim token ke view
        return view('daftar-online.payment', [
            'snapToken' => $snapToken,
            'pendaftar' => $pendaftar,
        ]);

        // Redirect atau respon sesuai kebutuhan
        // return back()->with('success', 'Pendaftaran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }


    // public function paymentCallback(Request $request)
    // {
    //     // Ambil server key dari konfigurasi
    //     $serverKey = config('services.midtrans.server_key');

    //     // Buat signature key untuk verifikasi
    //     $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    //     // Validasi Signature Key
    //     if ($hashed !== $request->signature_key) {
    //         return response()->json(['message' => 'Invalid signature'], 403);
    //     }

    //     // Ambil ID pendaftar dari order_id
    //     $id = str_replace('PPDB-', '', $request->order_id);
    //     $pendaftar = PendaftarOnline::find($id);

    //     if (!$pendaftar) {
    //         return response()->json(['message' => 'Order not found'], 404);
    //     }

    //     // Mengambil no_induk dan nisn terakhir
    //     $lastPendaftar = Pendaftar::orderBy('no_induk', 'desc')->first();
    //     $newNoInduk = $lastPendaftar ? $lastPendaftar->no_induk + 1 : 1; // Jika belum ada, mulai dari 1
    //     $newNisn = $lastPendaftar ? $lastPendaftar->nisn + 1 : 1; // Jika belum ada, mulai dari 1

    //     // Cek status transaksi dari Midtrans
    //     if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
    //         $pendaftar->update(['status' => 'paid']);

    //         // Salin data ke tb_pendaftar
    //         $data = [
    //             'no_induk'         => $newNoInduk, // no_induk baru yang di-generate
    //             'nm_lengkap'       => $pendaftar->nm_lengkap,
    //             'tmp_lahir'        => $pendaftar->tmp_lahir,
    //             'tgl_lahir'        => $pendaftar->tgl_lahir,
    //             'gender'           => $pendaftar->gender,
    //             'nisn'             => $newNisn, // Set nisn berdasarkan no_induk
    //             'nik'              => $pendaftar->nik,
    //             'agama'            => $pendaftar->agama,
    //             'kewarganegaraan'  => $pendaftar->kewarganegaraan,
    //             'pend_akhir'       => $pendaftar->pendidikan,
    //             'email'            => $pendaftar->email,
    //             'no_hp'            => $pendaftar->no_hp,
    //             'status_pekerjaan' => 'siswa',
    //             'tgl_masuk'        => now(),
    //             'password'         => bcrypt($pendaftar->tgl_lahir), // atau default tertentu
    //             'alamat'           => $pendaftar->alamat,
    //             'rt'               => $pendaftar->rt,
    //             'rw'               => $pendaftar->rw,
    //             'kel'              => $pendaftar->kel,
    //             'kec'              => $pendaftar->kec,
    //             'kd_pos'           => $pendaftar->kd_pos,
    //             'kab'              => $pendaftar->kab,
    //             'provinsi'         => $pendaftar->provinsi,
    //             'jns_tinggal'      => $pendaftar->jns_tinggal,
    //             'nm_ayah'          => $pendaftar->nm_ayah,
    //             'nik_ayah'         => $pendaftar->nik_ayah,
    //             'tgl_ayah'         => $pendaftar->tgl_ayah,
    //             'pend_ayah'        => $pendaftar->pend_ayah,
    //             'pek_ayah'         => $pendaftar->pek_ayah,
    //             'nm_ibu'           => $pendaftar->nm_ibu,
    //             'nik_ibu'          => $pendaftar->nik_ibu,
    //             'tgl_ibu'          => $pendaftar->tgl_ibu,
    //             'pend_ibu'         => $pendaftar->pend_ibu,
    //             'pek_ibu'          => $pendaftar->pek_ibu,
    //             'alamat_ortu'      => $pendaftar->alamat_ortu,
    //             'hp_ortu'          => $pendaftar->hp_ortu,
    //             'telepon_ortu'     => $pendaftar->telepon_ortu,
    //             'anak_ke'          => $pendaftar->anak_ke,
    //             'nm_wali'          => $pendaftar->nm_wali,
    //             'nik_wali'         => $pendaftar->nik_wali,
    //             'tgl_wali'         => $pendaftar->tgl_wali,
    //             'pend_wali'        => $pendaftar->pend_wali,
    //             'pek_wali'         => $pendaftar->pek_wali,
    //             'alamat_wali'      => $pendaftar->alamat_wali,
    //             'hp_wali'          => $pendaftar->hp_wali,
    //         ];


    //         // Cek apakah data dengan no_induk sudah ada di tb_pendaftar
    //         $alreadyExists = Pendaftar::where('no_induk', $newNoInduk)->exists();

    //         if (!$alreadyExists) {
    //             // Jika belum ada, simpan ke tb_pendaftar
    //             Pendaftar::create($data);
    //         }
    //         // Simpan ke tabel tb_pendaftar
    //         // Pendaftar::create($data);

    //         // Generate invoice dan kirim WA
    //         $invoicePath = $this->generateInvoice($pendaftar);
    //         $this->sendWhatsAppReceipt($pendaftar, $invoicePath);

    //         return redirect()->route('katalog')->with([
    //             'success' => 'Pembayaran berhasil!',
    //             'invoice' => $invoicePath
    //         ]);
    //     }
    // }
    public function paymentCallback(Request $request)
    {
        // Ambil server key dari konfigurasi
        $serverKey = config('services.midtrans.server_key');

        // Buat signature key untuk verifikasi
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Validasi Signature Key
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil ID pendaftar dari order_id
        $id = str_replace('PPDB-', '', $request->order_id);
        $pendaftar = PendaftarOnline::find($id);

        if (!$pendaftar) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Pastikan statusnya bukan 'paid' untuk menghindari duplikasi
        if ($pendaftar->status === 'paid') {
            return response()->json(['message' => 'Payment already processed'], 409);
        }

        // Mulai transaksi database untuk menjaga konsistensi
        DB::transaction(function () use ($pendaftar) {
            // Update status pembayaran
            $pendaftar->update(['status' => 'paid']);

            // Mengambil no_induk dan nisn terakhir
            $lastPendaftar = Pendaftar::orderBy('no_induk', 'desc')->first();
            $newNoInduk = $lastPendaftar ? $lastPendaftar->no_induk + 1 : 1;
            $newNisn = $lastPendaftar ? $lastPendaftar->nisn + 1 : 1;

            // Salin data ke tb_pendaftar
            $data = [
                'no_induk' => $newNoInduk,
                'nm_lengkap' => $pendaftar->nm_lengkap,
                'tmp_lahir' => $pendaftar->tmp_lahir,
                'tgl_lahir' => $pendaftar->tgl_lahir,
                'gender' => $pendaftar->gender,
                'nisn' => $newNisn,
                'nik' => $pendaftar->nik,
                'agama' => $pendaftar->agama,
                'kewarganegaraan' => $pendaftar->kewarganegaraan,
                'pend_akhir' => $pendaftar->pendidikan,
                'email' => $pendaftar->email,
                'no_hp' => $pendaftar->no_hp,
                'status_pekerjaan' => 'siswa',
                'tgl_masuk' => now(),
                'password' => bcrypt($pendaftar->tgl_lahir),
                'alamat' => $pendaftar->alamat,
            ];

            // Simpan data ke tb_pendaftar jika belum ada
            Pendaftar::create($data);
        });

        return response()->json(['message' => 'Payment processed successfully'], 200);
    }




    // private function generateInvoice($pendaftar)
    // {
    //     // Pastikan direktori penyimpanan ada
    //     if (!file_exists(public_path('invoices'))) {
    //         mkdir(public_path('invoices'), 0777, true);
    //     }

    //     $data = [
    //         'nama' => $pendaftar->nm_lengkap, // Sesuaikan dengan nama kolom yang benar
    //         'order_id' => 'PPDB-' . $pendaftar->id,
    //         'amount' => $pendaftar->total, // Sesuaikan dengan kolom yang benar
    //         'date' => now()->format('d-m-Y'),
    //     ];

    //     // Pastikan file template ada di resources/views/invoices/invoice_template.blade.php
    //     $pdf = PDF::loadView('invoices.invoice_template', $data);
    //     $filePath = public_path('invoices/invoice-' . $pendaftar->id . '.pdf');
    //     $pdf->save($filePath);

    //     return asset('invoices/invoice-' . $pendaftar->id . '.pdf');
    // }
}
