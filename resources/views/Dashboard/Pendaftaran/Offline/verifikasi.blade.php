@extends('layouts.main')

@section('container')
    <style>
      .table td, .table th {
          white-space: nowrap;
      }
      .table td:last-child, .table th:last-child {
          width: 1%;
      }
    </style>
    <!-- Main content -->
    <section class="content">
      <form method="POST" action="/user" class="form-horizontal" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Waktu dan Program</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                        <label for="no_induk" class="col-sm-12 col-form-label">NIS (Nomor Induk Siswa)</label>
                        <input value="{{ $pendaftar->no_induk }}" readonly required type="text" name="no_induk" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" placeholder="Nomor Induk Siswa">
                        @error('no_induk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="nm_lengkap" class="col-sm-12 col-form-label">Nama Lengkap</label>
                      <input value="{{ ucwords($pendaftar->nm_lengkap) }}" readonly required type="text" name="nm_lengkap" class="form-control @error('nm_lengkap') is-invalid @enderror" id="nm_lengkap" placeholder="Nama Lengkap">
                      @error('nm_lengkap')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-3"> 
                    <div class="form-group">
                      <label for="kd_jam" class="col-sm-12 col-form-label">Jam Kursus <span class="text-danger">*</span></label>
                        <select autofocus name="kd_jam" class="custom-select">
                          <option>Pilih Jam</option>
                          @foreach ($categories as $category)
                            <option required value="{{ $category->id }}" {{ old('kd_jam') == $category->id ? 'selected' : '' }}>
                                {{ ucwords($category->jam) }}</option>
                          @endforeach
                        </select>
                        @error('kd_jam')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                        <label for="pil_prog" class="col-sm-12 col-form-label">Program <span class="text-danger">*</span></label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio" value="pilihan" id="customRadio4" name="pil_prog" onclick="toggleProgram(this.value)">
                            <label for="customRadio4" class="custom-control-label">Pilihan</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio" value="paket" id="customRadio5" name="pil_prog" onclick="toggleProgram(this.value)">
                            <label for="customRadio5" class="custom-control-label">Paket</label>
                        </div>
                        @error('pil_prog')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                  </div>
                </div>
                <div id="program-pilihan" style="display:none;">
                  <div class="row">
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan1" class="col-sm-12 col-form-label">Program Pilihan 1<span class="text-danger">*</span></label>
                          <select autofocus name="kd_pilihan1" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan1') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan1')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan2" class="col-sm-12 col-form-label">Program Pilihan 2</label>
                          <select name="kd_pilihan2" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan2') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan2')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan3" class="col-sm-12 col-form-label">Program Pilihan 3</label>
                          <select name="kd_pilihan3" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan3') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan3')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan4" class="col-sm-12 col-form-label">Program Pilihan 4</label>
                          <select name="kd_pilihan4" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan4') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan4')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan5" class="col-sm-12 col-form-label">Program Pilihan 5</label>
                          <select name="kd_pilihan5" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan5') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan5')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_pilihan6" class="col-sm-12 col-form-label">Program Pilihan 6</label>
                          <select name="kd_pilihan6" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option required value="{{ $prog_pil->id }}" {{ old('kd_pilihan6') == $prog_pil->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_pilihan6')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                  </div>
                </div>
                <div id="program-paket" style="display:none;">
                  <div class="row">
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_paket" class="col-sm-12 col-form-label">Program Paket 1<span class="text-danger">*</span></label>
                          <select autofocus name="kd_paket" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_paket as $prog_pak)
                              <option required value="{{ $prog_pak->id }}" {{ old('kd_paket') == $prog_pak->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pak->program_pilihan) }} - (Rp. {{ number_format($prog_pak->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_paket')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan" class="col-sm-12 col-form-label">Program Tambahan 1</label>
                          <select autofocus name="kd_tambahan" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_paket as $prog_pak)
                              <option required value="{{ $prog_pak->id }}" {{ old('kd_tambahan') == $prog_pak->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pak->program_pilihan) }} - (Rp. {{ number_format($prog_pak->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_tambahan')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan2" class="col-sm-12 col-form-label">Program Tambahan 2</label>
                          <select name="kd_tambahan2" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_paket as $prog_pak)
                              <option required value="{{ $prog_pak->id }}" {{ old('kd_tambahan2') == $prog_pak->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pak->program_pilihan) }} - (Rp. {{ number_format($prog_pak->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_tambahan2')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan3" class="col-sm-12 col-form-label">Program Tambahan 3</label>
                          <select autofocus name="kd_tambahan3" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_paket as $prog_pak)
                              <option required value="{{ $prog_pak->id }}" {{ old('kd_tambahan3') == $prog_pak->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pak->program_pilihan) }} - (Rp. {{ number_format($prog_pak->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_tambahan3')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan4" class="col-sm-12 col-form-label">Program Tambahan 4</label>
                          <select autofocus name="kd_tambahan4" class="custom-select">
                            <option>Pilih Program</option>
                            @foreach ($program_paket as $prog_pak)
                              <option required value="{{ $prog_pak->id }}" {{ old('kd_tambahan4') == $prog_pak->id ? 'selected' : '' }}>
                                  {{ ucwords($prog_pak->program_pilihan) }} - (Rp. {{ number_format($prog_pak->harga) }})</option>
                            @endforeach
                          </select>
                          @error('kd_tambahan4')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-file-invoice-dollar nav-icon"></i> Biaya Kursus
                <small class="float-right">{{ \Carbon\Carbon::parse($pendaftar->tgl_masuk)->translatedFormat('d F Y') }}</small>
              </h4>
            </div>
            <!-- /.col -->
          </div>

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Deskripsi</th>
                            <th></th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="angsuranTableBody">
                        <tr>
                            <td>1</td>
                            <td>Biaya Kursus</td>
                            <td></td>
                            <td colspan="2">
                                <input value="" readonly required type="number" name="biaya_kursus" class="form-control form-control-sm @error('biaya_kursus') is-invalid @enderror" id="biaya_kursus" placeholder="Otomatis">
                                @error('biaya_kursus')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Biaya Pendaftaran</td>
                            <td></td>
                            <td colspan="2">
                                <input value="" readonly required type="text" name="biaya_pendaftaran" class="form-control form-control-sm @error('biaya_pendaftaran') is-invalid @enderror" id="biaya_pendaftaran" placeholder="Otomatis">
                                @error('biaya_pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Discount</td>
                            <td></td>
                            <td colspan="2">
                                <input value="0" required type="text" name="discount" class="form-control form-control-sm @error('discount') is-invalid @enderror" id="discount" placeholder="Isi Discount" onkeyup="formatRupiah(this)">
                                @error('discount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Total Biaya</td>
                            <td></td>
                            <td colspan="2">
                                <input value="" readonly required type="text" name="tot_biaya" class="form-control form-control-sm @error('tot_biaya') is-invalid @enderror" id="tot_biaya" placeholder="Otomatis">
                                @error('tot_biaya')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Angsuran ke 1 <span class="text-danger">*</span></td>
                            <td>
                                <input value="{{ $pendaftar->tgl_masuk }}" readonly required type="date" name="tgl_angsuran1" class="form-control form-control-sm @error('tgl_angsuran1') is-invalid @enderror" id="tgl_angsuran1" placeholder="Tanggal Lahir">
                                @error('tgl_angsuran1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                            <td colspan="2">
                                <input value="0" required type="text" name="angsuran1" class="form-control form-control-sm @error('angsuran1') is-invalid @enderror" id="angsuran1" placeholder="Pembayaran Awal" onkeyup="formatRupiah(this)">
                                @error('angsuran1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
            <div class="col-12">
              <button type="button" class="btn btn-primary float-right" id="addAngsuranButton">
                <i class="fas fa-plus"></i> Tambah Angsuran
              </button>
            </div>
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <p class="lead"></p>

              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%"><h4>Kekurangan</h4></th>
                    <td style="width: 50%">
                      <input value="" readonly required type="text" name="tot_biaya" class="form-control @error('tot_biaya') is-invalid @enderror" id="tot_biaya" placeholder="Otomatis">
                      @error('tot_biaya')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
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
              <button type="submit" class="btn btn-info float-right">Simpan</button>
              <button type="reset" class="btn btn-default float-right mr-2">Reset</button>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      </form>
    </section>
    <!-- /.content -->
@endsection
 