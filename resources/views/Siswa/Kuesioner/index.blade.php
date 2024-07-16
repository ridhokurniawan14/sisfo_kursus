@extends('layouts.main_student')

@section('container')
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #0f9b0f 0%, blue 100%);
            color: white;
        }

        .border-animation {
            position: relative;
            z-index: 1;
        }

        .bg-gradient:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .border-animation::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            background: linear-gradient(45deg, #0f9b0f, blue, #0f9b0f, blue);
            background-size: 400% 400%;
            animation: borderMove 3s linear infinite;
            z-index: -1;
            /* border-radius: 10px; */
        }

        @keyframes borderMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kuesioner</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mt-2">
                                @if ($checkDataAngket && $checkDataAngket->jawab1 == null)
                                    <div class="col-sm-6 mb-2">
                                        <a href="#" data-toggle="modal" data-target="#kuesionerModal">
                                            <div class="position-relative p-3 bg-gradient border-animation"
                                                style="height: 180px">
                                                <div class="bg-white text-black p-2"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; text-align: center;">
                                                    <b>KUESIONER PESERTA DIDIK BARU</b>
                                                </div>
                                                <div style="margin-top: 10%">
                                                    Isi Kuesioner Peserta Didik Baru untuk membantu kami memahami kebutuhan
                                                    dan
                                                    profil Anda sehingga kami dapat memberikan layanan kursus yang lebih
                                                    sesuai
                                                    dan
                                                    bermanfaat
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Modal -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="kuesionerModal" tabindex="-1"
                                        aria-labelledby="kuesionerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="kuesionerModalLabel">Kuesioner Peserta Didik
                                                        Baru</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('kuesioner.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <!-- Form content here -->
                                                        <div class="form-group">
                                                            <label for="jawab1">Apa Keperluan Saudara kesini?</label>
                                                            <select class="form-control" id="jawab1" name="jawab1">
                                                                <option value="Mendaftar">Mendaftar</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab2">Darimana Saudara mengenal LKP
                                                                PTCC?</label>
                                                            <select class="form-control" id="jawab2" name="jawab2">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Teman">Teman</option>
                                                                <option value="Website">Website</option>
                                                                <option value="Google">Google</option>
                                                                <option value="Reklame">Reklame</option>
                                                                <option value="Brosur">Brosur</option>
                                                                <option value="Radio">Radio</option>
                                                                <option value="Sosmed">Sosmed</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab3">Saat ini Saudara berstatus apa?</label>
                                                            <select class="form-control" id="jawab3" name="jawab3">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Pelajar">Pelajar</option>
                                                                <option value="Karyawan">Karyawan</option>
                                                                <option value="Mahasiswa">Mahasiswa</option>
                                                                <option value="Fresh Graduate">Fresh Graduate</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab4">Rencana untuk keperluan apa Saudara
                                                                kursus?</label>
                                                            <select class="form-control" id="jawab4" name="jawab4">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Meningkatkan ilmu">Meningkatkan ilmu</option>
                                                                <option value="Agar tidak gaptek">Agar tidak gaptek</option>
                                                                <option value="Meningkatkan SDM">Meningkatkan SDM</option>
                                                                <option value="Modal kerja">Modal kerja</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab5">Siapa yang membiayai kursus?</label>
                                                            <select class="form-control" id="jawab5" name="jawab5">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Biaya sendiri">Biaya sendiri</option>
                                                                <option value="Orang tua">Orang tua</option>
                                                                <option value="Saudara">Saudara</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab6">Apa pekerjaan Orang Tua Anda?</label>
                                                            <select class="form-control" id="jawab6" name="jawab6">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Buruh">Buruh</option>
                                                                <option value="Wiraswasta">Wiraswasta</option>
                                                                <option value="Swasta">Swasta</option>
                                                                <option value="PNS">PNS</option>
                                                                <option value="ABRI/POLRI">ABRI/POLRI</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab7">Anda ingin masuk shief apa?</label>
                                                            <select class="form-control" id="jawab7" name="jawab7">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Pagi">Pagi</option>
                                                                <option value="Siang">Siang</option>
                                                                <option value="Malam">Malam</option>
                                                                <option value="Ketiga-tiganya">Ketiga-tiganya</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab8">Dalam 1 minggu ingin masuk berapa
                                                                kali?</label>
                                                            <select class="form-control" id="jawab8" name="jawab8">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="3 kali">3 kali</option>
                                                                <option value="4 kali">4 kali</option>
                                                                <option value="5 kali">5 kali</option>
                                                                <option value="Lebih dari 5 kali">Lebih dari 5 kali
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab9">Sejauh mana Saudara mengenal komputer
                                                                saat ini?</label>
                                                            <select class="form-control" id="jawab9" name="jawab9">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="Belum kenal">Belum kenal</option>
                                                                <option value="Mengenal sedikit">Mengenal sedikit</option>
                                                                <option value="Mengenal sedang">Mengenal sedang</option>
                                                                <option value="Mengenal banyak">Mengenal banyak</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab10">Jarak tempat tinggal Anda dengan LKP
                                                                PTCC?</label>
                                                            <select class="form-control" id="jawab10" name="jawab10">
                                                                <option value="" disabled selected>Silahkan Pilih
                                                                    Salah Satu</option>
                                                                <option value="< 1 km">
                                                                    < 1 km</option>
                                                                <option value="1-5 km">1-5 km</option>
                                                                <option value="6-10 km">6-10 km</option>
                                                                <option value="> 10 km">> 10 km</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jawab11">Apakah saudara sanggup mentaati tata
                                                                tertib LKP?</label>
                                                            <select class="form-control" id="jawab11" name="jawab11">
                                                                <option value="Sanggup">Sanggup</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-6 mb-2">
                                        <div class="position-relative p-3 bg-success" style="height: 180px">
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-white text-lg">
                                                    Filled
                                                </div>
                                            </div>
                                            <b>KUESIONER PESERTA DIDIK BARU</b><br>
                                            <i>Terima Kasih telah mengisi Kuesioner</i>
                                            </p>
                                            <h1><span class="fas fa-check float-right mt-5"></span></h1>
                                        </div>
                                    </div>
                                @endif
                                @if ($checkDataAngket->kategori != null && $checkDataAngket->saran == null)
                                    <div class="col-sm-6 mb-2">
                                        <a href="#" data-toggle="modal" data-target="#penilaianModal">
                                            <div class="position-relative p-3 bg-gradient border-animation"
                                                style="height: 180px">
                                                <div class="bg-white text-black p-2"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; text-align: center;">
                                                    <b>SURVEY KINERJA ADMINISTRASI & PENDIDIK</b>
                                                </div>
                                                <div style="margin-top: 7%">
                                                    Survei ini bertujuan untuk mengevaluasi kinerja administrasi dan
                                                    pendidik di lingkungan pendidikan kita. Melalui survei ini, kami
                                                    berupaya mengumpulkan umpan balik dari peserta didik terkait kualitas
                                                    layanan administrasi dan efektivitas metode pengajaran yang diberikan
                                                    oleh para pendidik.
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="penilaianModal" tabindex="-1" role="dialog"
                                        aria-labelledby="penilaianModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="penilaianModalLabel">Survey Penilaian</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('kuesioner.storePenilaian') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <!-- Tahap 1: Penilaian Staff Administrasi -->
                                                        <div id="step1">
                                                            <h5>Penilaian Staff Administrasi</h5>
                                                            @foreach (['Senyum, Salam dan Sapa', 'Cepat dan Tanggap dalam menerima Pelanggan', 'Keramahan dan Kesabaran melayani Pelanggan', 'Kejelasan dalam menjawab pertanyaan Pelanggan', 'Cepat dan Teliti dalam mengerjakan Pengetikan', 'Kerapian dalam Berpenampilan', 'Tertib Waktu dan Disiplin', 'Cepat dalam Pencatatan Pembukuan', 'Kepedulian terhadap Pelanggan dan Rekan Kerja', 'Kreativitas dan Rutinitas dalam Kebersihan Lingkungan', 'Cepat dalam Mengevaluasi kesediaan bahan-bahan ajar', 'Peningkatan dalam belajar Bidang Keterampilan'] as $index => $question)
                                                                <div class="form-group">
                                                                    <label>{{ $question }}</label>
                                                                    <select name="var{{ $index + 1 }}"
                                                                        class="form-control" required>
                                                                        <option value="" disabled selected>
                                                                            Beri Nilai</option>
                                                                        @foreach (range(1, 5) as $score)
                                                                            <option value="{{ $score }}">
                                                                                {{ $score }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-group">
                                                                <label>Saran / Kritik</label>
                                                                <textarea name="saran" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- Tahap 2: Penilaian Pendidik/Tutor -->
                                                        <div id="step2" style="display:none;">
                                                            <h5>Penilaian Pendidik/Tutor</h5>
                                                            @foreach (['Senyum, Salam dan Sapa', 'Keramahan dan Kesabaran melayani Peserta Didik', 'Kejelasan dalam menjawab pertanyaan Peserta Didik', 'Kecepatan dan Ketelitian dalam menjawab pertanyaan Peserta Didik', 'Kecepatan dalam pencatatan Penilaian', 'Kerapian dalam Berpenampilan', 'Tertib Waktu dan Disiplin', 'Kreatif dalam memberikan pengajaran', 'Kepedulian terhadap Peserta Didik', 'Kepedulian terhadap teman sejawat', 'Rutinitas dalam Kebersihan lingkungan lembaga', 'Kecepatan dalam mengevaluasi Peserta Didik', 'Peningkatan dalam belajar Bidang Keterampilan'] as $index => $question)
                                                                <div class="form-group">
                                                                    <label>{{ $question }}</label>
                                                                    <select name="var{{ $index + 1 }}_tutor"
                                                                        class="form-control" required>
                                                                        <option value="" disabled selected>
                                                                            Beri Nilai</option>
                                                                        @foreach (range(1, 5) as $score)
                                                                            <option value="{{ $score }}">
                                                                                {{ $score }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endforeach
                                                            <div class="form-group">
                                                                <label>Saran / Kritik</label>
                                                                <textarea name="saran_tutor" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="button" class="btn btn-primary" id="backStep"
                                                            style="display:none;">Kembali</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="nextStep">Selanjutnya</button>
                                                        <button type="submit" class="btn btn-success" id="submitSurvey"
                                                            style="display:none;">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($checkDataAngket->kategori != null && $checkDataAngket->saran != null)
                                    <div class="col-sm-6 mb-2">
                                        <div class="position-relative p-3 bg-success" style="height: 180px">
                                            <div class="ribbon-wrapper ribbon-lg">
                                                <div class="ribbon bg-white text-lg">
                                                    Filled
                                                </div>
                                            </div>
                                            <b>SURVEY PENILAIAN ADMINISTRASI & PENDIDIK</b><br>
                                            <i>Terima Kasih telah mengisi Survey</i>
                                            </p>
                                            <h1><span class="fas fa-check float-right mt-5"></span></h1>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-6 mb-2">
                                        <div class="position-relative p-3 bg-gray " style="height: 180px">
                                            <b>Penilaian Kinerja Administrasi dan Pendidik</b> <br />
                                            Survey ini bertujuan untuk mengetahui nilai dari kinerja Kami, dan untuk
                                            perbaikan
                                            pelayanan Kami kedepan.<br>
                                            <div class="badge badge-warning mt-5 float-left font-italic display-5">
                                                Selesaikan Kursus untuk Mengisi
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <script>
        document.getElementById('nextStep').addEventListener('click', function() {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
            document.getElementById('nextStep').style.display = 'none';
            document.getElementById('backStep').style.display = 'inline-block';
            document.getElementById('submitSurvey').style.display = 'inline-block';
        });

        document.getElementById('backStep').addEventListener('click', function() {
            document.getElementById('step1').style.display = 'block';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('nextStep').style.display = 'inline-block';
            document.getElementById('backStep').style.display = 'none';
            document.getElementById('submitSurvey').style.display = 'none';
        });
    </script>
@endsection
