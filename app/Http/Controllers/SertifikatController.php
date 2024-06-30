<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pendaftar;
use App\Models\Sertifikat;
use App\Models\Verification;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sertifikat' => 'required',
            'kategori' => 'required',
            'tgl_ujian' => 'required|date',
            'tgl_pembuatan' => 'required|date',
            'no_induk' => 'required',
        ]);

        $no_sertifikat = $request->input('no_sertifikat');
        $kategori = $request->input('kategori');
        $tgl_pembuatan = $request->input('tgl_pembuatan');
        $no_induk = $request->input('no_induk');

        // Get student data
        $student = Verification::where('no_induk', $no_induk)->first();
        if (!$student) {
            abort(404, 'Peserta didik tidak ditemukan');
        }
        $pil_prog = $student->pil_prog;
        $kd_paket = $student->kd_paket;

        // Convert month to Roman numeral
        $bulan = date('n', strtotime($tgl_pembuatan));
        $bulanRomawi = $this->convertToRoman($bulan);
        $tahun = date('Y', strtotime($tgl_pembuatan));

        // Determine merger_certificate format
        if ($kategori == 'ut') {
            $merger_certificate = "$no_sertifikat-UT-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'paket') {
            $kd_paket_romawi = $this->convertToRoman($kd_paket);
            $merger_certificate = "$no_sertifikat-L$kd_paket_romawi-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'pilihan') {
            $merger_certificate = "$no_sertifikat-PP-$bulanRomawi-$tahun";
        } else {
            $merger_certificate = "$no_sertifikat-$bulanRomawi-$tahun";
        }

        // Generate PDF path
        $pdfPath = "certificate_pdf/{$merger_certificate}.pdf";

        // Hash the certificate number for the URL
        $hashedCertificateNumber = hash('sha256', $merger_certificate);

        // Generate QR code with the URL to the validation page including the hashed certificate number
        $validationUrl = route('validate.certificate', $hashedCertificateNumber);

        $qrCode = QrCode::create($validationUrl)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(200)
            ->setMargin(10);

        $writer = new PngWriter();
        $qrCodePath = "qrcodes/{$merger_certificate}.png";
        $qrCodeResult = $writer->write($qrCode);
        $qrCodeImage = $qrCodeResult->getString();
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // Debug: Log Image found
        Log::info('Image found:', ['success' => $validationUrl]);

        // Save to database
        Sertifikat::create([
            'no_sertifikat' => $no_sertifikat,
            'kategori' => $kategori,
            'tgl_ujian' => $request->input('tgl_ujian'),
            'tgl_pembuatan' => $tgl_pembuatan,
            'no_induk' => $no_induk,
            'merger_certificate' => str_replace('-', '/', $merger_certificate), // Save in the original format to the DB
            'qrcode' => $qrCodePath,
            'hash_file' => $hashedCertificateNumber,
        ]);

        return redirect()->back()->with('message', 'Sertifikat berhasil disimpan');
    }

    public function validateCertificate($hash)
    {
        $data = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*', 's.*') // tambahkan 's.*' untuk mengambil semua kolom dari tb_sertifikat
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->leftJoin('tb_sertifikat as s', 'p.no_induk', '=', 's.no_induk') // left join dengan tb_sertifikat
            ->where('hash_file', $hash)
            ->first();

        if (!$data) {
            abort(404, 'Sertifikat tidak ditemukan atau tidak valid');
        }

        // Tampilkan halaman validasi sertifikat
        return view('certificate_validate', [
            "data" => $data
        ]);
    }


    private function convertToRoman($num)
    {
        $n = intval($num);
        $result = '';

        $lookup = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];

        foreach ($lookup as $roman => $value) {
            $matches = intval($n / $value);
            $result .= str_repeat($roman, $matches);
            $n = $n % $value;
        }

        return $result;
    }
    private function getPredikat($nilai)
    {
        if ($nilai >= 90 && $nilai <= 100) {
            return ['predikat' => 'A', 'bg' => 'bg-success'];
        } elseif ($nilai >= 85 && $nilai <= 89) {
            return ['predikat' => 'B+', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 80 && $nilai <= 84) {
            return ['predikat' => 'B', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 75 && $nilai <= 79) {
            return ['predikat' => 'B-', 'bg' => 'bg-primary'];
        } elseif ($nilai >= 70 && $nilai <= 74) {
            return ['predikat' => 'C+', 'bg' => 'bg-warning'];
        } elseif ($nilai >= 65 && $nilai <= 69) {
            return ['predikat' => 'C', 'bg' => 'bg-warning'];
        } elseif ($nilai >= 60 && $nilai <= 64) {
            return ['predikat' => 'C-', 'bg' => 'bg-warning'];
        } else {
            return ['predikat' => 'BELUM DINILAI', 'bg' => 'bg-secondary'];
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Pendaftar $pendaftar, $no_induk)
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*', 's.*') // tambahkan 's.*' untuk mengambil semua kolom dari tb_sertifikat
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->leftJoin('tb_sertifikat as s', 'p.no_induk', '=', 's.no_induk') // left join dengan tb_sertifikat
            ->where('p.no_induk', $no_induk)
            ->first();

        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        }

        $programs = [];
        $kd_programs = [];

        if ($student->pil_prog === 'paket') {
            if ($student->kd_paket) {
                $programPaket = DB::table('tb_paket_kursus as pk')
                    ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
                    ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
                    ->where('pk.kode', $student->kd_paket)
                    ->select('p.program', 'p.id')
                    ->get();

                foreach ($programPaket as $item) {
                    $programs[] = $item->program;
                    $kd_programs[] = $item->id;
                }
            }

            $kd_tambahan_fields = ['kd_tambahan', 'kd_tambahan2', 'kd_tambahan3', 'kd_tambahan4'];
            foreach ($kd_tambahan_fields as $field) {
                if ($student->$field) {
                    $programTambahan = DB::table('tb_pilihan')
                        ->where('id', $student->$field)
                        ->select('program', 'id')
                        ->first();

                    if ($programTambahan) {
                        $programs[] = $programTambahan->program;
                        $kd_programs[] = $programTambahan->id;
                    }
                }
            }
        } elseif ($student->pil_prog === 'pilihan') {
            for ($i = 1; $i <= 6; $i++) {
                $kd_pilihan_field = 'kd_pilihan' . $i;
                $kd_pilihan_value = $student->$kd_pilihan_field;

                if ($kd_pilihan_value) {
                    $program = DB::table('tb_pilihan')
                        ->where('id', $kd_pilihan_value)
                        ->select('program', 'id')
                        ->first();

                    if ($program) {
                        $programs[] = $program->program;
                        $kd_programs[] = $program->id;
                    }
                }
            }
        }

        // Menggabungkan $programs dan $kd_programs ke dalam array asosiasi dan mengurutkannya
        $combined = array_map(null, $kd_programs, $programs);
        usort($combined, function ($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Mengembalikan nilai $kd_programs dan $programs yang telah diurutkan
        $kd_programs = array_column($combined, 0);
        $programs = array_column($combined, 1);

        // Fetch existing scores
        $existing_scores = Nilai::where('no_induk', $no_induk)->get()->keyBy('kd_program');

        // Process the predikat for each existing score
        foreach ($existing_scores as $score) {
            $score->predikat = $this->getPredikat($score->nilai);
        }

        // Ambil data angsuran dan tanggal angsuran
        $installments = [];

        // Angsuran pertama menggunakan tgl_masuk
        if ($student->angsuran1) {
            $installments[] = [
                'angsuran' => $student->angsuran1,
                'tanggal' => $student->tgl_masuk,
                'keterangan' => $student->angsuran1 == $student->tot_biaya ? 'Pelunasan' : 'Angsuran 1',
            ];
        }

        // Angsuran berikutnya menggunakan tgl_angsuran2, tgl_angsuran3, tgl_angsuran4, tgl_angsuran5
        for ($i = 2; $i <= 5; $i++) {
            $installment_field = 'angsuran' . $i;
            $date_field = 'tgl_angsuran' . $i;
            if ($student->$installment_field && $student->$date_field) {
                $installments[] = [
                    'angsuran' => $student->$installment_field,
                    'tanggal' => $student->$date_field,
                    'keterangan' => 'Angsuran ' . $i,
                ];
            }
        }

        // Get sertifikat data
        $sertifikatData = DB::table('tb_sertifikat')->where('no_induk', $no_induk)->first();
        $isReadOnly = $sertifikatData ? true : false;

        return view('Dashboard.Pendaftaran.Offline.view_certificate_pdf', [
            "halaman" => "Sertifikat",
            "title" => "Peserta Didik",
            "tab_title" => "Sertifikat " . ucwords($student->nm_lengkap),
            "data" => $student,
            "no_induk" => $no_induk,
            "programs" => $programs,
            "kd_programs" => $kd_programs,
            "existing_scores" => $existing_scores,
            "installments" => $installments,
            "isReadOnly" => $isReadOnly,
            "sertifikatData" => $sertifikatData
        ]);
    }
    public function print($no_induk)
    {
        $student = Pendaftar::select('p.no_induk', 'p.*', 'pv.*', 'f.*', 'j.*', 's.*') // tambahkan 's.*' untuk mengambil semua kolom dari tb_sertifikat
            ->from('tb_pendaftar as p')
            ->join('tb_pendaftar_verifikasi as pv', 'p.no_induk', '=', 'pv.no_induk')
            ->leftJoin('tb_foto as f', 'p.no_induk', '=', 'f.no_induk')
            ->leftJoin('tb_jam as j', 'pv.kd_jam', '=', 'j.id')
            ->leftJoin('tb_sertifikat as s', 'p.no_induk', '=', 's.no_induk') // left join dengan tb_sertifikat
            ->where('p.no_induk', $no_induk)
            ->first();

        if (!$student) {
            abort(404); // Menampilkan halaman 404 jika data tidak ditemukan
        }

        $programs = [];
        $kd_programs = [];

        if ($student->pil_prog === 'paket') {
            if ($student->kd_paket) {
                $programPaket = DB::table('tb_paket_kursus as pk')
                    ->join('tb_paket_kursus_pilihan as pkp', 'pk.id', '=', 'pkp.paket_kursus_id')
                    ->join('tb_pilihan as p', 'pkp.pilihan_id', '=', 'p.id')
                    ->where('pk.kode', $student->kd_paket)
                    ->select('p.program', 'p.id')
                    ->get();

                foreach ($programPaket as $item) {
                    $programs[] = $item->program;
                    $kd_programs[] = $item->id;
                }
            }

            $kd_tambahan_fields = ['kd_tambahan', 'kd_tambahan2', 'kd_tambahan3', 'kd_tambahan4'];
            foreach ($kd_tambahan_fields as $field) {
                if ($student->$field) {
                    $programTambahan = DB::table('tb_pilihan')
                        ->where('id', $student->$field)
                        ->select('program', 'id')
                        ->first();

                    if ($programTambahan) {
                        $programs[] = $programTambahan->program;
                        $kd_programs[] = $programTambahan->id;
                    }
                }
            }
        } elseif ($student->pil_prog === 'pilihan') {
            for ($i = 1; $i <= 6; $i++) {
                $kd_pilihan_field = 'kd_pilihan' . $i;
                $kd_pilihan_value = $student->$kd_pilihan_field;

                if ($kd_pilihan_value) {
                    $program = DB::table('tb_pilihan')
                        ->where('id', $kd_pilihan_value)
                        ->select('program', 'id')
                        ->first();

                    if ($program) {
                        $programs[] = $program->program;
                        $kd_programs[] = $program->id;
                    }
                }
            }
        }

        // Menggabungkan $programs dan $kd_programs ke dalam array asosiasi dan mengurutkannya
        $combined = array_map(null, $kd_programs, $programs);
        usort($combined, function ($a, $b) {
            return $a[0] <=> $b[0];
        });

        // Mengembalikan nilai $kd_programs dan $programs yang telah diurutkan
        $kd_programs = array_column($combined, 0);
        $programs = array_column($combined, 1);

        // Fetch existing scores
        $existing_scores = Nilai::where('no_induk', $no_induk)->get()->keyBy('kd_program');

        // Process the predikat for each existing score
        foreach ($existing_scores as $score) {
            $score->predikat = $this->getPredikat($score->nilai);
        }

        // Ambil data angsuran dan tanggal angsuran
        $installments = [];

        // Angsuran pertama menggunakan tgl_masuk
        if ($student->angsuran1) {
            $installments[] = [
                'angsuran' => $student->angsuran1,
                'tanggal' => $student->tgl_masuk,
                'keterangan' => $student->angsuran1 == $student->tot_biaya ? 'Pelunasan' : 'Angsuran 1',
            ];
        }

        // Angsuran berikutnya menggunakan tgl_angsuran2, tgl_angsuran3, tgl_angsuran4, tgl_angsuran5
        for ($i = 2; $i <= 5; $i++) {
            $installment_field = 'angsuran' . $i;
            $date_field = 'tgl_angsuran' . $i;
            if ($student->$installment_field && $student->$date_field) {
                $installments[] = [
                    'angsuran' => $student->$installment_field,
                    'tanggal' => $student->$date_field,
                    'keterangan' => 'Angsuran ' . $i,
                ];
            }
        }

        // Get sertifikat data
        $sertifikatData = DB::table('tb_sertifikat')->where('no_induk', $no_induk)->first();
        $isReadOnly = $sertifikatData ? true : false;

        $data = [
            "halaman" => "Sertifikat",
            "title" => "Peserta Didik",
            "tab_title" => "Sertifikat " . ucwords($student->nm_lengkap),
            "data" => $student,
            "no_induk" => $no_induk,
            "programs" => $programs,
            "kd_programs" => $kd_programs,
            "existing_scores" => $existing_scores,
            "installments" => $installments,
            "isReadOnly" => $isReadOnly,
            "sertifikatData" => $sertifikatData
        ];

        // Menggunakan Dompdf untuk menghasilkan PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Pengaturan ukuran kertas dan margin
        $options->set('defaultPaperSize', 'A4');
        $options->set('defaultFont', 'Arial');
        $options->set('isPhpEnabled', true); // Mengizinkan PHP di dalam HTML

        // Margin atas, bawah, kiri, kanan
        $options->set('marginTop', '1.5cm');
        $options->set('marginBottom', '1.5cm');
        $options->set('marginLeft', '1.5cm');
        $options->set('marginRight', '1.5cm');

        $dompdf = new Dompdf($options);

        $html = view('Dashboard.Pendaftaran.Offline.view_certificate_pdf', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Mengatur kertas menjadi miring (landscape)
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('sertifikat.pdf', ['Attachment' => false]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sertifikat $sertifikat)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_sertifikat' => 'required',
            'kategori' => 'required',
            'tgl_ujian' => 'required|date',
            'tgl_pembuatan' => 'required|date',
            'no_induk' => 'required',
        ]);

        $no_sertifikat = $request->input('no_sertifikat');
        $kategori = $request->input('kategori');
        $tgl_pembuatan = $request->input('tgl_pembuatan');
        $no_induk = $request->input('no_induk');

        // Get student data
        $student = Verification::where('no_induk', $no_induk)->first();
        if (!$student) {
            abort(404, 'Peserta didik tidak ditemukan');
        }
        $pil_prog = $student->pil_prog;
        $kd_paket = $student->kd_paket;

        // Convert month to Roman numeral
        $bulan = date('n', strtotime($tgl_pembuatan));
        $bulanRomawi = $this->convertToRoman($bulan);
        $tahun = date('Y', strtotime($tgl_pembuatan));

        // Determine merger_certificate format
        if ($kategori == 'ut') {
            $merger_certificate = "$no_sertifikat-UT-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'paket') {
            $kd_paket_romawi = $this->convertToRoman($kd_paket);
            $merger_certificate = "$no_sertifikat-L$kd_paket_romawi-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'pilihan') {
            $merger_certificate = "$no_sertifikat-PP-$bulanRomawi-$tahun";
        } else {
            $merger_certificate = "$no_sertifikat-$bulanRomawi-$tahun";
        }

        // Generate PDF path
        $pdfPath = "certificate_pdf/{$merger_certificate}.pdf";

        // Hash the certificate number for the URL
        $hashedCertificateNumber = hash('sha256', $merger_certificate);

        // Generate QR code with the URL to the validation page including the hashed certificate number
        $validationUrl = route('validate.certificate', $hashedCertificateNumber);

        $qrCode = QrCode::create($validationUrl)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(200)
            ->setMargin(10);

        $writer = new PngWriter();
        $qrCodePath = "qrcodes/{$merger_certificate}.png";
        $qrCodeResult = $writer->write($qrCode);
        $qrCodeImage = $qrCodeResult->getString();
        Storage::disk('public')->put($qrCodePath, $qrCodeImage);

        // Debug: Log Image found
        Log::info('Image found:', ['success' => $validationUrl]);

        // Find the existing certificate
        $sertifikat = Sertifikat::find($id);
        if (!$sertifikat) {
            abort(404, 'Sertifikat tidak ditemukan');
        }

        // Delete the old QR code file
        Storage::disk('public')->delete($sertifikat->qrcode);

        // Update the database record
        $sertifikat->update([
            'no_sertifikat' => $no_sertifikat,
            'kategori' => $kategori,
            'tgl_ujian' => $request->input('tgl_ujian'),
            'tgl_pembuatan' => $tgl_pembuatan,
            'no_induk' => $no_induk,
            'merger_certificate' => str_replace('-', '/', $merger_certificate), // Save in the original format to the DB
            'qrcode' => $qrCodePath,
            'hash_file' => $hashedCertificateNumber,
        ]);

        return redirect()->back()->with('message', 'Sertifikat berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sertifikat $sertifikat)
    {
        abort(404);
    }
}
