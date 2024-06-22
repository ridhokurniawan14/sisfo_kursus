@extends('layouts.main')

@section('container')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <style>
        .profile-photo-hover-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
            display: none;
        }

        .profile-photo-container:hover .profile-photo-hover-text {
            display: block;
        }

        .profile-photo-hover-text-not-null {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
            display: none;
        }

        .profile-photo-container:hover .profile-photo-hover-text-not-null {
            display: block;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            /* Menghilangkan border-radius untuk membuatnya kotak */
            padding: 2px;
            /* Menambahkan padding 2px di sekitar gambar */
        }

        .profile-photo-container {
            position: relative;
            display: inline-block;
        }

        .profile-user-img {
            cursor: pointer;
        }

        /* Profile CSS */
        .profile-container {
            display: flex;
            align-items: flex-start;
        }

        .profile-image {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border: 3px solid gainsboro;
            /* Mengatur border biru dengan ketebalan 3px */
            border-radius: 3%;
            /* Menghilangkan border-radius untuk membuatnya kotak */
            padding: 2px;
            /* Menambahkan padding 2px di sekitar gambar */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Menambahkan bayangan */
            margin-right: 20px;
        }

        .profile-image-null {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .profile-row {
            display: flex;
            margin-bottom: 10px;
        }

        .profile-label {
            flex: 1;
            font-weight: bold;
        }

        .profile-data {
            flex: 2;
            text-align: left;
        }

        /* Address CSS */
        .address-details {
            display: flex;
            flex-direction: column;
        }

        .address-row {
            display: flex;
            margin-bottom: 10px;
        }

        .address-label {
            flex: 1;
            font-weight: bold;
        }

        .address-data {
            flex: 2;
            text-align: left;
        }

        .address-row h5 {
            margin-left: 10px;
            /* Menambahkan margin kiri */
        }

        .address-row .badge {
            margin-left: 10px;
            /* Menambahkan margin kiri pada elemen badge */
        }

        /* Family CSS */
        .family-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .family-column {
            display: flex;
            flex-direction: column;
        }

        .family-row {
            display: flex;
            margin-bottom: 10px;
        }

        .family-label {
            flex: 1;
            font-weight: bold;
        }

        .family-data {
            flex: 2;
            text-align: left;
        }

        /* Guardian CSS */
        .guardian-details {
            display: flex;
            flex-direction: column;
        }

        .guardian-row {
            display: flex;
            margin-bottom: 10px;
        }

        .guardian-label {
            flex: 1;
            font-weight: bold;
        }

        .guardian-data {
            flex: 2;
            text-align: left;
        }

        .highlight-green {
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .highlight-red {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .table-bordered th {
            text-align: center;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 3px;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        .address-row h5 {
            margin-left: 0;
            /* Menghilangkan margin kiri default */
        }

        .address-row h5 .badge {
            margin-left: 0;
            /* Menghilangkan margin kiri pada elemen badge di dalam h5 */
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <!-- Profile Picture Icon with Dropdown -->
                            <div class="text-center">
                                <div class="profile-photo-container dropdown">
                                    @if ($data->judul_foto)
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('storage/' . $data->foto) }}"
                                                class="profile-user-img img-fluid img-circle" alt="Personalia Image">
                                            <div class="profile-photo-hover-text-not-null"></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#viewPhotoModal"
                                                data-image-url="{{ asset('storage/' . $data->foto) }}">View Photo</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#uploadPhotoModal">Upload Photo</a>
                                            <form action="{{ route('photostudent.destroy', $data->no_induk) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Remove Photo</button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="#" data-toggle="modal" aria-haspopup="true"
                                            data-target="#uploadPhotoModal" aria-expanded="false">
                                            <img src="/img/student.png" class="profile-user-img img-fluid img-circle"
                                                alt="Personalia Image">
                                            <div class="profile-photo-hover-text">Upload Foto</div>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Modal untuk Upload Foto -->
                            <div class="modal fade" id="uploadPhotoModal" tabindex="-1" role="dialog"
                                aria-labelledby="uploadPhotoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadPhotoModalLabel">Crop & Upload Photo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="file" id="uploadPhotoInput" accept="image/*">
                                                    </br>
                                                    <div id="cropContainer" style="display:none;">
                                                        <img id="photoToCrop" style="max-width: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="previewContainer" style="display:none;">
                                                        <h5>Hasil Crop:</h5>
                                                        <img id="croppedPreview" style="max-width: 100%;">
                                                        <!-- Elemen pratinjau hasil crop -->
                                                    </div>
                                                    <input type="hidden" id="noIndukInput" value="{{ $no_induk }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="button" class="btn btn-primary" id="cropButton"
                                                style="display:none;">Crop</button>
                                            <button type="button" class="btn btn-success" id="uploadButton"
                                                style="display:none;">Upload</button> <!-- Tombol upload baru -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal untuk Melihat Foto -->
                            <div class="modal fade" id="viewPhotoModal" tabindex="-1" role="dialog"
                                aria-labelledby="viewPhotoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewPhotoModalLabel">View Photo</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img id="viewPhoto" src="{{ asset('storage/' . $data->foto) }}"
                                                class="img-fluid" alt="Personalia Image">
                                            <!-- Tempatkan elemen gambar untuk tampilan foto -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="profile-username text-center">{{ ucwords($data->nm_lengkap) }}</h3>

                            <p class="text-muted text-center">Student</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>NIS / Username</b> <a class="float-right">{{ $no_induk }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl. Lahir</b> <a
                                        class="float-right">{{ \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM YYYY') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tempat Lahir</b> <a class="float-right">{{ ucwords($data->tmp_lahir) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No. HP</b> <a class="float-right">
                                        @if (!empty($data->no_hp))
                                            {{ $data->no_hp }}
                                        @else
                                            <span class="right badge badge-warning">MOHON DIISI‼️</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl. Daftar</b> <a
                                        class="float-right">{{ \Carbon\Carbon::parse($data->tgl_masuk)->isoFormat('D MMMM YYYY') }}</a>
                                </li>
                            </ul>
                            @if (!empty($data->no_hp))
                                <a target="_blank" href="https://wa.me/+62{{ $data->no_hp }}"
                                    class="btn btn-success btn-block no-print">
                                    <i class="fab fa-whatsapp mr-1"></i> <b>Whatsapp</b>
                                </a>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pendidikan & Alamat </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>

                            <p class="text-muted">
                                Pendidikan Terakhir {{ strtoupper($data->pend_akhir) }}
                                {{ !empty($data->jurusan) ? 'dibidang' . ucwords($data->jurusan) : '' }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Rumah</strong>

                            <p class="text-muted">{{ ucwords($data->alamat) }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="card card-primary card-tabs">
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                        <li class="nav-item no-print">
                                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                                href="#custom-tabs-one-home" role="tab"
                                                aria-controls="custom-tabs-one-home" aria-selected="true">Biodata</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-one-profile" role="tab"
                                                aria-controls="custom-tabs-one-profile" aria-selected="false">Laporan
                                                Keuangan</a>
                                        </li>
                                        <li class="nav-item no-print">
                                            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                                href="#custom-tabs-one-messages" role="tab"
                                                aria-controls="custom-tabs-one-messages" aria-selected="false">Nilai</a>
                                        </li>
                                        <li class="nav-item no-print">
                                            <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                                href="#custom-tabs-one-settings" role="tab"
                                                aria-controls="custom-tabs-one-settings"
                                                aria-selected="false">Sertifikat</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-one-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-home-tab">
                                            <div class="col-12 p-0" id="accordion">
                                                <div class="card card-info card-outline">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                        <div class="card-header">
                                                            <h4 class="card-title w-100">
                                                                Data Diri
                                                            </h4>
                                                        </div>
                                                    </a>
                                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="profile-container">
                                                                @if ($data->judul_foto)
                                                                    <img src="{{ asset('storage/' . $data->foto) }}"
                                                                        class="profile-image" alt="Foto Profil">
                                                                @else
                                                                    <img src="/img/student.png" alt="Foto Profil"
                                                                        class="profile-image-null">
                                                                @endif
                                                                <div class="profile-details">
                                                                    <div class="profile-row">
                                                                        <span class="profile-label">NISN</span>
                                                                        <span
                                                                            class="profile-data">{{ !empty($data->nisn) ? $data->nisn : '-' }}</span>
                                                                    </div>
                                                                    <div class="profile-row">
                                                                        <span class="profile-label">NIK</span>
                                                                        <span
                                                                            class="profile-data">{{ !empty($data->nik) ? $data->nik : '-' }}</span>
                                                                    </div>
                                                                    <div class="profile-row">
                                                                        <span class="profile-label">Kewarganegaraan</span>
                                                                        <span
                                                                            class="profile-data">{{ $data->kewarganegaraan = 'wni' || 'WNI' ? 'Warga Negara Indonesia (WNI)' : 'Warga Negara Asing (WNA)' }}</span>
                                                                    </div>
                                                                    <div class="profile-row">
                                                                        <span class="profile-label">Email</span>
                                                                        <span
                                                                            class="profile-data">{{ !empty($data->email) ? $data->email : '-' }}</span>
                                                                    </div>
                                                                    <div class="profile-row">
                                                                        <span class="profile-label">Pekerjaan</span>
                                                                        <span
                                                                            class="profile-data">{{ !empty($data->status_pekerjaan) ? ucwords($data->status_pekerjaan) : '-' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-info card-outline">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                        <div class="card-header">
                                                            <h4 class="card-title w-100">
                                                                Alamat
                                                            </h4>
                                                        </div>
                                                    </a>
                                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="address-details">
                                                                <div class="address-row">
                                                                    <span class="address-label">Alamat Lengkap</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->alamat) ? ucwords($data->alamat) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">RT</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->rt) ? $data->rt : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">RW</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->rw) ? $data->rw : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Desa / Kel.</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->kel) ? ucwords($data->kel) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Kecamatan</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->kec) ? ucwords($data->kec) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Kode Pos</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->kd_pos) ? $data->kd_pos : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Kab. / Kota</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->kab) ? ucwords($data->kab) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Provinsi</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->provinsi) ? ucwords($data->provinsi) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Jenis Tinggal</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->jns_tinggal) ? ucwords($data->jns_tinggal) : '-' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-info card-outline">
                                                    <a class="d-block w-100" data-toggle="collapse"
                                                        href="#collapseThree">
                                                        <div class="card-header">
                                                            <h4 class="card-title w-100">
                                                                Keluarga
                                                            </h4>
                                                        </div>
                                                    </a>
                                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="family-details">
                                                                <div class="family-column">
                                                                    <h5>Bio Ayah</h5>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Nama Ayah</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->nm_ayah) ? ucwords($data->nm_ayah) : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">NIK Ayah</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->nik_ayah) ? $data->nik_ayah : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Tgl. Lahir Ayah</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->tgl_ayah) ? \Carbon\Carbon::parse($data->tgl_ayah)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Pend. Ayah</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->pend_ayah) ? strtoupper($data->pend_ayah) : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Pekerjaan Ayah</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->pek_ayah) ? ucwords($data->pek_ayah) : '-' }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="family-column">
                                                                    <h5>Bio Ibu</h5>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Nama Ibu</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->nm_ibu) ? ucwords($data->nm_ibu) : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">NIK Ibu</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->nik_ibu) ? $data->nik_ibu : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Tgl. Lahir Ibu</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->tgl_ibu) ? \Carbon\Carbon::parse($data->tgl_ibu)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Pend. Ibu</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->pend_ibu) ? strtoupper($data->pend_ibu) : '-' }}</span>
                                                                    </div>
                                                                    <div class="family-row">
                                                                        <span class="family-label">Pekerjaan Ibu</span>
                                                                        <span
                                                                            class="family-data">{{ !empty($data->pek_ibu) ? ucwords($data->pek_ibu) : '-' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="address-details">
                                                                <div class="address-row">
                                                                    <span class="address-label">Alamat Lengkap Orang
                                                                        Tua</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->alamat_ortu) ? ucwords($data->alamat_ortu) : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">No. HP Orang Tua</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->hp_ortu) ? $data->hp_ortu : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">No. Telp. Rumah</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->telepon_ortu) ? $data->telepon_ortu : '-' }}</span>
                                                                </div>
                                                                <div class="address-row">
                                                                    <span class="address-label">Anak ke</span>
                                                                    <span
                                                                        class="address-data">{{ !empty($data->anak_ke) ? $data->anak_ke : '-' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-warning card-outline">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                                        <div class="card-header">
                                                            <h4 class="card-title w-100">
                                                                Wali
                                                            </h4>
                                                        </div>
                                                    </a>
                                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div class="guardian-details">
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">Nama Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->nm_wali) ? ucwords($data->nm_wali) : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">NIK Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->nik_wali) ? $data->nik_wali : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">Tgl. Lahir Wali</span>
                                                                    <span
                                                                        class="family-data">{{ !empty($data->tgl_wali) ? \Carbon\Carbon::parse($data->tgl_wali)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">Pend. Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->pend_wali) ? strtoupper($data->pend_wali) : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">Pekerjaan Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->pek_wali) ? ucwords($data->pek_wali) : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">Alamat Lengkap Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->alamat_wali) ? ucwords($data->alamat_wali) : '-' }}</span>
                                                                </div>
                                                                <div class="guardian-row">
                                                                    <span class="guardian-label">No. HP Wali</span>
                                                                    <span
                                                                        class="guardian-data">{{ !empty($data->hp_wali) ? ucwords($data->hp_wali) : '-' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="/pendaftaran/{{ $no_induk }}/edit"
                                                    class="btn btn-warning float-right"><i class="bi bi-pencil-fill"></i>
                                                    Edit Data</a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-profile-tab">
                                            {{-- <div id="print-section"> --}}
                                            <!-- title row -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>
                                                        <i class="fas fa-receipt"></i> Detail Pembayaran
                                                        <small
                                                            class="float-right">{{ ucwords($data->nm_lengkap) }}</small>
                                                    </h4>
                                                    <hr>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- info row -->
                                            <div class="row invoice-info">
                                                <!-- Sisi Kiri -->
                                                <div class="col-sm-6 invoice-col">
                                                    <div class="address-row">
                                                        <span class="address-label">Biaya Kursus</span>
                                                        <span class="address-data">Rp.
                                                            {{ number_format($data->biaya_kursus, 0, ',', '.') }},-</span>
                                                    </div>
                                                    <div class="address-row">
                                                        <span class="address-label">Pendaftaran</span>
                                                        <span class="address-data">Rp.
                                                            {{ number_format($data->biaya_daftar, 0, ',', '.') }},-</span>
                                                    </div>
                                                    <div class="address-row">
                                                        <span class="address-label">Discount</span>
                                                        <span class="address-data">Rp.
                                                            {{ number_format($data->discount, 0, ',', '.') }},-</span>
                                                    </div>
                                                    <div class="address-row">
                                                        <span class="address-label">Total Biaya Kursus</span>
                                                        <span class="address-data">Rp.
                                                            {{ number_format($data->tot_biaya, 0, ',', '.') }},-</span>
                                                    </div>
                                                    <div class="address-row">
                                                        <span class="address-label">Kekurangan</span>
                                                        <span
                                                            class="address-data {{ $data->ket == 'Lunas' || strtolower($data->ket) == 'lunas' ? 'highlight-green' : 'highlight-red' }}">Rp.
                                                            {{ number_format($data->kekurangan, 0, ',', '.') }},-</span>
                                                    </div>
                                                </div>
                                                <!-- /.col -->

                                                <!-- Sisi Kanan -->
                                                <div class="col-sm-6 invoice-col">
                                                    <div class="address-row">
                                                        <span class="address-label">Jam Kursus</span>
                                                        <span class="address-data">{{ $data->jam }}</span>
                                                    </div>
                                                    <div class="address-row">
                                                        <span class="address-label">Program Kursus</span>
                                                        <span class="address-data">
                                                            {{ $data->pil_prog == 'paket' || $data->pil_prog == 'Paket'
                                                                ? ($data->kd_paket != 0
                                                                    ? ($data->kd_tambahan != 0
                                                                        ? 'Paket ' . $data->kd_paket . ' + Program Tambahan'
                                                                        : 'Paket ' . $data->kd_paket)
                                                                    : 'Pilihan')
                                                                : 'Pilihan' }}
                                                        </span>
                                                    </div>
                                                    <div class="address-row">
                                                        <div class="address-data">
                                                            <table class="table table-bordered custom-table-style">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Program Kursus</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($programs as $index => $program)
                                                                        <tr>
                                                                            <td style="text-align: center">
                                                                                {{ $index + 1 }}</td>
                                                                            <td>{{ ucwords($program) }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>

                                            <!-- /.row -->
                                            <!-- Table row -->
                                            <div class="row">
                                                <div class="col-12 table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr style="text-align: center">
                                                                <th>#</th>
                                                                <th>Keterangan</th>
                                                                <th>Tanggal</th>
                                                                <th>Bayar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($installments as $index => $installment)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $installment['keterangan'] }}</td>
                                                                    <td style="text-align: center">
                                                                        {{ \Carbon\Carbon::parse($installment['tanggal'])->isoFormat('D MMMM YYYY') }}
                                                                    </td>
                                                                    <td>Rp.
                                                                        {{ number_format($installment['angsuran'], 0, ',', '.') }},-
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="row">
                                                <!-- accepted payments column -->
                                                <div class="col-6">
                                                    <p class="lead mb-0">Metode Pembayaran</p>
                                                    <img src="/img/bri-card.webp" width="15%" alt="BRI">
                                                    <img src="/img/ovo-card.webp" width="15%" alt="OVO">
                                                    <img src="/img/dana-card.webp" width="15%" alt="DANA">
                                                    <p class="text-muted well well-sm shadow-none mb-0"
                                                        style="margin-top: 10px;">
                                                        Cash atau Transfer Rekening :
                                                    <ol style="margin-left: 0; padding-left: 1.2em;">
                                                        @foreach ($rekenings as $rekening)
                                                            <li>{{ '(' . strtoupper($rekening->nm_bank) . ') ' . ucwords($rekening->nm_rekening) . ' : ' . formatNoRek($rekening->no_rek) }}
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                    </p>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-6">
                                                    <p class="lead">Jumlah yang harus dibayar</p>

                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">Total Biaya Kursus</th>
                                                                <td>Rp.
                                                                    {{ number_format($data->tot_biaya, 0, ',', '.') }},-
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sudah Dibayarkan</th>
                                                                <td>Rp.
                                                                    {{ number_format($data->tot_biaya - $data->kekurangan, 0, ',', '.') }},-
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Kekurangan</th>
                                                                <td>Rp.
                                                                    {{ number_format($data->kekurangan, 0, ',', '.') }},-
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Keterangan</th>
                                                                <td>
                                                                    <h4><span
                                                                            class="right badge badge-{{ $data->ket == 'Lunas' || strtolower($data->ket) == 'lunas' ? 'success' : 'danger' }}">
                                                                            {{ strtoupper($data->ket) }} </span></h4>
                                                                </td>

                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                                <div class="col-12">
                                                    <a href="javascript:window.print();" rel="noopener"
                                                        class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                                    <a href="/pendaftaran/verifikasi/{{ $no_induk }}/edit"
                                                        class="btn btn-warning float-right"><i class="bi bi-cash"></i>
                                                        Pembayaran</a>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-messages-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4>
                                                        <i class="fas fa-check-circle"></i> Nilai Program Kursus
                                                        <small
                                                            class="float-right">{{ ucwords($data->nm_lengkap) }}</small>
                                                    </h4>
                                                    <p>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <form action="{{ route('save-nilai', $no_induk) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="no_induk" value="{{ $no_induk }}">
                                                <table class="table">
                                                    <thead>
                                                        <tr style="text-align: center">
                                                            <th style="width: 10px">#</th>
                                                            <th>Program Kursus</th>
                                                            <th style="width: 10%">Nilai</th>
                                                            <th style="width: 50%">Kemampuan</th>
                                                            <th>Predikat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($programs as $index => $program)
                                                            @php
                                                                $kd_program = $kd_programs[$index];
                                                                $existing_score = $existing_scores->get($kd_program);
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ucwords($program) }}</td>
                                                                <td style="text-align: center">
                                                                    @if ($existing_score)
                                                                        {{ $existing_score->nilai }}
                                                                    @else
                                                                        <input class="form-control" name="nilai[]"
                                                                            value="{{ old('nilai.' . $index) }}">
                                                                    @endif
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <div
                                                                        class="progress progress-sm progress-striped active">
                                                                        <div class="progress-bar {{ $existing_score ? $existing_score->predikat['bg'] : '' }}"
                                                                            style="width: {{ $existing_score ? $existing_score->nilai . '%' : '0%' }}">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="text-align: center">
                                                                    <span
                                                                        class="badge {{ $existing_score ? $existing_score->predikat['bg'] : '' }}">
                                                                        {{ $existing_score ? $existing_score->predikat['predikat'] : 'BELUM DINILAI' }}
                                                                    </span>
                                                                </td>
                                                                <input type="hidden" name="programs[]"
                                                                    value="{{ $program }}">
                                                                <input type="hidden" name="kd_programs[]"
                                                                    value="{{ $kd_program }}">
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @if ($existing_scores->isEmpty())
                                                    <button type="submit" class="btn btn-success float-right"><i
                                                            class="fas fa-check"></i> Simpan Nilai</button>
                                                @else
                                                    <button type="button" class="btn btn-warning float-right"
                                                        data-bs-toggle="modal" data-bs-target="#editAllNilaiModal">
                                                        <i class="bi bi-pencil-fill"></i> Edit Nilai
                                                    </button>
                                                @endif
                                            </form>


                                            <!-- Modal Structure -->
                                            <div class="modal fade" id="editAllNilaiModal" tabindex="-1"
                                                aria-labelledby="editAllNilaiModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('nilai.updateAll') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="no_induk"
                                                                value="{{ $no_induk }}">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editAllNilaiModalLabel">Edit
                                                                    Nilai</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            {{-- <div class="modal-body"> --}}
                                                            <table class="table">
                                                                <thead>
                                                                    <tr style="text-align: center">
                                                                        <th style="width: 10px">#</th>
                                                                        <th>Program Kursus</th>
                                                                        <th style="width: 40%">Nilai</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($programs as $index => $program)
                                                                        @php
                                                                            $kd_program = $kd_programs[$index];
                                                                            $existing_score = $existing_scores->get(
                                                                                $kd_program,
                                                                            );
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{ $loop->iteration }}</td>
                                                                            <td>{{ ucwords($program) }}</td>
                                                                            <td>
                                                                                <input class="form-control" name="nilai[]"
                                                                                    value="{{ $existing_score ? $existing_score->nilai : old('nilai.' . $index) }}">
                                                                            </td>
                                                                            <input type="hidden" name="programs[]"
                                                                                value="{{ $program }}">
                                                                            <input type="hidden" name="kd_programs[]"
                                                                                value="{{ $kd_program }}">
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                            aria-labelledby="custom-tabs-one-settings-tab">
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Bagian kiri untuk data -->
                                                    <div class="col-md-8">
                                                        <h4><i class="fas fa-certificate"></i> Data Sertifikat</h4>
                                                        <form>
                                                            <div class="form-group">
                                                                <label for="no_sertifikat">No. Sertifikat <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="no_sertifikat"
                                                                    placeholder="Masukkan No. Sertifikat">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori_sertifikat">Kategori Sertifikat
                                                                    <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="kategori_sertifikat">
                                                                    <option value="">Pilih Kategori Sertifikat
                                                                    </option>
                                                                    <option value="umum">Umum</option>
                                                                    <option value="ut">Ujian Terbuka</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_ujian">Tanggal Ujian Akhir <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_ujian">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_sertifikat">Tanggal Sertifikat
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal_sertifikat">
                                                            </div>
                                                            <button type="submit" class="btn btn-success float-right"><i
                                                                    class="fas fa-check"></i> Simpan Data</button>
                                                        </form>
                                                    </div>
                                                    <!-- /.col-md-8 -->

                                                    <!-- Bagian kanan untuk tampilan sertifikat -->
                                                    <div class="col-md-4">
                                                        <h4>Tampilan Sertifikat</h4>
                                                        <iframe id="pdfViewer"
                                                            src="{{ asset('storage/sertifikat/example-certifikate.pdf') }}"
                                                            width="100%" height="200px"></iframe>
                                                        <div class="mt-2">
                                                            <button onclick="downloadPDF()" class="btn btn-primary">
                                                                <i class="fas fa-download"></i> Download
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.col-md-4 -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var cropper;
            var uploadPhotoInput = document.getElementById('uploadPhotoInput');
            var cropContainer = document.getElementById('cropContainer');
            var photoToCrop = document.getElementById('photoToCrop');
            var cropButton = document.getElementById('cropButton');
            var uploadButton = document.getElementById('uploadButton'); // Tombol upload baru
            var croppedPreview = document.getElementById('croppedPreview'); // Elemen img untuk pratinjau
            var previewContainer = document.getElementById('previewContainer'); // Kontainer untuk pratinjau
            var croppedBlob; // Variabel untuk menyimpan hasil crop
            // Ambil elemen View Photo dan modal
            var viewPhotoModal = document.getElementById('viewPhotoModal');
            var viewPhoto = document.getElementById('viewPhoto');

            uploadPhotoInput.addEventListener('change', function(e) {
                var files = e.target.files;
                if (files && files.length > 0) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        photoToCrop.src = event.target.result;
                        cropContainer.style.display = 'block';
                        cropButton.style.display = 'inline-block';
                        uploadButton.style.display = 'none'; // Sembunyikan tombol upload pada awalnya
                        croppedPreview.style.display =
                            'none'; // Sembunyikan pratinjau hasil crop pada awalnya
                        previewContainer.style.display =
                            'none'; // Sembunyikan kontainer pratinjau pada awalnya

                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(photoToCrop, {
                            aspectRatio: 1, // Sesuaikan aspek rasio sesuai kebutuhan
                            viewMode: 1
                        });
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

            cropButton.addEventListener('click', function() {
                var canvas = cropper.getCroppedCanvas();
                canvas.toBlob(function(blob) {
                    croppedBlob = blob; // Simpan hasil crop di variabel

                    // Buat URL objek dari blob untuk pratinjau
                    var croppedUrl = URL.createObjectURL(blob);
                    croppedPreview.src = croppedUrl; // Setel sumber pratinjau dengan URL objek
                    croppedPreview.style.display = 'block'; // Tampilkan elemen pratinjau
                    previewContainer.style.display = 'block'; // Tampilkan kontainer pratinjau

                    uploadButton.style.display =
                        'inline-block'; // Tampilkan tombol upload setelah crop
                }, 'image/jpeg'); // Tentukan format gambar yang dihasilkan
            });

            uploadButton.addEventListener('click', function() {
                if (!croppedBlob) {
                    toastr.error('Silakan crop gambar terlebih dahulu.');
                    return;
                }

                var formData = new FormData();
                formData.append('foto', croppedBlob, 'foto.jpg'); // Tambahkan nama file default
                formData.append('no_induk', noIndukInput.value); // Tambahkan no_induk ke FormData

                // Dapatkan token CSRF dari meta tag
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Tentukan URL berdasarkan kondisi apakah foto sudah ada atau tidak
                var url = '{{ route('photostudent.store') }}';
                var method = 'POST';

                @if ($data->judul_foto)
                    url = '{{ route('photostudent.update', $data->no_induk) }}';
                    method = 'POST';
                    formData.append('_method', 'PUT'); // Tambahkan metode PUT untuk update
                @endif

                // Kirim permintaan AJAX ke server untuk meng-upload foto
                $.ajax({
                    url: url,
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': token // Sertakan token CSRF dalam permintaan
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success('Foto berhasil diupload.', '', {
                            timeOut: 3000
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 3000); // Tunggu 3 detik sebelum memuat ulang halaman
                    },
                    error: function(response) {
                        // Tambahkan logika error
                        toastr.error('Gagal mengupload foto.');
                    }
                });
            });

            // Event listener untuk saat modal View Photo ditampilkan
            $('#viewPhotoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang mengaktifkan modal
                var imageUrl = button.data('image-url'); // Ambil URL gambar dari atribut data

                viewPhoto.src = imageUrl; // Setel sumber gambar pada modal
            });
            var editAllNilaiModal = document.getElementById('editAllNilaiModal');
            if (editAllNilaiModal) {
                editAllNilaiModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var kdProgram = button.getAttribute('data-kd-program');
                    var program = button.getAttribute('data-program');
                    var nilai = button.getAttribute('data-nilai');

                    var modalTitle = editAllNilaiModal.querySelector('.modal-title');
                    var modalBodyInputKdProgram = editAllNilaiModal.querySelector('#kd_program');
                    var modalBodyInputProgram = editAllNilaiModal.querySelector('#program');
                    var modalBodyInputNilai = editAllNilaiModal.querySelector('#nilai');

                    modalTitle.textContent = 'Edit Nilai';
                    modalBodyInputKdProgram.value = kdProgram;
                    modalBodyInputProgram.value = program;
                    modalBodyInputNilai.value = nilai;
                });
            }
        });
    </script>
@endsection
