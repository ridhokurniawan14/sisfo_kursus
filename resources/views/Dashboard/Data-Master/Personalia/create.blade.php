@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Silahkan Masukkan Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/user" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="nik" class="col-sm-12 col-form-label">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                        <input value="{{ old('nik') }}" autofocus required type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik" placeholder="Nomor Induk Kependudukan" oninput="checkMaxLength(this)">
                        @error('nik')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="nm_lengkap" class="col-sm-12 col-form-label">Nama <span class="text-danger">*</span></label>
                        <input value="{{ old('nm_lengkap') }}" required type="text" name="nm_lengkap" class="form-control @error('nm_lengkap') is-invalid @enderror" id="nm_lengkap" placeholder="Nama Lengkap">
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
                        <input value="{{ old('tmp_lahir') }}" required type="text" name="tmp_lahir" class="form-control @error('tmp_lahir') is-invalid @enderror" id="tmp_lahir" placeholder="Tempat Lahir">
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
                        <input value="{{ old('tgl_lahir') }}" required type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" placeholder="Tanggal Lahir">
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
                          <option value="">Pilih Jenis Kelamin</option>
                          <option value="l" {{ old('gender') == 'l' ? 'selected' : '' }}>Laki-laki</option>
                          <option value="p" {{ old('gender') == 'p' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="agama" class="col-sm-12 col-form-label">Agama <span class="text-danger">*</span></label>
                        <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen/Katolik" {{ old('agama') == 'Kristen/Katolik' ? 'selected' : '' }}>Kristen/Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                            <option value="Khonghucu" {{ old('agama') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="status" class="col-sm-12 col-form-label">Status <span class="text-danger">*</span></label>
                          <select name="status" class="custom-select" required>
                              <option value="">Pilih Status</option>
                              <option value="nikah" {{ old('status') == 'nikah' ? 'selected' : '' }}>Nikah</option>
                              <option value="belum nikah" {{ old('status') == 'belum nikah' ? 'selected' : '' }}>Belum Nikah</option>
                          </select>
                          @error('status')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror             
                      </div> 
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="nm_ibu" class="col-sm-12 col-form-label">Nama Ibu Kandung</label>
                        <input value="{{ old('nm_ibu') }}" type="text" name="nm_ibu" class="form-control @error('nm_ibu') is-invalid @enderror" id="nm_ibu" placeholder="Nama Lengkap Ibu Kandung">
                        @error('nm_ibu')
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
                        <label for="alamat" class="col-sm-12 col-form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                          <input value="{{ old('alamat') }}" required type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Lengkap">
                          @error('alamat')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3"> 
                      <div class="form-group"> 
                        <label for="pend_akhir" class="col-sm-12 col-form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                          <select name="pend_akhir" class="form-control @error('pend_akhir') is-invalid @enderror" required>
                              <option value="">Pilih Pendidikan Terakhir</option>
                              <option value="SMA/SMK" {{ old('pend_akhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                              <option value="S1" {{ old('pend_akhir') == 'S1' ? 'selected' : '' }}>S1</option>
                              <option value="S2" {{ old('pend_akhir') == 'S2' ? 'selected' : '' }}>S2</option>
                              <option value="S3" {{ old('pend_akhir') == 'S3' ? 'selected' : '' }}>S3</option>
                          </select>
                          @error('pend_akhir')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror             
                      </div>
                    </div>
                    <div class="col-sm-3">  
                      <div class="form-group">
                        <label for="jurusan" class="col-sm-12 col-form-label">Jurusan/Program Studi <span class="text-danger">*</span></label>
                          <input value="{{ old('jurusan') }}" required type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" placeholder="Jurusan/Program Studi">
                          @error('jurusan')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">  
                      <div class="form-group">
                        <label for="email" class="col-sm-12 col-form-label">Email <span class="text-danger">*</span></label>
                          <input value="{{ old('email') }}" required type="email" autocomplete="off" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                          @error('email')
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
                        <label for="no_hp" class="col-sm-12 col-form-label">No. HP <span class="text-danger">*</span></label>
                          <input value="{{ old('no_hp') }}" required type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomor HP Aktif">
                          @error('no_hp')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3"> 
                      <div class="form-group">
                        <label for="posisi" class="col-sm-12 col-form-label">Akses <span class="text-danger">*</span></label>
                          <select autofocus name="posisi" class="custom-select">
                            <option>sebagai</option>
                            @foreach ($categories as $category)
                              <option required value="{{ $category->id }}" {{ old('posisi') == $category->id ? 'selected' : '' }}>
                                  {{ ucwords($category->hak_akses) }}</option>
                            @endforeach
                          </select>
                          @error('posisi')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3"> 
                      <div class="form-group">
                        <label for="tgl_masuk" class="col-sm-12 col-form-label">Tanggal Penugasan <span class="text-danger">*</span></label>
                          <input value="{{ old('tgl_masuk') }}" required type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror" id="tgl_masuk" placeholder="Tanggal Lahir">
                          @error('tgl_masuk')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3"> 
                      <div class="form-group">
                        <label for="username" class="col-sm-12 col-form-label">Username <span class="text-danger">*</span></label>
                        <input name="username" required type="username" value="{{ old('username') }}"  class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Massukkan username">
                        @error('username')
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
                        <label for="password" class="col-sm-12 col-form-label">Password <span class="text-danger">*</span></label>
                        <input name="password" required type="password" value="{{ old('password') }}"  class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Massukkan Password">
                        @error('password')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="form-group">
                        <label for="foto" class="col-sm-9 col-form-label">Foto Profile <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" onchange="previewImage('foto')">
                              <label class="input-group-text" for="foto">Pilih foto</label>
                              @error('foto')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror                        
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div id="fotoPreview" class="mt-8 col-sm-8 mx-auto d-block">
                          <img class="img-preview img-fluid mt-8 col-sm-8 mx-auto p-1 d-block" style="display: none;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Save</button>
                  <button type="reset" class="btn btn-default float-right mr-2">Reset</button>
                  <a href="/user/"><button type="button" class="btn btn-secondary">Back</button></a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
 