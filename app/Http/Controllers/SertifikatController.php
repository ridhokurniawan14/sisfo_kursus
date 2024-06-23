<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Verification;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        // Generate QR code
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrcodePath = "qrcodes/{$merger_certificate}.svg";
        $qrcodeImage = $writer->writeString($merger_certificate);

        // Simpan QR code sebagai gambar
        Storage::disk('public')->put($qrcodePath, $qrcodeImage);

        // Generate PDF using Dompdf
        $dompdf = new Dompdf();
        $html = view('Dashboard.Pendaftaran.Offline.certificate_pdf', compact('merger_certificate', 'qrcodePath'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdfPath = "certificate_pdf/{$merger_certificate}.pdf";
        Storage::disk('public')->put($pdfPath, $dompdf->output());

        $hashedFileName = Hash::make($pdfPath);

        // Simpan ke database
        Sertifikat::create([
            'no_sertifikat' => $no_sertifikat,
            'kategori' => $kategori,
            'tgl_ujian' => $request->input('tgl_ujian'),
            'tgl_pembuatan' => $tgl_pembuatan,
            'no_induk' => $no_induk,
            'merger_certificate' => str_replace('-', '/', $merger_certificate), // Simpan ke DB dengan format asli
            'qrcode' => $qrcodePath,
            'file' => $pdfPath,
            'hash_file' => $hashedFileName,
        ]);

        return redirect()->back()->with('message', 'Sertifikat berhasil disimpan');
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

    /**
     * Display the specified resource.
     */
    public function show(Sertifikat $sertifikat)
    {
        abort(404);
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
        Log::info('Update request received for ID: ' . $id);

        $request->validate([
            'kategori' => 'required',
            'tgl_ujian' => 'required|date',
            'tgl_pembuatan' => 'required|date',
        ]);
        $kategori = $request->input('kategori');
        $tgl_pembuatan = $request->input('tgl_pembuatan');
        $no_induk = $request->input('no_induk');

        // Cari data sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);
        Log::info('Found sertifikat: ' . $sertifikat->id);

        // Hapus file lama setelah memastikan data valid
        Storage::disk('public')->delete($sertifikat->qrcode);
        Storage::disk('public')->delete($sertifikat->file);

        // Get student data
        $student = Verification::where('no_induk', $request->input('no_induk'))->first();
        if (!$student) {
            Log::error('Peserta didik tidak ditemukan: ' . $request->input('no_induk'));
            abort(404, 'Peserta didik tidak ditemukan');
        }
        $pil_prog = $student->pil_prog;
        $kd_paket = $student->kd_paket;

        // Convert month to Roman numeral
        $bulan = date('n', strtotime($tgl_pembuatan));
        $bulanRomawi = $this->convertToRoman($bulan);
        $tahun = date('Y', strtotime($tgl_pembuatan));

        Log::info('Found student: ' . $student->no_induk);

        // Convert month to Roman numeral
        $bulan = date('n', strtotime($request->input('tgl_pembuatan')));
        $bulanRomawi = $this->convertToRoman($bulan);
        $tahun = date('Y', strtotime($request->input('tgl_pembuatan')));

        // Determine merger_certificate format
        if ($request->input('kategori') == 'ut') {
            $merger_certificate = "{$sertifikat->no_sertifikat}-UT-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'paket') {
            $kd_paket_romawi = $this->convertToRoman($kd_paket);
            $merger_certificate = "{$sertifikat->no_sertifikat}-L$kd_paket_romawi-$bulanRomawi-$tahun";
        } elseif ($pil_prog == 'pilihan') {
            $merger_certificate = "{$sertifikat->no_sertifikat}-PP-$bulanRomawi-$tahun";
        } else {
            $merger_certificate = "{$sertifikat->no_sertifikat}-$bulanRomawi-$tahun";
        }

        // Generate QR code
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrcodePath = "qrcodes/{$merger_certificate}.svg";
        $qrcodeImage = $writer->writeString($merger_certificate);

        // Simpan QR code sebagai gambar
        Storage::disk('public')->put($qrcodePath, $qrcodeImage);

        // Generate PDF using Dompdf
        $dompdf = new Dompdf();
        $html = view('Dashboard.Pendaftaran.Offline.certificate_pdf', compact('merger_certificate', 'qrcodePath'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdfPath = "certificate_pdf/{$merger_certificate}.pdf";
        Storage::disk('public')->put($pdfPath, $dompdf->output());

        $hashedFileName = Hash::make($pdfPath);

        // Update data in database
        $sertifikat->update([
            'no_sertifikat' => $sertifikat->no_sertifikat,
            'kategori' => $request->input('kategori'),
            'tgl_ujian' => $request->input('tgl_ujian'),
            'tgl_pembuatan' => $request->input('tgl_pembuatan'),
            'no_induk' => $request->input('no_induk'),
            'merger_certificate' => str_replace('-', '/', $merger_certificate),
            'qrcode' => $qrcodePath,
            'file' => $pdfPath,
            'hash_file' => $hashedFileName,
        ]);

        Log::info('Sertifikat updated successfully for ID: ' . $id);

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
