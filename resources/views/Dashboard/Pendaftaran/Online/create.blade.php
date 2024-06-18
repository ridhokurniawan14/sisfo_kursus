{{-- @if(session('no_induk'))
    <script>
        window.location.href = "{{ route('verifikasi.pendaftaran', ['no_induk' => session('no_induk')]) }}";
    </script>
@endif --}}

@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Peserta Didik</h3></li>
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Biodata Diri</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Alamat</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Keluarga</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Wali</a>
                  </li>
                </ul>
              </div>
              <form method="POST" action="{{ route('pendaftar-online.store', ['id' => $id]) }}" class="form-horizontal">
              @csrf
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="no_induk" class="col-sm-12 col-form-label">NIS (Nomor Induk Siswa) <span class="text-danger">*</span></label>
                              <input value="{{ $newNIS }}" readonly required type="text" name="no_induk" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" placeholder="Nomor Induk Siswa">
                              @error('no_induk')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nm_lengkap" class="col-sm-12 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                          <input value="{{ old('nm_lengkap', (ucwords($pendaftar_online->nm_lengkap))) }}" autofocus required type="text" name="nm_lengkap" class="form-control @error('nm_lengkap') is-invalid @enderror" id="nm_lengkap" placeholder="Nama Lengkap">
                          @error('nm_lengkap')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tmp_lahir" class="col-sm-12 col-form-label">Tempat Lahir <span class="text-danger">*</span></label>
                          <input value="{{ old('tmp_lahir', (ucwords($pendaftar_online->tmp_lahir))) }}" required type="text" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" id="tmp_lahir" placeholder="Tempat Lahir">
                          @error('tmp_lahir')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tgl_lahir" class="col-sm-12 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                          <input value="{{ old('tgl_lahir', $pendaftar_online->tgl_lahir) }}" required type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" placeholder="Tanggal Lahir">
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
                          <label for="gender" class="col-sm-12 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                          <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                            <option value="" {{ old('gender', $pendaftar_online->gender) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                            <option value="l" {{ in_array(old('gender', $pendaftar_online->gender), ['l', 'L']) ? 'selected' : '' }}>Laki-laki</option>
                            <option value="p" {{ in_array(old('gender', $pendaftar_online->gender), ['p', 'P']) ? 'selected' : '' }}>Perempuan</option>
                          <select>
                          @error('gender')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nisn" class="col-sm-12 col-form-label">NISN</label>
                          <input value="{{ old('nisn') }}" type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" placeholder="Nomor Induk Siswa Nasional">
                          @error('nisn')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nik" class="col-sm-12 col-form-label">NIK (Nomor Induk Kependudukan)</label>
                          <input value="{{ old('nik') }}" type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="Nomor Induk Kependudukan" oninput="checkMaxLength(this)">
                          @error('nik')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="agama" class="col-sm-12 col-form-label">Agama <span class="text-danger">*</span></label>
                          <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required>
                            @foreach(['Islam', 'Kristen/Katolik', 'Hindu', 'Budha', 'Khonghucu', 'Lainnya'] as $agama)
                                <option value="{{ $agama }}" {{ old('agama', $pendaftar_online->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                          </select>                        
                          @error('agama')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="kewarganegaraan" class="col-sm-12 col-form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                            <select name="kewarganegaraan" class="custom-select" required>
                              <option value="" {{ old('kewarganegaraan', $pendaftar_online->kewarganegaraan) == '' ? 'selected' : '' }}>Pilih Kewarganegaraan</option>
                              <option value="wni" {{ in_array(old('kewarganegaraan', $pendaftar_online->kewarganegaraan), ['wni', 'WNI']) ? 'selected' : '' }}>Warga Negara Indonesia (WNI)</option>
                              <option value="wna" {{ in_array(old('kewarganegaraan', $pendaftar_online->kewarganegaraan), ['wna', 'WNA']) ? 'selected' : '' }}>Warga Negara Asing (WNA)</option>                                                            
                            </select>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror             
                        </div> 
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group"> 
                          <label for="pend_akhir" class="col-sm-12 col-form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                          <select name="pend_akhir" class="form-control @error('pend_akhir') is-invalid @enderror" required>
                            @foreach(['' => 'Pilih Pendidikan Terakhir', 'tidak sekolah' => 'Tidak Sekolah', 'sd' => 'SD', 'smp' => 'SMP', 'SLTA' => 'SLTA', 'd3' => 'D3', 'S1' => 'D4/S1', 's2' => 'S2', 's3' => 'S3'] as $value => $label)
                              <option value="{{ $value }}" {{ old('pend_akhir', $pendaftar_online->pend_akhir) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                          </select>
                          @error('pend_akhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror             
                        </div>
                      </div>
                      <div class="col-sm-3">  
                        <div class="form-group">
                          <label for="email" class="col-sm-12 col-form-label">Email</label>
                            <input value="{{ old('email') }}" type="email" autocomplete="off" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
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
                            <input value="{{ old('no_hp', $pendaftar_online->no_hp) }}" type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomor HP Aktif">
                            @error('no_hp')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="status_pekerjaan" class="col-sm-12 col-form-label">Pekerjaan <span class="text-danger">*</span></label>
                          <select name="status_pekerjaan" id="status_pekerjaan" class="form-control @error('status_pekerjaan') is-invalid @enderror" required>
                            <option value="" {{ old('status_pekerjaan', $pendaftar_online->status_pekerjaan) == '' ? 'selected' : '' }}>Pilih Pekerjaan</option>
                            @foreach(['pelajar', 'mahasiswa', 'tidak bekerja', 'nelayan', 'petani', 'peternak', 'pns/tni/polri', 'guru', 'karyawan swasta', 'pedagang/wiraswasta', 'buruh', 'pensiunan', 'lainnya'] as $option)
                              <option value="{{ $option }}" {{ old('status_pekerjaan', $pendaftar_online->status_pekerjaan) == $option ? 'selected' : '' }}>{{ ucwords($option) }}</option>
                            @endforeach
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
                          <label for="tgl_masuk" class="col-sm-12 col-form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                            <input value="{{ old('tgl_masuk', $pendaftar_online->tgl_daftar) }}" readonly type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" placeholder="Tanggal Lahir">
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
                      <button type="button" class="btn btn-info float-right" id="nextalamat">Selanjutnya</button>
                      <a href="{{ route('pendaftar-online.index') }}"><button type="button" class="btn btn-light float-left" id="nextalamat">Batal</button></a>
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="alamat" class="col-sm-12 col-form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                          <input value="{{ old('alamat', ucwords($pendaftar_online->alamat)) }}" autofocus required type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Lengkap">
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
                          <input value="{{ old('rt') }}" type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt" placeholder="RT">
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
                          <input value="{{ old('rw') }}" type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw" placeholder="RW">
                          @error('rw')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="kel" class="col-sm-12 col-form-label">Desa / Kelurahan</label>
                          <input value="{{ old('kel') }}" type="text" name="kel" class="form-control @error('kel') is-invalid @enderror" id="kel" placeholder="Desa/Kelurahan">
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
                          <label for="kec" class="col-sm-12 col-form-label">Kecamatan</label>
                          <input value="{{ old('kec') }}" type="text" name="kec" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan">
                          @error('kec')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="kd_pos" class="col-sm-12 col-form-label">Kode Pos </label>
                          <input value="{{ old('kd_pos') }}" type="text" name="kd_pos" class="form-control @error('kd_pos') is-invalid @enderror" id="kd_pos" placeholder="Kode Pos">
                          @error('kd_pos')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="kab" class="col-sm-12 col-form-label">Kabupaten / Kota <span class="text-danger">*</span></label>
                          <input value="{{ old('kab') }}" type="text" name="kab" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten/Kota">
                          @error('kab')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                            <label for="provinsi" class="col-sm-12 col-form-label">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control @error('provinsi') is-invalid @enderror">
                              @php
                                  $provinces = [
                                      '' => 'Pilih Provinsi',
                                      'Aceh' => 'Aceh',
                                      'Sumatera Utara' => 'Sumatera Utara',
                                      'Sumatera Barat' => 'Sumatera Barat',
                                      'Riau' => 'Riau',
                                      'Jambi' => 'Jambi',
                                      'Sumatera Selatan' => 'Sumatera Selatan',
                                      'Bengkulu' => 'Bengkulu',
                                      'Lampung' => 'Lampung',
                                      'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung',
                                      'Kepulauan Riau' => 'Kepulauan Riau',
                                      'DKI Jakarta' => 'DKI Jakarta',
                                      'Jawa Barat' => 'Jawa Barat',
                                      'Jawa Tengah' => 'Jawa Tengah',
                                      'DI Yogyakarta' => 'DI Yogyakarta',
                                      'Jawa Timur' => 'Jawa Timur',
                                      'Banten' => 'Banten',
                                      'Bali' => 'Bali',
                                      'Nusa Tenggara Barat' => 'Nusa Tenggara Barat',
                                      'Nusa Tenggara Timur' => 'Nusa Tenggara Timur',
                                      'Kalimantan Barat' => 'Kalimantan Barat',
                                      'Kalimantan Tengah' => 'Kalimantan Tengah',
                                      'Kalimantan Selatan' => 'Kalimantan Selatan',
                                      'Kalimantan Timur' => 'Kalimantan Timur',
                                      'Kalimantan Utara' => 'Kalimantan Utara',
                                      'Sulawesi Utara' => 'Sulawesi Utara',
                                      'Sulawesi Tengah' => 'Sulawesi Tengah',
                                      'Sulawesi Selatan' => 'Sulawesi Selatan',
                                      'Sulawesi Tenggara' => 'Sulawesi Tenggara',
                                      'Gorontalo' => 'Gorontalo',
                                      'Sulawesi Barat' => 'Sulawesi Barat',
                                      'Maluku' => 'Maluku',
                                      'Maluku Utara' => 'Maluku Utara',
                                      'Papua Barat' => 'Papua Barat',
                                      'Papua' => 'Papua',
                                      'Papua Tengah' => 'Papua Tengah',
                                      'Papua Pegunungan' => 'Papua Pegunungan',
                                      'Papua Selatan' => 'Papua Selatan'
                                  ];
                              @endphp
                              @foreach($provinces as $value => $label)
                                  <option value="{{ $value }}" {{ old('provinsi', $pendaftar_online->provinsi) == $value ? 'selected' : '' }}>{{ $label }}</option>
                              @endforeach
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
                            <label for="jns_tinggal" class="col-sm-12 col-form-label">Jenis Tinggal</label>
                            <select name="jns_tinggal" id="jns_tinggal" class="form-control @error('jns_tinggal') is-invalid @enderror">
                              @php
                                  $jenisTinggal = [
                                      '' => 'Pilih Jenis Tinggal',
                                      'rumah_sendiri' => 'Rumah Sendiri',
                                      'kos' => 'Kos',
                                      'kontrak' => 'Kontrak',
                                      'bersama_orang_tua' => 'Bersama Orang Tua',
                                      'bersama_wali' => 'Bersama Wali',
                                      'lainnya' => 'Lainnya'
                                  ];
                              @endphp
                              @foreach($jenisTinggal as $value => $label)
                                  <option value="{{ $value }}" {{ old('jns_tinggal', $pendaftar_online->jns_tinggal) == $value ? 'selected' : '' }}>{{ $label }}</option>
                              @endforeach
                            </select>
                            @error('jns_tinggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="button" class="btn btn-info float-right" id="nextkeluarga">Selanjutnya</button>
                      <button type="button" class="btn btn-secondary float-left" id="nexthome">Kembali</button>
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nm_ayah" class="col-sm-12 col-form-label">Nama Ayah</label>
                          <input value="{{ old('nm_ayah', ucwords($pendaftar_online->nm_ortu)) }}" type="text" name="nm_ayah" class="form-control @error('nm_ayah') is-invalid @enderror" id="nm_ayah" placeholder="Nama Ayah">
                          @error('nm_ayah')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nik_ayah" class="col-sm-12 col-form-label">NIK Ayah</label>
                          <input value="{{ old('nik_ayah') }}" type="text" name="nik_ayah" class="form-control @error('nik_ayah') is-invalid @enderror" id="nik_ayah" placeholder="Nomor Induk Kependudukan" oninput="checkMaxLength(this)">
                          @error('nik_ayah')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tgl_ayah" class="col-sm-12 col-form-label">Tanggal Lahir Ayah</label>
                          <input value="{{ old('tgl_ayah') }}" type="date" name="tgl_ayah" class="form-control @error('tgl_ayah') is-invalid @enderror" id="tgl_ayah">
                          @error('tgl_ayah')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group"> 
                          <label for="pend_ayah" class="col-sm-12 col-form-label">Pendidikan Ayah</label>
                          <select name="pend_ayah" class="form-control @error('pend_ayah') is-invalid @enderror">
                            @php
                                $pendidikanAyah = [
                                    '' => 'Pilih Pendidikan Terakhir',
                                    'tidak sekolah' => 'Tidak Sekolah',
                                    'sd' => 'SD',
                                    'smp' => 'SMP',
                                    'SLTA' => 'SLTA',
                                    'd3' => 'D3',
                                    'd4/s1' => 'D4/S1',
                                    's2' => 'S2',
                                    's3' => 'S3'
                                ];
                            @endphp
                            @foreach($pendidikanAyah as $value => $label)
                                <option value="{{ $value }}" {{ old('pend_ayah', $pendaftar_online->pend_ayah) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
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
                          <label for="pek_ayah" class="col-sm-12 col-form-label">Pekerjaan Ayah</label>
                          <select name="pek_ayah" id="pek_ayah" class="form-control @error('pek_ayah') is-invalid @enderror" required>
                            <option value="" {{ old('pek_ayah', $pendaftar_online->pek_ortu) == '' ? 'selected' : '' }}>Pilih Pekerjaan</option>
                            @foreach(['pelajar', 'mahasiswa', 'tidak bekerja', 'nelayan', 'petani', 'peternak', 'pns/tni/polri', 'guru', 'karyawan swasta', 'pedagang/wiraswasta', 'buruh', 'pensiunan', 'lainnya'] as $option)
                              <option value="{{ $option }}" {{ old('pek_ayah', $pendaftar_online->pek_ortu) == $option ? 'selected' : '' }}>{{ ucwords($option) }}</option>
                            @endforeach
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
                          <label for="nm_ibu" class="col-sm-12 col-form-label">Nama Ibu</label>
                          <input value="{{ old('nm_ibu') }}" autofocus type="text" name="nm_ibu" class="form-control @error('nm_ibu') is-invalid @enderror" id="nm_ibu" placeholder="Nama Ibu">
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
                          <input value="{{ old('nik_ibu') }}" type="text" name="nik_ibu" class="form-control @error('nik_ibu') is-invalid @enderror" id="nik_ibu" placeholder="Nomor Induk Kependudukan" oninput="checkMaxLength(this)">
                          @error('nik_ibu')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tgl_ibu" class="col-sm-12 col-form-label">Tanggal Lahir Ibu</label>
                          <input value="{{ old('tgl_ibu') }}" type="date" name="tgl_ibu" class="form-control @error('tgl_ibu') is-invalid @enderror" id="tgl_ibu">
                          @error('tgl_ibu')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group"> 
                          <label for="pend_ibu" class="col-sm-12 col-form-label">Pendidikan Ibu</label>
                          <select name="pend_ibu" class="form-control @error('pend_ibu') is-invalid @enderror">
                            @php
                                $pendidikanIbu = [
                                    '' => 'Pilih Pendidikan Terakhir',
                                    'tidak sekolah' => 'Tidak Sekolah',
                                    'sd' => 'SD',
                                    'smp' => 'SMP',
                                    'SLTA' => 'SLTA',
                                    'd3' => 'D3',
                                    'd4/s1' => 'D4/S1',
                                    's2' => 'S2',
                                    's3' => 'S3'
                                ];
                            @endphp
                            @foreach($pendidikanIbu as $value => $label)
                                <option value="{{ $value }}" {{ old('pend_ibu', $pendaftar_online->pend_ibu) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                          </select>
                            @error('pend_ibu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group">
                          <label for="pek_ibu" class="col-sm-12 col-form-label">Pekerjaan Ibu</label>
                          <select name="pek_ibu" id="pek_ibu" class="form-control @error('pek_ibu') is-invalid @enderror">
                            @php
                                $pekerjaanIbu = [
                                    '' => 'Pilih Pekerjaan',
                                    'tidak bekerja' => 'Tidak Bekerja',
                                    'nelayan' => 'Nelayan',
                                    'petani' => 'Petani',
                                    'peternak' => 'Peternak',
                                    'pns/tni/polri' => 'PNS/TNI/Polri',
                                    'guru' => 'Guru',
                                    'karyawan swasta' => 'Karyawan Swasta',
                                    'pedagang/wiraswasta' => 'Pedagang/Wiraswasta',
                                    'buruh' => 'Buruh',
                                    'pensiunan' => 'Pensiunan',
                                    'lainnya' => 'Lainnya'
                                ];
                            @endphp
                            @foreach($pekerjaanIbu as $value => $label)
                                <option value="{{ $value }}" {{ old('pek_ibu', $pendaftar_online->pek_ibu) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
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
                          <label for="alamat_ortu" class="col-sm-12 col-form-label">Alamat Orang Tua</label>
                          <input value="{{ old('alamat_ortu', ucwords($pendaftar_online->alamat_ortu)) }}" autofocus type="text" name="alamat_ortu" class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" placeholder="Alamat Lengkap" >
                          @error('alamat_ortu')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="hp_ortu" class="col-sm-12 col-form-label">HP Orang Tua</label>
                          <input value="{{ old('hp_ortu') }}" autofocus type="text" name="hp_ortu" class="form-control @error('hp_ortu') is-invalid @enderror" id="hp_ortu" placeholder="HP Orang Tua" >
                          @error('hp_ortu')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="telepon_ortu" class="col-sm-12 col-form-label">Telepon Orang Tua</label>
                          <input value="{{ old('telepon_ortu') }}" autofocus type="text" name="telepon_ortu" class="form-control @error('telepon_ortu') is-invalid @enderror" id="telepon_ortu" placeholder="Telepon" >
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
                          <input value="{{ old('anak_ke') }}" autofocus type="text" name="anak_ke" class="form-control @error('anak_ke') is-invalid @enderror" id="anak_ke" placeholder="Anak ke" >
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
                      <button type="button" class="btn btn-info float-right" id="nextwali">Selanjutnya</button>
                      <button type="button" class="btn btn-secondary float-left" id="prevalamat">Kembali</button>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nm_wali" class="col-sm-12 col-form-label">Nama Wali</label>
                          <input value="{{ old('nm_wali') }}" type="text" name="nm_wali" class="form-control @error('nm_wali') is-invalid @enderror" id="nm_wali" placeholder="Nama Wali">
                          @error('nm_wali')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="nik_wali" class="col-sm-12 col-form-label">NIK Wali</label>
                          <input value="{{ old('nik_wali') }}" type="text" name="nik_wali" class="form-control @error('nik_wali') is-invalid @enderror" id="nik_wali" placeholder="Nomor Induk Kependudukan" oninput="checkMaxLength(this)">
                          @error('nik_wali')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tgl_wali" class="col-sm-12 col-form-label">Tanggal Lahir Wali</label>
                          <input value="{{ old('tgl_wali') }}" type="date" name="tgl_wali" class="form-control @error('tgl_wali') is-invalid @enderror" id="tgl_wali">
                          @error('tgl_wali')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group"> 
                          <label for="pend_wali" class="col-sm-12 col-form-label">Pendidikan Wali</label>
                          <select name="pend_wali" class="form-control @error('pend_wali') is-invalid @enderror">
                            @php
                                $pendidikanWali = [
                                    '' => 'Pilih Pendidikan Terakhir',
                                    'tidak sekolah' => 'Tidak Sekolah',
                                    'sd' => 'SD',
                                    'smp' => 'SMP',
                                    'SLTA' => 'SLTA',
                                    'd3' => 'D3',
                                    'd4/s1' => 'D4/S1',
                                    's2' => 'S2',
                                    's3' => 'S3'
                                ];
                            @endphp
                            @foreach($pendidikanWali as $value => $label)
                                <option value="{{ $value }}" {{ old('pend_wali', $pendaftar_online->pend_wali) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                          </select>
                            @error('pend_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror             
                        </div>
                      </div>
                      <div class="col-sm-3"> 
                        <div class="form-group">
                          <label for="pek_wali" class="col-sm-12 col-form-label">Pekerjaan Wali</label>
                          <select name="pek_wali" id="pek_wali" class="form-control @error('pek_wali') is-invalid @enderror">
                            @php
                                $pekerjaanWali = [
                                    '' => 'Pilih Pekerjaan',
                                    'tidak bekerja' => 'Tidak Bekerja',
                                    'nelayan' => 'Nelayan',
                                    'petani' => 'Petani',
                                    'peternak' => 'Peternak',
                                    'pns/tni/polri' => 'PNS/TNI/Polri',
                                    'guru' => 'Guru',
                                    'karyawan swasta' => 'Karyawan Swasta',
                                    'pedagang/wiraswasta' => 'Pedagang/Wiraswasta',
                                    'buruh' => 'Buruh',
                                    'pensiunan' => 'Pensiunan',
                                    'lainnya' => 'Lainnya'
                                ];
                            @endphp
                            @foreach($pekerjaanWali as $value => $label)
                                <option value="{{ $value }}" {{ old('pek_wali', $pendaftar_online->pek_wali) == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
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
                          <label for="alamat_wali" class="col-sm-12 col-form-label">Alamat Wali</label>
                          <input value="{{ old('alamat_wali') }}" type="text" name="alamat_wali" class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" placeholder="Alamat Lengkap">
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
                          <input value="{{ old('hp_wali') }}" type="text" name="hp_wali" class="form-control @error('hp_wali') is-invalid @enderror" id="hp_wali" placeholder="HP Wali">
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
                      <button type="button" class="btn btn-secondary float-left" id="prevkeluarga">Kembali</button>
                      <button type="submit" class="btn btn-success float-right">Daftar</button>
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
 