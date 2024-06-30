@if (session('no_induk'))
    <script>
        window.location.href = "{{ route('verifikasi.pendaftaran', ['no_induk' => session('no_induk')]) }}";
    </script>
@endif

@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-warning card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="pt-2 px-3">
                                    <h3 class="card-title">Peserta Didik</h3>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                        href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                        aria-selected="true">Biodata Diri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-two-profile" role="tab"
                                        aria-controls="custom-tabs-two-profile" aria-selected="false">Alamat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-two-messages" role="tab"
                                        aria-controls="custom-tabs-two-messages" aria-selected="false">Keluarga</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-two-settings" role="tab"
                                        aria-controls="custom-tabs-two-settings" aria-selected="false">Wali</a>
                                </li>
                            </ul>
                        </div>
                        <form method="POST" action="/admin/pendaftaran/{{ $cari->no_induk }}" class="form-horizontal">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-home-tab">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="no_induk" class="col-sm-12 col-form-label">NIS (Nomor Induk
                                                        Siswa) <span class="text-danger">*</span></label>
                                                    <input value="{{ $no_induk }}" readonly required type="text"
                                                        name="no_induk"
                                                        class="form-control @error('no_induk') is-invalid @enderror"
                                                        id="no_induk" placeholder="Nomor Induk Siswa">
                                                    @error('no_induk')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nm_lengkap" class="col-sm-12 col-form-label">Nama Lengkap
                                                        <span class="text-danger">*</span></label>
                                                    <input value="{{ old('nm_lengkap', ucwords($cari->nm_lengkap)) }}"
                                                        autofocus required type="text" name="nm_lengkap"
                                                        class="form-control @error('nm_lengkap') is-invalid @enderror"
                                                        id="nm_lengkap" placeholder="Nama Lengkap">
                                                    @error('nm_lengkap')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tmp_lahir" class="col-sm-12 col-form-label">Tempat Lahir
                                                        <span class="text-danger">*</span></label>
                                                    <input value="{{ old('tmp_lahir', ucwords($cari->tmp_lahir)) }}"
                                                        required type="text" name="tmp_lahir"
                                                        class="form-control @error('tmp_lahir') is-invalid @enderror"
                                                        id="tmp_lahir" placeholder="Tempat Lahir">
                                                    @error('tmp_lahir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tgl_lahir" class="col-sm-12 col-form-label">Tanggal Lahir
                                                        <span class="text-danger">*</span></label>
                                                    <input value="{{ old('tgl_lahir', $cari->tgl_lahir) }}" required
                                                        type="date" name="tgl_lahir"
                                                        class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                        id="tgl_lahir" placeholder="Tanggal Lahir">
                                                    @error('tgl_lahir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="gender" class="col-sm-12 col-form-label">Jenis Kelamin
                                                        <span class="text-danger">*</span></label>
                                                    <select name="gender" id="gender"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        required>
                                                        <option value="" {{ old('gender') ? '' : 'selected' }}>Pilih
                                                            Jenis Kelamin</option>
                                                        <option value="l"
                                                            {{ old('gender', $cari->gender) == 'l' ? 'selected' : '' }}>
                                                            Laki-laki</option>
                                                        <option value="p"
                                                            {{ old('gender', $cari->gender) == 'p' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nisn" class="col-sm-12 col-form-label">NISN</label>
                                                    <input value="{{ old('nisn', $cari->nisn) }}" type="text"
                                                        name="nisn"
                                                        class="form-control @error('nisn') is-invalid @enderror"
                                                        id="nisn" placeholder="Nomor Induk Siswa Nasional">
                                                    @error('nisn')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nik" class="col-sm-12 col-form-label">NIK (Nomor
                                                        Induk Kependudukan)</label>
                                                    <input value="{{ old('nik', $cari->nik) }}" type="text"
                                                        name="nik"
                                                        class="form-control @error('nik') is-invalid @enderror"
                                                        id="nik" placeholder="Nomor Induk Kependudukan"
                                                        oninput="checkMaxLength(this)">
                                                    @error('nik')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="agama" class="col-sm-12 col-form-label">Agama <span
                                                            class="text-danger">*</span></label>
                                                    <select name="agama" id="agama"
                                                        class="form-control @error('agama') is-invalid @enderror" required>
                                                        <option value=""
                                                            {{ old('agama', ucwords($cari->agama)) ? '' : 'selected' }}>
                                                            Pilih Agama</option>
                                                        <option value="Islam"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Islam' ? 'selected' : '' }}>
                                                            Islam</option>
                                                        <option value="Kristen/Katolik"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Kristen/Katolik' ? 'selected' : '' }}>
                                                            Kristen/Katolik</option>
                                                        <option value="Hindu"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Hindu' ? 'selected' : '' }}>
                                                            Hindu</option>
                                                        <option value="Budha"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Budha' ? 'selected' : '' }}>
                                                            Budha</option>
                                                        <option value="Khonghucu"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Khonghucu' ? 'selected' : '' }}>
                                                            Khonghucu</option>
                                                        <option value="Lainnya"
                                                            {{ old('agama', ucwords($cari->agama)) == 'Lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('agama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kewarganegaraan"
                                                        class="col-sm-12 col-form-label">Kewarganegaraan <span
                                                            class="text-danger">*</span></label>
                                                    <select name="kewarganegaraan" class="custom-select" required>
                                                        <option value=""
                                                            {{ old('kewarganegaraan') ? '' : 'selected' }}>Pilih
                                                            Kewarganegaraan</option>
                                                        <option value="wni"
                                                            {{ old('kewarganegaraan', $cari->kewarganegaraan) == 'wni' ? 'selected' : '' }}>
                                                            Warga Negara Indonesia (WNI)</option>
                                                        <option value="wna"
                                                            {{ old('kewarganegaraan', $cari->kewarganegaraan) == 'wna' ? 'selected' : '' }}>
                                                            Warga Negara Asing (WNA)</option>
                                                    </select>
                                                    @error('kewarganegaraan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pend_akhir" class="col-sm-12 col-form-label">Pendidikan
                                                        Terakhir <span class="text-danger">*</span></label>
                                                    <select name="pend_akhir"
                                                        class="form-control @error('pend_akhir') is-invalid @enderror"
                                                        required>
                                                        <option value="" {{ old('pend_akhir') ? '' : 'selected' }}>
                                                            Pilih Pendidikan Terakhir</option>
                                                        <option value="tidak sekolah"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'tidak sekolah' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="sd"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'SD' ? 'selected' : '' }}>
                                                            SD</option>
                                                        <option value="smp"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'SMP' ? 'selected' : '' }}>
                                                            SMP</option>
                                                        <option value="slta"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'SLTA' ? 'selected' : '' }}>
                                                            SLTA</option>
                                                        <option value="d3"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'D3' ? 'selected' : '' }}>
                                                            D3</option>
                                                        <option value="s1"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'S1' ? 'selected' : '' }}>
                                                            D4/S1</option>
                                                        <option value="s2"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'S2' ? 'selected' : '' }}>
                                                            S2</option>
                                                        <option value="s3"
                                                            {{ old('pend_akhir', strtoupper($cari->pend_akhir)) == 'S3' ? 'selected' : '' }}>
                                                            S3</option>
                                                    </select>
                                                    @error('pend_akhir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="email" class="col-sm-12 col-form-label">Email</label>
                                                    <input value="{{ old('email', $cari->email) }}" type="email"
                                                        autocomplete="off" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" placeholder="Email">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="no_hp" class="col-sm-12 col-form-label">No. HP</label>
                                                    <input value="{{ old('no_hp', $cari->no_hp) }}" type="text"
                                                        name="no_hp"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        id="no_hp" placeholder="Nomor HP Aktif">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="status_pekerjaan"
                                                        class="col-sm-12 col-form-label">Pekerjaan <span
                                                            class="text-danger">*</span></label>
                                                    <select name="status_pekerjaan" id="status_pekerjaan"
                                                        class="form-control @error('status_pekerjaan') is-invalid @enderror"
                                                        required>
                                                        <option value=""
                                                            {{ old('status_pekerjaan') ? '' : 'selected' }}>Pilih Pekerjaan
                                                        </option>
                                                        <option value="tidak bekerja"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'tidak bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="pelajar"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'pelajar' ? 'selected' : '' }}>
                                                            Pelajar</option>
                                                        <option value="mahasiswa"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'mahasiswa' ? 'selected' : '' }}>
                                                            Mahasiswa</option>
                                                        <option value="nelayan"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'nelayan' ? 'selected' : '' }}>
                                                            Nelayan</option>
                                                        <option value="petani"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="peternak"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'peternak' ? 'selected' : '' }}>
                                                            Peternak</option>
                                                        <option value="pns/tni/polri"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'pns/tni/polri' ? 'selected' : '' }}>
                                                            PNS/TNI/Polri</option>
                                                        <option value="guru"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'guru' ? 'selected' : '' }}>
                                                            Guru</option>
                                                        <option value="karyawan swasta"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'karyawan swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="pedagang/wiraswasta"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'pedagang/wiraswasta' ? 'selected' : '' }}>
                                                            Pedagang/Wiraswasta</option>
                                                        <option value="buruh"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'buruh' ? 'selected' : '' }}>
                                                            Buruh</option>
                                                        <option value="pensiunan"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'pensiunan' ? 'selected' : '' }}>
                                                            Pensiunan</option>
                                                        <option value="lainnya"
                                                            {{ old('status_pekerjaan', $cari->status_pekerjaan) == 'lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('status_pekerjaan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tgl_masuk" class="col-sm-12 col-form-label">Tanggal Daftar
                                                        <span class="text-danger">*</span></label>
                                                    <input value="{{ old('tgl_masuk', $cari->tgl_masuk) }}" required
                                                        type="date" name="tgl_masuk"
                                                        class="form-control @error('tgl_masuk') is-invalid @enderror"
                                                        id="tgl_masuk" placeholder="Tanggal Lahir">
                                                    @error('tgl_masuk')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-info float-right"
                                                id="nextalamat">Selanjutnya</button>
                                            <a href="{{ route('pendaftaran.index') }}"><button type="button"
                                                    class="btn btn-light float-left" id="nextalamat">Batal</button></a>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-profile-tab">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="alamat" class="col-sm-12 col-form-label">Alamat Lengkap
                                                        <span class="text-danger">*</span></label>
                                                    <input value="{{ old('alamat', ucfirst($cari->alamat)) }}" autofocus
                                                        required type="text" name="alamat"
                                                        class="form-control @error('alamat') is-invalid @enderror"
                                                        id="alamat" placeholder="Alamat Lengkap">
                                                    @error('alamat')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="rt" class="col-sm-12 col-form-label">RT</label>
                                                    <input value="{{ old('rt', $cari->rt) }}" type="text"
                                                        name="rt"
                                                        class="form-control @error('rt') is-invalid @enderror"
                                                        id="rt" placeholder="RT">
                                                    @error('rt')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="rw" class="col-sm-12 col-form-label">RW</label>
                                                    <input value="{{ old('rw', $cari->rw) }}" type="text"
                                                        name="rw"
                                                        class="form-control @error('rw') is-invalid @enderror"
                                                        id="rw" placeholder="RW">
                                                    @error('rw')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kel" class="col-sm-12 col-form-label">Desa /
                                                        Kelurahan</label>
                                                    <input value="{{ old('kel', ucwords($cari->kel)) }}" type="text"
                                                        name="kel"
                                                        class="form-control @error('kel') is-invalid @enderror"
                                                        id="kel" placeholder="Desa/Kelurahan">
                                                    @error('kel')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kec"
                                                        class="col-sm-12 col-form-label">Kecamatan</label>
                                                    <input value="{{ old('kec', ucwords($cari->kec)) }}" type="text"
                                                        name="kec"
                                                        class="form-control @error('kec') is-invalid @enderror"
                                                        id="kec" placeholder="Kecamatan">
                                                    @error('kec')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kd_pos" class="col-sm-12 col-form-label">Kode Pos
                                                    </label>
                                                    <input value="{{ old('kd_pos', $cari->kd_pos) }}" type="text"
                                                        name="kd_pos"
                                                        class="form-control @error('kd_pos') is-invalid @enderror"
                                                        id="kd_pos" placeholder="Kode Pos">
                                                    @error('kd_pos')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="kab" class="col-sm-12 col-form-label">Kabupaten /
                                                        Kota <span class="text-danger">*</span></label>
                                                    <input value="{{ old('kab', ucwords($cari->kab)) }}" required
                                                        type="text" name="kab"
                                                        class="form-control @error('kab') is-invalid @enderror"
                                                        id="kab" placeholder="Kabupaten/Kota">
                                                    @error('kab')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="provinsi"
                                                        class="col-sm-12 col-form-label">Provinsi</label>
                                                    <select name="provinsi" id="provinsi"
                                                        class="form-control @error('provinsi') is-invalid @enderror">
                                                        <option value="" {{ old('provinsi') ? '' : 'selected' }}>
                                                            Pilih Provinsi</option>
                                                        <option value="Aceh"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Aceh' ? 'selected' : '' }}>
                                                            Aceh</option>
                                                        <option value="Sumatera Utara"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sumatera Utara' ? 'selected' : '' }}>
                                                            Sumatera Utara</option>
                                                        <option value="Sumatera Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sumatera Barat' ? 'selected' : '' }}>
                                                            Sumatera Barat</option>
                                                        <option value="Riau"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Riau' ? 'selected' : '' }}>
                                                            Riau</option>
                                                        <option value="Jambi"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Jambi' ? 'selected' : '' }}>
                                                            Jambi</option>
                                                        <option value="Sumatera Selatan"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sumatera Selatan' ? 'selected' : '' }}>
                                                            Sumatera Selatan</option>
                                                        <option value="Bengkulu"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Bengkulu' ? 'selected' : '' }}>
                                                            Bengkulu</option>
                                                        <option value="Lampung"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Lampung' ? 'selected' : '' }}>
                                                            Lampung</option>
                                                        <option value="Kepulauan Bangka Belitung"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kepulauan Bangka Belitung' ? 'selected' : '' }}>
                                                            Kepulauan Bangka Belitung</option>
                                                        <option value="Kepulauan Riau"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kepulauan Riau' ? 'selected' : '' }}>
                                                            Kepulauan Riau</option>
                                                        <option value="DKI Jakarta"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'DKI Jakarta' ? 'selected' : '' }}>
                                                            DKI Jakarta</option>
                                                        <option value="Jawa Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Jawa Barat' ? 'selected' : '' }}>
                                                            Jawa Barat</option>
                                                        <option value="Jawa Tengah"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Jawa Tengah' ? 'selected' : '' }}>
                                                            Jawa Tengah</option>
                                                        <option value="DI Yogyakarta"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'DI Yogyakarta' ? 'selected' : '' }}>
                                                            DI Yogyakarta</option>
                                                        <option value="Jawa Timur"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Jawa Timur' ? 'selected' : '' }}>
                                                            Jawa Timur</option>
                                                        <option value="Banten"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Banten' ? 'selected' : '' }}>
                                                            Banten</option>
                                                        <option value="Bali"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Bali' ? 'selected' : '' }}>
                                                            Bali</option>
                                                        <option value="Nusa Tenggara Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Nusa Tenggara Barat' ? 'selected' : '' }}>
                                                            Nusa Tenggara Barat</option>
                                                        <option value="Nusa Tenggara Timur"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Nusa Tenggara Timur' ? 'selected' : '' }}>
                                                            Nusa Tenggara Timur</option>
                                                        <option value="Kalimantan Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kalimantan Barat' ? 'selected' : '' }}>
                                                            Kalimantan Barat</option>
                                                        <option value="Kalimantan Tengah"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kalimantan Tengah' ? 'selected' : '' }}>
                                                            Kalimantan Tengah</option>
                                                        <option value="Kalimantan Selatan"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kalimantan Selatan' ? 'selected' : '' }}>
                                                            Kalimantan Selatan</option>
                                                        <option value="Kalimantan Timur"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kalimantan Timur' ? 'selected' : '' }}>
                                                            Kalimantan Timur</option>
                                                        <option value="Kalimantan Utara"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Kalimantan Utara' ? 'selected' : '' }}>
                                                            Kalimantan Utara</option>
                                                        <option value="Sulawesi Utara"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sulawesi Utara' ? 'selected' : '' }}>
                                                            Sulawesi Utara</option>
                                                        <option value="Sulawesi Tengah"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sulawesi Tengah' ? 'selected' : '' }}>
                                                            Sulawesi Tengah</option>
                                                        <option value="Sulawesi Selatan"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sulawesi Selatan' ? 'selected' : '' }}>
                                                            Sulawesi Selatan</option>
                                                        <option value="Sulawesi Tenggara"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sulawesi Tenggara' ? 'selected' : '' }}>
                                                            Sulawesi Tenggara</option>
                                                        <option value="Gorontalo"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Gorontalo' ? 'selected' : '' }}>
                                                            Gorontalo</option>
                                                        <option value="Sulawesi Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Sulawesi Barat' ? 'selected' : '' }}>
                                                            Sulawesi Barat</option>
                                                        <option value="Maluku"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Maluku' ? 'selected' : '' }}>
                                                            Maluku</option>
                                                        <option value="Maluku Utara"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Maluku Utara' ? 'selected' : '' }}>
                                                            Maluku Utara</option>
                                                        <option value="Papua Barat"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Papua Barat' ? 'selected' : '' }}>
                                                            Papua Barat</option>
                                                        <option value="Papua"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Papua' ? 'selected' : '' }}>
                                                            Papua</option>
                                                        <option value="Papua Tengah"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Papua Tengah' ? 'selected' : '' }}>
                                                            Papua Tengah</option>
                                                        <option value="Papua Pegunungan"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Papua Pegunungan' ? 'selected' : '' }}>
                                                            Papua Pegunungan</option>
                                                        <option value="Papua Selatan"
                                                            {{ old('provinsi', ucwords($cari->provinsi)) == 'Papua Selatan' ? 'selected' : '' }}>
                                                            Papua Selatan</option>
                                                    </select>
                                                    @error('provinsi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="jns_tinggal" class="col-sm-12 col-form-label">Jenis
                                                        Tinggal</label>
                                                    <select name="jns_tinggal" id="jns_tinggal"
                                                        class="form-control @error('jns_tinggal') is-invalid @enderror">
                                                        <option value=""
                                                            {{ old('jns_tinggal') ? '' : 'selected' }}>Pilih Jenis Tinggal
                                                        </option>
                                                        <option value="rumah_sendiri"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'rumah_sendiri' ? 'selected' : '' }}>
                                                            Rumah Sendiri</option>
                                                        <option value="kos"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'kos' ? 'selected' : '' }}>
                                                            Kos</option>
                                                        <option value="kontrak"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'kontrak' ? 'selected' : '' }}>
                                                            Kontrak</option>
                                                        <option value="bersama_orang_tua"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'bersama_orang_tua' ? 'selected' : '' }}>
                                                            Bersama Orang Tua</option>
                                                        <option value="bersama_wali"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'bersama_wali' ? 'selected' : '' }}>
                                                            Bersama Wali</option>
                                                        <option value="lainnya"
                                                            {{ old('jns_tinggal', $cari->jns_tinggal) == 'lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('jns_tinggal')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-info float-right"
                                                id="nextkeluarga">Selanjutnya</button>
                                            <button type="button" class="btn btn-secondary float-left"
                                                id="nexthome">Kembali</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-messages-tab">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nm_ayah" class="col-sm-12 col-form-label">Nama
                                                        Ayah</label>
                                                    <input value="{{ old('nm_ayah', ucwords($cari->nm_ayah)) }}"
                                                        type="text" name="nm_ayah"
                                                        class="form-control @error('nm_ayah') is-invalid @enderror"
                                                        id="nm_ayah" placeholder="Nama Ayah">
                                                    @error('nm_ayah')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nik_ayah" class="col-sm-12 col-form-label">NIK
                                                        Ayah</label>
                                                    <input value="{{ old('nik_ayah', $cari->nik_ayah) }}" type="text"
                                                        name="nik_ayah"
                                                        class="form-control @error('nik_ayah') is-invalid @enderror"
                                                        id="nik_ayah" placeholder="Nomor Induk Kependudukan"
                                                        oninput="checkMaxLength(this)">
                                                    @error('nik_ayah')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tgl_ayah" class="col-sm-12 col-form-label">Tanggal Lahir
                                                        Ayah</label>
                                                    <input value="{{ old('tgl_ayah', $cari->tgl_ayah) }}" type="date"
                                                        name="tgl_ayah"
                                                        class="form-control @error('tgl_ayah') is-invalid @enderror"
                                                        id="tgl_ayah">
                                                    @error('tgl_ayah')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pend_ayah" class="col-sm-12 col-form-label">Pendidikan
                                                        Ayah</label>
                                                    <select name="pend_ayah"
                                                        class="form-control @error('pend_ayah') is-invalid @enderror">
                                                        <option value="" {{ old('pend_ayah') ? '' : 'selected' }}>
                                                            Pilih Pendidikan Terakhir</option>
                                                        <option value="tidak sekolah"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'TIDAK SEKOLAH' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="sd"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'SD' ? 'selected' : '' }}>
                                                            SD</option>
                                                        <option value="smp"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'SMP' ? 'selected' : '' }}>
                                                            SMP</option>
                                                        <option value="SLTA"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'SLTA' ? 'selected' : '' }}>
                                                            SLTA</option>
                                                        <option value="d3"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'D3' ? 'selected' : '' }}>
                                                            D3</option>
                                                        <option value="s1"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'S1' ? 'selected' : '' }}>
                                                            D4/S1</option>
                                                        <option value="s2"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'S2' ? 'selected' : '' }}>
                                                            S2</option>
                                                        <option value="s3"
                                                            {{ old('pend_ayah', strtoupper($cari->kewarganegaraan)) == 'S3' ? 'selected' : '' }}>
                                                            S3</option>
                                                    </select>
                                                    @error('pend_ayah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pek_ayah" class="col-sm-12 col-form-label">Pekerjaan
                                                        Ayah</label>
                                                    <select name="pek_ayah" id="pek_ayah"
                                                        class="form-control @error('pek_ayah') is-invalid @enderror">
                                                        <option value="" {{ old('pek_ayah') ? '' : 'selected' }}>
                                                            Pilih Pekerjaan</option>
                                                        <option value="tidak bekerja"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'tidak bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="nelayan"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'nelayan' ? 'selected' : '' }}>
                                                            Nelayan</option>
                                                        <option value="petani"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="peternak"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'peternak' ? 'selected' : '' }}>
                                                            Peternak</option>
                                                        <option value="pns/tni/polri"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'pns/tni/polri' ? 'selected' : '' }}>
                                                            PNS/TNI/Polri</option>
                                                        <option value="guru"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'guru' ? 'selected' : '' }}>
                                                            Guru</option>
                                                        <option value="karyawan swasta"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'karyawan swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="pedagang/wiraswasta"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'pedagang/wiraswasta' ? 'selected' : '' }}>
                                                            Pedagang/Wiraswasta</option>
                                                        <option value="buruh"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'buruh' ? 'selected' : '' }}>
                                                            Buruh</option>
                                                        <option value="pensiunan"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'pensiunan' ? 'selected' : '' }}>
                                                            Pensiunan</option>
                                                        <option value="lainnya"
                                                            {{ old('pek_ayah', $cari->pek_ayah) == 'lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('pek_ayah')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nm_ibu" class="col-sm-12 col-form-label">Nama
                                                        Ibu</label>
                                                    <input value="{{ old('nm_ibu', ucwords($cari->nm_ibu)) }}" autofocus
                                                        type="text" name="nm_ibu"
                                                        class="form-control @error('nm_ibu') is-invalid @enderror"
                                                        id="nm_ibu" placeholder="Nama Ibu">
                                                    @error('nm_ibu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nik_ibu" class="col-sm-12 col-form-label">NIK Ibu</label>
                                                    <input value="{{ old('nik_ibu', $cari->nik_ibu) }}" type="text"
                                                        name="nik_ibu"
                                                        class="form-control @error('nik_ibu') is-invalid @enderror"
                                                        id="nik_ibu" placeholder="Nomor Induk Kependudukan"
                                                        oninput="checkMaxLength(this)">
                                                    @error('nik_ibu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tgl_ibu" class="col-sm-12 col-form-label">Tanggal Lahir
                                                        Ibu</label>
                                                    <input value="{{ old('tgl_ibu', $cari->tgl_ibu) }}" type="date"
                                                        name="tgl_ibu"
                                                        class="form-control @error('tgl_ibu') is-invalid @enderror"
                                                        id="tgl_ibu">
                                                    @error('tgl_ibu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pend_ibu" class="col-sm-12 col-form-label">Pendidikan
                                                        Ibu</label>
                                                    <select name="pend_ibu"
                                                        class="form-control @error('pend_ibu') is-invalid @enderror">
                                                        <option value=""
                                                            {{ old('pend_ibu', $cari->pend_ibu) ? '' : 'selected' }}>Pilih
                                                            Pendidikan Terakhir</option>
                                                        <option value="tidak sekolah"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'tidak sekolah' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="sd"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'sd' ? 'selected' : '' }}>
                                                            SD</option>
                                                        <option value="smp"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'smp' ? 'selected' : '' }}>
                                                            SMP</option>
                                                        <option value="SLTA"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'SLTA' ? 'selected' : '' }}>
                                                            SLTA</option>
                                                        <option value="d3"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'd3' ? 'selected' : '' }}>
                                                            D3</option>
                                                        <option value="d4/s1"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 'd4/s1' ? 'selected' : '' }}>
                                                            D4/S1</option>
                                                        <option value="s2"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 's2' ? 'selected' : '' }}>
                                                            S2</option>
                                                        <option value="s3"
                                                            {{ old('pend_ibu', $cari->pend_ibu) == 's3' ? 'selected' : '' }}>
                                                            S3</option>
                                                    </select>
                                                    @error('pend_ibu')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pek_ibu" class="col-sm-12 col-form-label">Pekerjaan
                                                        Ibu</label>
                                                    <select name="pek_ibu" id="pek_ibu"
                                                        class="form-control @error('pek_ibu') is-invalid @enderror">
                                                        <option value="" {{ old('pek_ibu') ? '' : 'selected' }}>
                                                            Pilih Pekerjaan</option>
                                                        <option value="tidak bekerja"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'tidak bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="nelayan"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'nelayan' ? 'selected' : '' }}>
                                                            Nelayan</option>
                                                        <option value="petani"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="peternak"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'peternak' ? 'selected' : '' }}>
                                                            Peternak</option>
                                                        <option value="pns/tni/polri"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'pns/tni/polri' ? 'selected' : '' }}>
                                                            PNS/TNI/Polri</option>
                                                        <option value="guru"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'guru' ? 'selected' : '' }}>
                                                            Guru</option>
                                                        <option value="karyawan swasta"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'karyawan swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="pedagang/wiraswasta"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'pedagang/wiraswasta' ? 'selected' : '' }}>
                                                            Pedagang/Wiraswasta</option>
                                                        <option value="buruh"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'buruh' ? 'selected' : '' }}>
                                                            Buruh</option>
                                                        <option value="pensiunan"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'pensiunan' ? 'selected' : '' }}>
                                                            Pensiunan</option>
                                                        <option value="lainnya"
                                                            {{ old('pek_ibu', $cari->pek_ibu) == 'lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('pek_ibu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="alamat_ortu" class="col-sm-12 col-form-label">Alamat Orang
                                                        Tua</label>
                                                    <input value="{{ old('alamat_ortu', ucwords($cari->alamat_ortu)) }}"
                                                        autofocus type="text" name="alamat_ortu"
                                                        class="form-control @error('alamat_ortu') is-invalid @enderror"
                                                        id="alamat_ortu" placeholder="Alamat Lengkap">
                                                    @error('alamat_ortu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="hp_ortu" class="col-sm-12 col-form-label">HP Orang
                                                        Tua</label>
                                                    <input value="{{ old('hp_ortu', $cari->hp_ortu) }}" autofocus
                                                        type="text" name="hp_ortu"
                                                        class="form-control @error('hp_ortu') is-invalid @enderror"
                                                        id="hp_ortu" placeholder="HP Orang Tua">
                                                    @error('hp_ortu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="telepon_ortu" class="col-sm-12 col-form-label">Telepon
                                                        Orang Tua</label>
                                                    <input value="{{ old('telepon_ortu', $cari->telepon_ortu) }}"
                                                        autofocus type="text" name="telepon_ortu"
                                                        class="form-control @error('telepon_ortu') is-invalid @enderror"
                                                        id="telepon_ortu" placeholder="Telepon">
                                                    @error('telepon_ortu')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="anak_ke" class="col-sm-12 col-form-label">Anak ke</label>
                                                    <input value="{{ old('anak_ke', $cari->anak_ke) }}" autofocus
                                                        type="text" name="anak_ke"
                                                        class="form-control @error('anak_ke') is-invalid @enderror"
                                                        id="anak_ke" placeholder="Anak ke">
                                                    @error('anak_ke')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-info float-right"
                                                id="nextwali">Selanjutnya</button>
                                            <button type="button" class="btn btn-secondary float-left"
                                                id="prevalamat">Kembali</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-settings-tab">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nm_wali" class="col-sm-12 col-form-label">Nama
                                                        Wali</label>
                                                    <input value="{{ old('nm_wali', ucwords($cari->nm_wali)) }}"
                                                        type="text" name="nm_wali"
                                                        class="form-control @error('nm_wali') is-invalid @enderror"
                                                        id="nm_wali" placeholder="Nama Wali">
                                                    @error('nm_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nik_wali" class="col-sm-12 col-form-label">NIK
                                                        Wali</label>
                                                    <input value="{{ old('nik_wali', $cari->nik_wali) }}" type="text"
                                                        name="nik_wali"
                                                        class="form-control @error('nik_wali') is-invalid @enderror"
                                                        id="nik_wali" placeholder="Nomor Induk Kependudukan"
                                                        oninput="checkMaxLength(this)">
                                                    @error('nik_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="tgl_wali" class="col-sm-12 col-form-label">Tanggal Lahir
                                                        Wali</label>
                                                    <input value="{{ old('tgl_wali', $cari->tgl_wali) }}" type="date"
                                                        name="tgl_wali"
                                                        class="form-control @error('tgl_wali') is-invalid @enderror"
                                                        id="tgl_wali">
                                                    @error('tgl_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pend_wali" class="col-sm-12 col-form-label">Pendidikan
                                                        Wali</label>
                                                    <select name="pend_wali"
                                                        class="form-control @error('pend_wali') is-invalid @enderror">
                                                        <option value="" {{ old('pend_wali') ? '' : 'selected' }}>
                                                            Pilih Pendidikan Terakhir</option>
                                                        <option value="tidak sekolah"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'TIDAK SEKOLAH' ? 'selected' : '' }}>
                                                            Tidak Sekolah</option>
                                                        <option value="sd"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'SD' ? 'selected' : '' }}>
                                                            SD</option>
                                                        <option value="smp"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'SMP' ? 'selected' : '' }}>
                                                            SMP</option>
                                                        <option value="SLTA"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'SLTA' ? 'selected' : '' }}>
                                                            SLTA</option>
                                                        <option value="d3"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'D3' ? 'selected' : '' }}>
                                                            D3</option>
                                                        <option value="d4/s1"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'S1' ? 'selected' : '' }}>
                                                            D4/S1</option>
                                                        <option value="s2"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'S2' ? 'selected' : '' }}>
                                                            S2</option>
                                                        <option value="s3"
                                                            {{ old('pend_wali', strtoupper($cari->pend_wali)) == 'S3' ? 'selected' : '' }}>
                                                            S3</option>
                                                    </select>
                                                    @error('pend_wali')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="pek_wali" class="col-sm-12 col-form-label">Pekerjaan
                                                        Wali</label>
                                                    <select name="pek_wali" id="pek_wali"
                                                        class="form-control @error('pek_wali') is-invalid @enderror">
                                                        <option value="" {{ old('pek_wali') ? '' : 'selected' }}>
                                                            Pilih Pekerjaan</option>
                                                        <option value="tidak bekerja"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'tidak bekerja' ? 'selected' : '' }}>
                                                            Tidak Bekerja</option>
                                                        <option value="nelayan"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'nelayan' ? 'selected' : '' }}>
                                                            Nelayan</option>
                                                        <option value="petani"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'petani' ? 'selected' : '' }}>
                                                            Petani</option>
                                                        <option value="peternak"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'peternak' ? 'selected' : '' }}>
                                                            Peternak</option>
                                                        <option value="pns/tni/polri"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'pns/tni/polri' ? 'selected' : '' }}>
                                                            PNS/TNI/Polri</option>
                                                        <option value="guru"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'guru' ? 'selected' : '' }}>
                                                            Guru</option>
                                                        <option value="karyawan swasta"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'karyawan swasta' ? 'selected' : '' }}>
                                                            Karyawan Swasta</option>
                                                        <option value="pedagang/wiraswasta"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'pedagang/wiraswasta' ? 'selected' : '' }}>
                                                            Pedagang/Wiraswasta</option>
                                                        <option value="buruh"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'buruh' ? 'selected' : '' }}>
                                                            Buruh</option>
                                                        <option value="pensiunan"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'pensiunan' ? 'selected' : '' }}>
                                                            Pensiunan</option>
                                                        <option value="lainnya"
                                                            {{ old('pek_wali', $cari->pek_wali) == 'lainnya' ? 'selected' : '' }}>
                                                            Lainnya</option>
                                                    </select>
                                                    @error('pek_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="alamat_wali" class="col-sm-12 col-form-label">Alamat
                                                        Wali</label>
                                                    <input value="{{ old('alamat_wali', ucwords($cari->alamat_wali)) }}"
                                                        type="text" name="alamat_wali"
                                                        class="form-control @error('alamat_wali') is-invalid @enderror"
                                                        id="alamat_wali" placeholder="Alamat Lengkap">
                                                    @error('alamat_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="hp_wali" class="col-sm-12 col-form-label">HP Wali</label>
                                                    <input value="{{ old('hp_wali', $cari->hp_wali) }}" type="text"
                                                        name="hp_wali"
                                                        class="form-control @error('hp_wali') is-invalid @enderror"
                                                        id="hp_wali" placeholder="HP Wali">
                                                    @error('hp_wali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-secondary float-left"
                                                id="prevkeluarga">Kembali</button>
                                            <button type="submit" class="btn btn-success float-right">Perbarui</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
