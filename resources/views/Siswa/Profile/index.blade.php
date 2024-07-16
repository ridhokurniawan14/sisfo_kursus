@extends('layouts.main_student')

@section('container')
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
        <div class="container">

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
                            <!-- Modal untuk Melihat Foto -->
                            <div class="modal fade" id="viewPhotoModal" tabindex="-1" role="dialog"
                                aria-labelledby="viewPhotoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewPhotoModalLabel">View Photo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <b>NIS / Username</b> <a class="float-right">{{ auth()->user()->no_induk }}</a>
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
                                            <span class="right badge badge-warning">MASIH KOSONG</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tgl. Daftar</b> <a
                                        class="float-right">{{ \Carbon\Carbon::parse($data->tgl_masuk)->isoFormat('D MMMM YYYY') }}</a>
                                </li>
                            </ul>
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
                                                                    <span class="profile-label">Agama</span>
                                                                    <span
                                                                        class="profile-data">{{ !empty($data->agama) ? ucwords($data->agama) : '-' }}</span>
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
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
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
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection
