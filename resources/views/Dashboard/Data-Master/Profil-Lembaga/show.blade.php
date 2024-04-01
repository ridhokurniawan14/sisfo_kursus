@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Silahkan Masukkan Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#">
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="nm_lembaga">Nama Lembaga<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('nm_lembaga', (strtoupper($data->nm_lembaga))) }}" readonly type="text" name="nm_lembaga" class="form-control @error('nm_lembaga') is-invalid @enderror" id="nm_lembaga" placeholder="Nama Lembaga">
                              @error('nm_lembaga')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="npsn">NPSN<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('npsn', (strtoupper($data->npsn))) }}" readonly type="text" name="npsn" class="form-control @error('npsn') is-invalid @enderror" id="npsn" placeholder="NPSN">
                              @error('npsn')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="bentuk">Bentuk Lembaga<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('bentuk', (ucwords($data->bentuk))) }}" readonly type="text" name="bentuk" class="form-control @error('bentuk') is-invalid @enderror" id="bentuk" placeholder="bentuk">
                          @error('bentuk')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="sts_lembaga">Status Lembaga<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('sts_lembaga', (ucwords($data->sts_lembaga))) }}" readonly type="text" name="sts_lembaga" class="form-control @error('sts_lembaga') is-invalid @enderror" id="sts_lembaga" placeholder="bentuk">
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
                            <input autocomplete="off" value="{{ old('sts', (ucwords($data->sts))) }}" readonly type="text" name="sts" class="form-control @error('sts') is-invalid @enderror" id="sts" placeholder="sts">
                            @error('sts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>                    
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="sk_izin">SK Izin<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('sk_izin', (ucwords($data->sk_izin))) }}" readonly type="text" name="sk_izin" class="form-control @error('sk_izin') is-invalid @enderror" id="sk_izin" placeholder="SK Izin">
                              @error('sk_izin')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="sk_pendirian">SK Pendirian<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('sk_pendirian', (ucwords($data->sk_pendirian))) }}" readonly type="text" name="sk_pendirian" class="form-control @error('sk_pendirian') is-invalid @enderror" id="sk_pendirian" placeholder="SK Pendirian">
                              @error('sk_pendirian')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="tgl_sk_pendirian">Tgl. SK Pendirian<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('tgl_sk_pendirian', (ucwords($data->tgl_sk_pendirian))) }}" readonly type="date" name="tgl_sk_pendirian" class="form-control @error('tgl_sk_pendirian') is-invalid @enderror" id="tgl_sk_pendirian" placeholder="">
                              @error('tgl_sk_pendirian')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="tgl_sk_izin">Tgl. SK Izin<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('tgl_sk_izin', (ucwords($data->tgl_sk_izin))) }}" readonly type="date" name="tgl_sk_izin" class="form-control @error('tgl_sk_izin') is-invalid @enderror" id="tgl_sk_izin" placeholder="">
                          @error('tgl_sk_izin')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                      </div>                    
                      <div class="col-sm-4">
                          <div class="form-group">
                              <label for="alamat">Alamat<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('alamat', (ucwords($data->alamat))) }}" readonly type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Lembaga">
                              @error('alamat')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-1">
                          <div class="form-group">
                              <label for="rt">RT<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('rt', (ucwords($data->rt))) }}" readonly type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" id="rt" placeholder="RT">
                              @error('rt')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-1">
                          <div class="form-group">
                              <label for="rw">RW<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('rw', (ucwords($data->rw))) }}" readonly type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" id="rw" placeholder="RW">
                              @error('rw')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="kel">Kelurahan<span class="text-danger"> *</span></label>
                              <input autocomplete="off" value="{{ old('kel', (ucwords($data->kel))) }}" readonly type="text" name="kel" class="form-control @error('kel') is-invalid @enderror" id="kel" placeholder="Kelurahan">
                              @error('kel')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="provinsi">Provinsi<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('provinsi', (ucwords($data->provinsi))) }}" readonly type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" placeholder="Provinsi">
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="kab">Kabupaten<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('kab', (ucwords($data->kab))) }}" readonly type="text" name="kab" class="form-control @error('kab') is-invalid @enderror" id="kab" placeholder="Kabupaten">
                          @error('kab')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="kec">Kecamatan<span class="text-danger"> *</span></label>
                        <input autocomplete="off" value="{{ old('kec', (ucwords($data->kec))) }}" readonly type="text" name="kec" class="form-control @error('kec') is-invalid @enderror" id="kec" placeholder="Kecamatan">
                        @error('kec')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="kd_pos">Kode Pos<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('kd_pos', (ucwords($data->kd_pos))) }}" readonly type="text" name="kd_pos" class="form-control @error('kd_pos') is-invalid @enderror" id="kd_pos" placeholder="Kode Pos">
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
                            <input autocomplete="off" value="{{ old('no_tel', (ucwords($data->no_tel))) }}" readonly type="text" name="no_tel" class="form-control @error('no_tel') is-invalid @enderror" id="no_tel" placeholder="No. Telepon">
                            @error('no_tel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="no_fax">No. Fax<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('no_fax', (ucwords($data->no_fax))) }}" readonly type="text" name="no_fax" class="form-control @error('no_fax') is-invalid @enderror" id="no_fax" placeholder="No. Fax">
                          @error('no_fax')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="email">Email Lembaga<span class="text-danger"> *</span></label>
                        <input autocomplete="off" value="{{ old('email', ($data->email)) }}" readonly type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email Lembaga">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="web">Website<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('web', ($data->web)) }}" readonly type="text" name="web" class="form-control @error('web') is-invalid @enderror" id="web" placeholder="Website">
                            @error('web')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="but_kus">Berkebutuhan Khusus<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('but_kus', ($data->but_kus)) }}" readonly type="text" name="but_kus" class="form-control @error('but_kus') is-invalid @enderror" id="but_kus" placeholder="Website">
                            @error('but_kus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="nm_bank">Nama Yayasan<span class="text-danger"> *</span></label>
                        <input autocomplete="off" value="{{ old('nm_yayasan', (ucwords($data->but_kus))) }}" readonly type="text" name="nm_yayasan" class="form-control @error('nm_yayasan') is-invalid @enderror" id="nm_yayasan" placeholder="Masukkan Nama Yayasan">
                        @error('nm_yayasan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>                    
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="nm_pajak">Nama Wajib Pajak<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('nm_pajak', (ucwords($data->nm_pajak))) }}" readonly type="text" name="nm_pajak" class="form-control @error('nm_pajak') is-invalid @enderror" id="nm_pajak" placeholder="Nama Wajib Pajak">
                          @error('nm_pajak')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="no_npwp">No. NPWP<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('no_npwp', (ucwords($data->no_npwp))) }}" readonly type="text" name="no_npwp" class="form-control @error('no_npwp') is-invalid @enderror" id="no_npwp" placeholder="No. NPWP">
                            @error('no_npwp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="nm_bank">Nama Bank<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('nm_bank', (strtoupper($data->nm_bank))) }}" readonly type="text" name="nm_bank" class="form-control @error('nm_bank') is-invalid @enderror" id="nm_bank" placeholder="Nama Bank">
                            @error('nm_bank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="bank_cabang">Bank Cabang<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('bank_cabang', (ucwords($data->bank_cabang))) }}" readonly type="text" name="bank_cabang" class="form-control @error('bank_cabang') is-invalid @enderror" id="bank_cabang" placeholder="Bank Cabang">
                            @error('bank_cabang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="nm_rekening">Nama Rekening<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('nm_rekening', (ucwords($data->nm_rekening))) }}" readonly type="text" name="nm_rekening" class="form-control @error('nm_rekening') is-invalid @enderror" id="nm_rekening" placeholder="Nama Rekening Lembaga">
                          @error('nm_rekening')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="luas_tanah">Luas Tanah<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('luas_tanah', (ucwords($data->luas_tanah))) }}" readonly type="text" name="luas_tanah" class="form-control @error('luas_tanah') is-invalid @enderror" id="luas_tanah" placeholder="Masukkan Luas Tanah">
                            @error('luas_tanah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="kat_lembaga">Kategori Lembaga<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('kat_lembaga', (ucwords($data->kat_lembaga))) }}" readonly type="text" name="kat_lembaga" class="form-control @error('kat_lembaga') is-invalid @enderror" id="kat_lembaga" placeholder="Masukkan Luas Tanah">
                            @error('kat_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                                                
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="ms_ijin">Masa Ijin<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('ms_ijin', (ucwords($data->ms_ijin))) }}" readonly type="date" name="ms_ijin" class="form-control @error('ms_ijin') is-invalid @enderror" id="ms_ijin" placeholder="Nama Bank">
                            @error('ms_ijin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="sumber_dana">Sumber Dana<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('sumber_dana', (ucwords($data->sumber_dana))) }}" readonly type="text" name="sumber_dana" class="form-control @error('sumber_dana') is-invalid @enderror" id="sumber_dana" placeholder="Sumber Dana">
                          @error('sumber_dana')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="no_sertifikat">No. Sertifikat<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('no_sertifikat', (ucwords($data->no_sertifikat))) }}" readonly type="text" name="no_sertifikat" class="form-control @error('no_sertifikat') is-invalid @enderror" id="no_sertifikat" placeholder="No. Sertifikat">
                            @error('no_sertifikat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="no_sk_akreditasi">No. SK Akreditasi<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('no_sk_akreditasi', (ucwords($data->no_sk_akreditasi))) }}" readonly type="text" name="no_sk_akreditasi" class="form-control @error('no_sk_akreditasi') is-invalid @enderror" id="no_sk_akreditasi" placeholder="No. SK Akreditasi">
                            @error('no_sk_akreditasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="mulai_berlaku">Mulai Berlaku<span class="text-danger"> *</span></label>
                          <input autocomplete="off" value="{{ old('mulai_berlaku', (ucwords($data->mulai_berlaku))) }}" readonly type="date" name="mulai_berlaku" class="form-control @error('mulai_berlaku') is-invalid @enderror" id="mulai_berlaku" placeholder="Sumber Dana">
                          @error('mulai_berlaku')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="ms_akreditasi">Masa Sertifikat<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('ms_akreditasi', (ucwords($data->ms_akreditasi))) }}" readonly type="date" name="ms_akreditasi" class="form-control @error('ms_akreditasi') is-invalid @enderror" id="ms_akreditasi" placeholder="">
                            @error('ms_akreditasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="hasil">Hasil Akreditasi<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('hasil', (ucwords($data->hasil))) }}" readonly type="text" name="hasil" class="form-control @error('hasil') is-invalid @enderror" id="hasil" placeholder="">
                            @error('hasil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                                                                        
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="penilai">Penilai<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('penilai', (ucwords($data->penilai))) }}" readonly type="text" name="penilai" class="form-control @error('penilai') is-invalid @enderror" id="penilai" placeholder="Nama Penilai">
                            @error('penilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="tgl_sertifikat">Tgl. Sertifikat<span class="text-danger"> *</span></label>
                            <input autocomplete="off" value="{{ old('tgl_sertifikat', (ucwords($data->tgl_sertifikat))) }}" readonly type="date" name="tgl_sertifikat" class="form-control @error('tgl_sertifikat') is-invalid @enderror" id="tgl_sertifikat" placeholder="Nama tgl_sertifikat">
                            @error('tgl_sertifikat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <!-- Tambahkan baris dan kolom sesuai dengan kebutuhan Anda -->
              </div>
              
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="/profil-lembaga/{{ $data->id }}/edit" class="btn btn-warning">
                        <i class="fas fa-edit"></i>Edit
                    </a>
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
@endsection
 