@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Silahkan Masukkan Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('profil-lembaga.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_lembaga">Nama Lembaga<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" autofocus value="{{ old('nm_lembaga') }}" required
                                                type="text" name="nm_lembaga"
                                                class="form-control @error('nm_lembaga') is-invalid @enderror"
                                                id="nm_lembaga" placeholder="Nama Lembaga">
                                            @error('nm_lembaga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="npsn">NPSN<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('npsn') }}" required type="text"
                                                name="npsn" class="form-control @error('npsn') is-invalid @enderror"
                                                id="npsn" placeholder="NPSN">
                                            @error('npsn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bentuk">Bentuk Lembaga<span class="text-danger"> *</span></label>
                                            <select name="bentuk" id="bentuk"
                                                class="form-control @error('bentuk') is-invalid @enderror" required>
                                                <option value="" selected disabled>Pilih Bentuk Lembaga</option>
                                                <option value="Kursus" {{ old('bentuk') == 'Kursus' ? 'selected' : '' }}>
                                                    Kursus</option>
                                                <option value="PKBM" {{ old('bentuk') == 'PKBM' ? 'selected' : '' }}>PKBM
                                                </option>
                                            </select>
                                            @error('bentuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sts_lembaga">Status Lembaga<span class="text-danger">
                                                    *</span></label>
                                            <select name="sts_lembaga" id="sts_lembaga"
                                                class="form-control @error('sts_lembaga') is-invalid @enderror" required>
                                                <option value="" selected disabled>Pilih Status Lembaga</option>
                                                <option value="Swasta"
                                                    {{ old('sts_lembaga') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                                <option value="Negeri"
                                                    {{ old('sts_lembaga') == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                                            </select>
                                            @error('sts_lembaga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Tambahkan kolom lain sesuai dengan kebutuhan Anda -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sts">Status<span class="text-danger"> *</span></label>
                                            <select name="sts" id="sts"
                                                class="form-control @error('sts') is-invalid @enderror" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Hak Milik"
                                                    {{ old('sts') == 'Hak Milik' ? 'selected' : '' }}>Hak Milik</option>
                                                <option value="Hak Guna Bangunan"
                                                    {{ old('sts') == 'Hak Guna Bangunan' ? 'selected' : '' }}>Hak Guna
                                                    Bangunan</option>
                                                <option value="Hak Guna Usaha"
                                                    {{ old('sts') == 'Hak Guna Usaha' ? 'selected' : '' }}>Hak Guna Usaha
                                                </option>
                                                <option value="Lainnya" {{ old('sts') == 'Lainnya' ? 'selected' : '' }}>
                                                    Lainnya</option>
                                            </select>
                                            @error('sts')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sk_izin">SK Izin</label>
                                            <input autocomplete="off" value="{{ old('sk_izin') }}" type="text"
                                                name="sk_izin" class="form-control @error('sk_izin') is-invalid @enderror"
                                                id="sk_izin" placeholder="SK Izin">
                                            @error('sk_izin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sk_pendirian">SK Pendirian</label>
                                            <input autocomplete="off" value="{{ old('sk_pendirian') }}" type="text"
                                                name="sk_pendirian"
                                                class="form-control @error('sk_pendirian') is-invalid @enderror"
                                                id="sk_pendirian" placeholder="SK Pendirian">
                                            @error('sk_pendirian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tgl_sk_pendirian">Tgl. SK Pendirian</label>
                                            <input autocomplete="off" value="{{ old('tgl_sk_pendirian') }}" type="date"
                                                name="tgl_sk_pendirian"
                                                class="form-control @error('tgl_sk_pendirian') is-invalid @enderror"
                                                id="tgl_sk_pendirian" placeholder="">
                                            @error('tgl_sk_pendirian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tgl_sk_izin">Tgl. SK Izin</label>
                                            <input autocomplete="off" value="{{ old('tgl_sk_izin') }}" type="date"
                                                name="tgl_sk_izin"
                                                class="form-control @error('tgl_sk_izin') is-invalid @enderror"
                                                id="tgl_sk_izin" placeholder="">
                                            @error('tgl_sk_izin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="alamat">Alamat<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('alamat') }}" required
                                                type="text" name="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                                placeholder="Alamat Lembaga">
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="rt">RT<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('rt') }}" required
                                                type="text" name="rt"
                                                class="form-control @error('rt') is-invalid @enderror" id="rt"
                                                placeholder="RT">
                                            @error('rt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="rw">RW<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('rw') }}" required
                                                type="text" name="rw"
                                                class="form-control @error('rw') is-invalid @enderror" id="rw"
                                                placeholder="RW">
                                            @error('rw')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="provinsi">Provinsi<span class="text-danger"> *</span></label>
                                            <select required name="provinsi"
                                                class="form-control @error('provinsi') is-invalid @enderror"
                                                id="provinsi">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('provinsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kab">Kabupaten<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" autofocus value="{{ old('kab') }}" required
                                                type="text" name="kab"
                                                class="form-control @error('kab') is-invalid @enderror" id="kab"
                                                placeholder="Nama Lembaga">
                                            @error('kab')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kec">Kecamatan<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" autofocus value="{{ old('kec') }}" required
                                                type="text" name="kec"
                                                class="form-control @error('kec') is-invalid @enderror" id="kec"
                                                placeholder="Nama Lembaga">
                                            @error('kec')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kel">Kelurahan<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" autofocus value="{{ old('kel') }}" required
                                                type="text" name="kel"
                                                class="form-control @error('kel') is-invalid @enderror" id="kel"
                                                placeholder="Nama Lembaga">
                                            @error('kel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kd_pos">Kode Pos</label>
                                            <input autocomplete="off" value="{{ old('kd_pos') }}" type="text"
                                                name="kd_pos" class="form-control @error('kd_pos') is-invalid @enderror"
                                                id="kd_pos" placeholder="Kode Pos">
                                            @error('kd_pos')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="no_tel">No. Telepon<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('no_tel') }}" required
                                                type="text" name="no_tel"
                                                class="form-control @error('no_tel') is-invalid @enderror" id="no_tel"
                                                placeholder="No. Telepon">
                                            @error('no_tel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="no_fax">No. Fax</label>
                                            <input autocomplete="off" value="{{ old('no_fax') }}" type="text"
                                                name="no_fax" class="form-control @error('no_fax') is-invalid @enderror"
                                                id="no_fax" placeholder="No. Fax">
                                            @error('no_fax')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="email">Email Lembaga<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('email') }}" required
                                                type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Masukkan Email Lembaga">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="web">Website<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('web') }}" required
                                                type="text" name="web"
                                                class="form-control @error('web') is-invalid @enderror" id="web"
                                                placeholder="Website">
                                            @error('web')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="but_kus">Berkebutuhan Khusus</label>
                                            <select name="but_kus"
                                                class="form-control @error('but_kus') is-invalid @enderror"
                                                id="but_kus">
                                                <option value="" selected disabled>Pilih opsi</option>
                                                <option value="ada" {{ old('but_kus') == 'ada' ? 'selected' : '' }}>Ada
                                                </option>
                                                <option value="tidak ada"
                                                    {{ old('but_kus') == 'tidak ada' ? 'selected' : '' }}>Tidak Ada
                                                </option>
                                            </select>
                                            @error('but_kus')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_bank">Nama Yayasan</label>
                                            <input autocomplete="off" value="{{ old('nm_yayasan') }}" type="text"
                                                name="nm_yayasan"
                                                class="form-control @error('nm_yayasan') is-invalid @enderror"
                                                id="nm_yayasan" placeholder="Masukkan Nama Yayasan">
                                            @error('nm_yayasan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_pajak">Nama Wajib Pajak<span class="text-danger">
                                                    *</span></label>
                                            <input autocomplete="off" value="{{ old('nm_pajak') }}" required
                                                type="text" name="nm_pajak"
                                                class="form-control @error('nm_pajak') is-invalid @enderror"
                                                id="nm_pajak" placeholder="Nama Wajib Pajak">
                                            @error('nm_pajak')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="no_npwp">No. NPWP<span class="text-danger"> *</span></label>
                                            <input autocomplete="off" value="{{ old('no_npwp') }}" required
                                                type="text" name="no_npwp"
                                                class="form-control @error('no_npwp') is-invalid @enderror"
                                                id="no_npwp" placeholder="No. NPWP">
                                            @error('no_npwp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_bank">Nama Bank</label>
                                            <input autocomplete="off" value="{{ old('nm_bank') }}" type="text"
                                                name="nm_bank"
                                                class="form-control @error('nm_bank') is-invalid @enderror"
                                                id="nm_bank" placeholder="Nama Bank">
                                            @error('nm_bank')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="bank_cabang">Bank Cabang</label>
                                            <select name="bank_cabang"
                                                class="form-control @error('bank_cabang') is-invalid @enderror"
                                                id="bank_cabang">
                                                <option value="" selected disabled>Pilih opsi</option>
                                                <option value="Pusat"
                                                    {{ old('bank_cabang') == 'Pusat' ? 'selected' : '' }}>Pusat</option>
                                                <option value="Cabang"
                                                    {{ old('bank_cabang') == 'Cabang' ? 'selected' : '' }}>Cabang</option>
                                                <option value="Unit"
                                                    {{ old('bank_cabang') == 'Unit' ? 'selected' : '' }}>Unit</option>
                                            </select>
                                            @error('bank_cabang')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_rekening">Nama Rekening</label>
                                            <input autocomplete="off" value="{{ old('nm_rekening') }}" type="text"
                                                name="nm_rekening"
                                                class="form-control @error('nm_rekening') is-invalid @enderror"
                                                id="nm_rekening" placeholder="Nama Rekening Lembaga">
                                            @error('nm_rekening')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="luas_tanah">Luas Tanah</label>
                                            <input autocomplete="off" value="{{ old('luas_tanah') }}" type="text"
                                                name="luas_tanah"
                                                class="form-control @error('luas_tanah') is-invalid @enderror"
                                                id="luas_tanah" placeholder="Masukkan Luas Tanah">
                                            @error('luas_tanah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="kat_lembaga">Kategori Lembaga<span class="text-danger">
                                                    *</span></label>
                                            <select required name="kat_lembaga"
                                                class="form-control @error('kat_lembaga') is-invalid @enderror"
                                                id="kat_lembaga">
                                                <option value="" selected disabled>Pilih opsi</option>
                                                <option value="Nasional"
                                                    {{ old('kat_lembaga') == 'Nasional' ? 'selected' : '' }}>Nasional
                                                </option>
                                                <option value="Internasional"
                                                    {{ old('kat_lembaga') == 'Internasional' ? 'selected' : '' }}>
                                                    Internasional</option>
                                            </select>
                                            @error('kat_lembaga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ms_ijin">Masa Ijin</label>
                                            <input autocomplete="off" value="{{ old('ms_ijin') }}" type="date"
                                                name="ms_ijin"
                                                class="form-control @error('ms_ijin') is-invalid @enderror"
                                                id="ms_ijin" placeholder="Nama Bank">
                                            @error('ms_ijin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sumber_dana">Sumber Dana</label>
                                            <input autocomplete="off" value="{{ old('sumber_dana') }}" type="text"
                                                name="sumber_dana"
                                                class="form-control @error('sumber_dana') is-invalid @enderror"
                                                id="sumber_dana" placeholder="Sumber Dana">
                                            @error('sumber_dana')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="no_sertifikat">No. Sertifikat</label>
                                            <input autocomplete="off" value="{{ old('no_sertifikat') }}" type="text"
                                                name="no_sertifikat"
                                                class="form-control @error('no_sertifikat') is-invalid @enderror"
                                                id="no_sertifikat" placeholder="No. Sertifikat">
                                            @error('no_sertifikat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="no_sk_akreditasi">No. SK Akreditasi</label>
                                            <input autocomplete="off" value="{{ old('no_sk_akreditasi') }}"
                                                type="text" name="no_sk_akreditasi"
                                                class="form-control @error('no_sk_akreditasi') is-invalid @enderror"
                                                id="no_sk_akreditasi" placeholder="No. SK Akreditasi">
                                            @error('no_sk_akreditasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="mulai_berlaku">Mulai Berlaku</label>
                                            <input autocomplete="off" value="{{ old('mulai_berlaku') }}" type="date"
                                                name="mulai_berlaku"
                                                class="form-control @error('mulai_berlaku') is-invalid @enderror"
                                                id="mulai_berlaku" placeholder="Sumber Dana">
                                            @error('mulai_berlaku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ms_akreditasi">Masa Sertifikat</label>
                                            <input autocomplete="off" value="{{ old('ms_akreditasi') }}" type="date"
                                                name="ms_akreditasi"
                                                class="form-control @error('ms_akreditasi') is-invalid @enderror"
                                                id="ms_akreditasi" placeholder="">
                                            @error('ms_akreditasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="hasil">Hasil Akreditasi</label>
                                            <select name="hasil"
                                                class="form-control @error('hasil') is-invalid @enderror" id="hasil">
                                                <option value="" selected disabled>Pilih opsi</option>
                                                <option value="A" {{ old('hasil') == 'A' ? 'selected' : '' }}>A
                                                </option>
                                                <option value="B" {{ old('hasil') == 'B' ? 'selected' : '' }}>B
                                                </option>
                                                <option value="C" {{ old('hasil') == 'C' ? 'selected' : '' }}>C
                                                </option>
                                                <option value="D" {{ old('hasil') == 'D' ? 'selected' : '' }}>D
                                                </option>
                                                <option value="Belum Akreditasi"
                                                    {{ old('hasil') == 'Belum Akreditasi' ? 'selected' : '' }}>Belum
                                                    Akreditasi</option>
                                            </select>
                                            @error('hasil')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="penilai">Penilai</label>
                                            <input autocomplete="off" value="{{ old('penilai') }}" type="text"
                                                name="penilai"
                                                class="form-control @error('penilai') is-invalid @enderror"
                                                id="penilai" placeholder="Nama Penilai">
                                            @error('penilai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="tgl_sertifikat">Tgl. Sertifikat</label>
                                            <input autocomplete="off" value="{{ old('tgl_sertifikat') }}" type="date"
                                                name="tgl_sertifikat"
                                                class="form-control @error('tgl_sertifikat') is-invalid @enderror"
                                                id="tgl_sertifikat" placeholder="Nama tgl_sertifikat">
                                            @error('tgl_sertifikat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="logo" class="col-sm-9 col-form-label">Logo Lembaga <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="logo" type="file"
                                                        class="form-control @error('logo') is-invalid @enderror"
                                                        id="logo" onchange="previewImage('logo')">
                                                    <label class="input-group-text" for="logo">Pilih logo</label>
                                                    @error('logo')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="fotoPreview" class="mt-8 col-sm-8 mx-auto d-block">
                                        <img class="img-preview img-fluid mt-8 col-sm-8 mx-auto p-1 d-block"
                                            style="display: none;">
                                    </div>
                                </div>
                                <!-- Tambahkan baris dan kolom sesuai dengan kebutuhan Anda -->
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        document.getElementById('provinsi').addEventListener('change', function() {
            let provinceId = this.value;
            if (provinceId) {
                fetch(`/api/kabupaten/${provinceId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let kabupatenSelect = document.getElementById('kab');
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                        document.getElementById('kec').innerHTML = '<option value="">Pilih Kecamatan</option>';
                        document.getElementById('kel').innerHTML = '<option value="">Pilih Kelurahan</option>';
                        data.forEach(kabupaten => {
                            kabupatenSelect.innerHTML +=
                                `<option value="${kabupaten.id}">${kabupaten.name}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching kabupaten:', error);
                    });
            }
        });

        document.getElementById('kab').addEventListener('change', function() {
            let regencyId = this.value;
            if (regencyId) {
                fetch(`/api/kecamatan/${regencyId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let kecamatanSelect = document.getElementById('kec');
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        document.getElementById('kel').innerHTML = '<option value="">Pilih Kelurahan</option>';
                        data.forEach(kecamatan => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kecamatan.id}">${kecamatan.name}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching kecamatan:', error);
                    });
            }
        });

        document.getElementById('kec').addEventListener('change', function() {
            let districtId = this.value;
            if (districtId) {
                fetch(`/api/kelurahan/${districtId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let kelurahanSelect = document.getElementById('kel');
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                        data.forEach(kelurahan => {
                            kelurahanSelect.innerHTML +=
                                `<option value="${kelurahan.id}">${kelurahan.name}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching kelurahan:', error);
                    });
            }
        });
    </script>
@endsection
