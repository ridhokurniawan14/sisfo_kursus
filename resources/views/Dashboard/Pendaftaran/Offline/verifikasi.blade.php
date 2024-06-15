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
      <form method="POST" action="{{ route('pendaftaran.SaveVerifikasi', ['no_induk' => $no_induk]) }}" class="form-horizontal" enctype="multipart/form-data">
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
                            <input class="custom-control-input custom-control-input-danger" type="radio" value="paket" id="customRadio5" name="pil_prog" onclick="toggleProgram(this.value)">
                            <label for="customRadio5" class="custom-control-label">Paket</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio" value="pilihan" id="customRadio4" name="pil_prog" onclick="toggleProgram(this.value)">
                            <label for="customRadio4" class="custom-control-label">Pilihan</label>
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
                          <select autofocus name="kd_pilihan1" class="custom-select" id="kd_pilihan1" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan1') == $prog_pil->id ? 'selected' : '' }}>
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
                          <select name="kd_pilihan2" class="custom-select" id="kd_pilihan2" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan2') == $prog_pil->id ? 'selected' : '' }}>
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
                          <select name="kd_pilihan3" class="custom-select" id="kd_pilihan3" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan3') == $prog_pil->id ? 'selected' : '' }}>
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
                          <select name="kd_pilihan4" class="custom-select" id="kd_pilihan4" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan4') == $prog_pil->id ? 'selected' : '' }}>
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
                          <select name="kd_pilihan5" class="custom-select" id="kd_pilihan5" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan5') == $prog_pil->id ? 'selected' : '' }}>
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
                          <select name="kd_pilihan6" class="custom-select" id="kd_pilihan6" onchange="hitungBiaya()">
                            <option value="0">Pilih Program</option>
                            @foreach ($program_pilihan as $prog_pil)
                              <option data-price="{{ $prog_pil->harga }}" required value="{{ $prog_pil->id }}" {{ old('kd_pilihan6') == $prog_pil->id ? 'selected' : '' }}>
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
                        <label for="kd_paket" class="col-sm-12 col-form-label">Program Paket <span class="text-danger">*</span></label>
                        <select id="kd_paket" name="kd_paket" class="custom-select">
                          <option value="0">Pilih Program</option>
                          @foreach ($program_paket as $prog_pak)
                            <option data-price="{{ $prog_pak->harga }}" value="{{ $prog_pak->id }}" {{ old('kd_paket') == $prog_pak->id ? 'selected' : '' }}>
                              Paket {{ ucwords($prog_pak->kode) }} - (Rp. {{ number_format($prog_pak->harga) }})
                            </option>
                          @endforeach
                        </select>
                        @error('kd_paket')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan" class="col-sm-12 col-form-label">Program Tambahan 1</label>
                        <select id="kd_tambahan" name="kd_tambahan" class="custom-select">
                          <option value="0">Pilih Program</option>
                          @foreach ($program_pilihan as $prog_pil)
                            <option data-price="{{ $prog_pil->harga }}" value="{{ $prog_pil->id }}" {{ old('kd_tambahan') == $prog_pil->id ? 'selected' : '' }}>
                              {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})
                            </option>
                          @endforeach
                        </select>
                        @error('kd_tambahan')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan2" class="col-sm-12 col-form-label">Program Tambahan 2</label>
                        <select id="kd_tambahan2" name="kd_tambahan2" class="custom-select">
                          <option value="0">Pilih Program</option>
                          @foreach ($program_pilihan as $prog_pil)
                            <option data-price="{{ $prog_pil->harga }}" value="{{ $prog_pil->id }}" {{ old('kd_tambahan2') == $prog_pil->id ? 'selected' : '' }}>
                              {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})
                            </option>
                          @endforeach
                        </select>
                        @error('kd_tambahan2')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan3" class="col-sm-12 col-form-label">Program Tambahan 3</label>
                        <select id="kd_tambahan3" name="kd_tambahan3" class="custom-select">
                          <option value="0">Pilih Program</option>
                          @foreach ($program_pilihan as $prog_pil)
                            <option data-price="{{ $prog_pil->harga }}" value="{{ $prog_pil->id }}" {{ old('kd_tambahan3') == $prog_pil->id ? 'selected' : '' }}>
                              {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})
                            </option>
                          @endforeach
                        </select>
                        @error('kd_tambahan3')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2"> 
                      <div class="form-group">
                        <label for="kd_tambahan4" class="col-sm-12 col-form-label">Program Tambahan 4</label>
                        <select id="kd_tambahan4" name="kd_tambahan4" class="custom-select">
                          <option value="0">Pilih Program</option>
                          @foreach ($program_pilihan as $prog_pil)
                            <option data-price="{{ $prog_pil->harga }}" value="{{ $prog_pil->id }}" {{ old('kd_tambahan4') == $prog_pil->id ? 'selected' : '' }}>
                              {{ ucwords($prog_pil->program) }} - (Rp. {{ number_format($prog_pil->harga) }})
                            </option>
                          @endforeach
                        </select>
                        @error('kd_tambahan4')
                          <div class="invalid-feedback">{{ $message }}</div>
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
                      <input readonly type="text" required name="biaya_kursus" class="form-control form-control-sm" id="biaya_kursus" placeholder="Otomatis">
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
                      <input value="Rp. {{ number_format($biaya_daftar->biaya_daftar, 0, '', '.') }}" readonly required type="text" name="biaya_daftar" class="form-control form-control-sm @error('biaya_daftar') is-invalid @enderror" id="biaya_daftar" placeholder="Otomatis">
                      @error('biaya_daftar')
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
                      <input value="" required type="text" name="discount" class="form-control form-control-sm @error('discount') is-invalid @enderror" id="discount" placeholder="Isi Discount" onkeyup="formatRupiah(this); calculateKekurangan();">
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
                      <input value="0" required type="text" name="angsuran1" class="form-control form-control-sm @error('angsuran1') is-invalid @enderror" id="angsuran1" placeholder="Pembayaran Awal" onkeyup="formatRupiah(this); calculateKekurangan();">
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
                    <th style="width:60%;"><h4 style="text-align: right">Kekurangan</h4></th>
                    <td style="width: 5%">
                      <span id="kekuranganStatus" class="ml-2" style="display: none;">
                        <span class="right badge badge-success">LUNAS </span> <i class="fas fa-check-circle text-success"></i>
                      </span>
                    </td>
                    <td style="width:35%">
                      <input value="" readonly required type="text" name="kekurangan" class="form-control @error('kekurangan') is-invalid @enderror" id="kekurangan" placeholder="Otomatis" style="flex: 1;">
                      @error('kekurangan')
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
    <script>
      let angsuranCount = 1;
      const maxAngsuran = 5;
    
      document.getElementById('addAngsuranButton').addEventListener('click', function() {
        if (angsuranCount >= maxAngsuran) return;
    
        angsuranCount++;
    
        const tableBody = document.getElementById('angsuranTableBody');
        const newRow = document.createElement('tr');
        newRow.id = `angsuranRow${angsuranCount}`;
    
        newRow.innerHTML = `
          <td>${angsuranCount + 4}</td>
          <td>Angsuran ke ${angsuranCount} <span class="text-danger">*</span></td>
          <td>
            <input value="{{ old('tgl_angsuran${angsuranCount}') }}" required type="date" name="tgl_angsuran${angsuranCount}" class="form-control form-control-sm @error('tgl_angsuran${angsuranCount}') is-invalid @enderror" id="tgl_angsuran${angsuranCount}" placeholder="Tanggal Lahir">
            @error('tgl_angsuran${angsuranCount}')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </td>
          <td colspan="2">
            <input value="0" required type="text" name="angsuran${angsuranCount}" class="form-control form-control-sm @error('angsuran${angsuranCount}') is-invalid @enderror" id="angsuran${angsuranCount}" placeholder="Angsuran ke ${angsuranCount}" onkeyup="formatRupiah(this); calculateKekurangan();">
            @error('angsuran${angsuranCount}')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </td>
          <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeAngsuran(${angsuranCount})"><i class="fas fa-trash"></i></button>
          </td>
        `;
    
        tableBody.appendChild(newRow);
    
        if (angsuranCount === maxAngsuran) {
          document.getElementById('addAngsuranButton').style.display = 'none';
        }
      });
      function formatRupiah(input) {
            // Menghilangkan semua karakter kecuali angka
            var angka = input.value.replace(/[^0-9]/g, '');
            
            // Memisahkan angka menjadi grup-grup dengan titik setiap tiga digit
            var formattedAngka = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            // Memasukkan angka yang telah diformat kembali ke input
            input.value = formattedAngka;
        }
      function removeAngsuran(count) {
        const row = document.getElementById(`angsuranRow${count}`);
        if (row) {
          row.remove();
          angsuranCount--;
    
          if (angsuranCount < maxAngsuran) {
            document.getElementById('addAngsuranButton').style.display = 'block';
          }
    
          // Reorder the remaining rows
          reorderAngsuranRows();
        }
      }
    
      function reorderAngsuranRows() {
        const rows = document.querySelectorAll('#angsuranTableBody tr');
        let number = 5;
        rows.forEach((row, index) => {
          if (index >= 4) { // Start from the 5th row which is the first angsuran
            row.cells[0].innerText = number++;
            row.cells[1].innerHTML = `Angsuran ke ${index - 3} <span class="text-danger">*</span>`;
            row.id = `angsuranRow${index - 3}`;
            row.querySelector('input[type="date"]').name = `tgl_angsuran${index - 3}`;
            row.querySelector('input[type="text"]').name = `angsuran${index - 3}`;
            row.querySelector('button').setAttribute('onclick', `removeAngsuran(${index - 3})`);
          }
        });
      }
    
      function calculateTotalBiaya() {
        const biayaKursus = parseFloat(document.getElementById('biaya_kursus').value.replace(/[^\d]/g, '')) || 0;
        const biayaPendaftaran = parseFloat(document.getElementById('biaya_daftar').value.replace(/[^\d]/g, '')) || 0;
        const discount = parseFloat(document.getElementById('discount').value.replace(/[^\d]/g, '')) || 0;
        
        const totalBiaya = biayaKursus + biayaPendaftaran - discount;
        
        document.getElementById('tot_biaya').value = `Rp. ${totalBiaya.toLocaleString('id-ID')}`;
        calculateKekurangan();
      }
    
      function calculateKekurangan() {
        const totalBiaya = parseFloat(document.getElementById('tot_biaya').value.replace(/[^\d]/g, '')) || 0;
        let totalAngsuran = 0;
    
        for (let i = 1; i <= maxAngsuran; i++) {
          const angsuran = parseFloat(document.getElementById(`angsuran${i}`)?.value.replace(/[^\d]/g, '') || 0);
          totalAngsuran += angsuran;
        }
        
        const kekurangan = totalBiaya - totalAngsuran;
        
        document.getElementById('kekurangan').value = `Rp. ${kekurangan.toLocaleString('id-ID')}`;
        
        const kekuranganStatus = document.getElementById('kekuranganStatus');
        if (kekurangan <= 0) {
          kekuranganStatus.style.display = 'inline';
        } else {
          kekuranganStatus.style.display = 'none';
        }
      }
    
      // Pastikan memanggil calculateKekurangan setiap kali nilai angsuran diubah
      document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('discount').addEventListener('keyup', calculateTotalBiaya);
        document.querySelectorAll('input[name^="angsuran"]').forEach(input => {
          input.addEventListener('keyup', calculateKekurangan);
        });
      });
    
      document.addEventListener('DOMContentLoaded', function() {
      const programSelects = document.querySelectorAll('select');
      
      programSelects.forEach(select => {
        select.addEventListener('change', hitungBiaya);
      });
    
      function toggleProgram(value) {
        const programPaket = document.getElementById('program-paket');
        const programPilihan = document.getElementById('program-pilihan');
    
        if (value === 'paket') {
          programPaket.style.display = 'block';
          programPilihan.style.display = 'none';
        } else {
          programPaket.style.display = 'none';
          programPilihan.style.display = 'block';
        }
        
        hitungBiaya(); // Recalculate biaya when program type is toggled
      }
    
      function hitungBiaya() {
        const prices = [];
        const selectedRadio = document.querySelector('input[name="pil_prog"]:checked').value;
        
        let selects;
        if (selectedRadio === 'paket') {
          selects = document.querySelectorAll('#program-paket select');
        } else {
          selects = document.querySelectorAll('#program-pilihan select');
        }
        
        selects.forEach(select => {
          const selectedOption = select.options[select.selectedIndex];
          if (selectedOption && selectedOption.value !== 'Pilih Program') {
            const price = parseFloat(selectedOption.getAttribute('data-price'));
            if (!isNaN(price)) {
              prices.push(price);
            }
          }
        });
    
        const totalBiaya = prices.reduce((a, b) => a + b, 0);
        document.getElementById('biaya_kursus').value = `Rp. ${totalBiaya.toLocaleString('id-ID')}`;
      }
    });
    </script>
@endsection
