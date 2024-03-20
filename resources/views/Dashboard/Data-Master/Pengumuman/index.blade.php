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
              <form method="POST" action="/pengumuman" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="jenis">Jenis Pengumuman<span class="text-danger"> *</span></label>
                        <select autofocus name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror" required>
                          <option value="">Pilih Jenis</option>
                          <option value="pemberitahuan" {{ old('jenis') == 'pemberitahuan' ? 'selected' : '' }}>Pemberitahuan</option>
                          <option value="libur kursus" {{ old('jenis') == 'libur kursus' ? 'selected' : '' }}>Libur Kursus</option>
                          <option value="lowongan pekerjaan" {{ old('jenis') == 'lowongan pekerjaan' ? 'selected' : '' }}>Lowongan Pekerjaan</option>
                          <option value="lomba" {{ old('jenis') == 'lomba' ? 'selected' : '' }}>Lomba</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="judul">Judul Pengumuman<span class="text-danger"> *</span></label>
                        <input autocomplete="off" value="{{ old('judul') }}" required type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Misal : Libur Hari Raya">
                        @error('judul')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="ket">Ditujukan ke <span class="text-danger">*</span></label>
                        <select name="untuk" id="untuk" class="form-control @error('untuk') is-invalid @enderror" required>
                          <option value="">Pilih Tujuan</option>
                          <option value="semua" {{ old('untuk') == 'semua' ? 'selected' : '' }}>Semua</option>
                          <option value="peserta didik" {{ old('untuk') == 'peserta didik' ? 'selected' : '' }}>Peserta Didik</option>
                          <option value="pendidik" {{ old('untuk') == 'pendidik' ? 'selected' : '' }}>Pendidik</option>
                        </select>
                        @error('untuk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ket">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="ket" autocomplete="off" class="form-control @error('ket') is-invalid @enderror" rows="3" id="ket" placeholder="Masukkan Deskripsi Pengumuman secara detail (Hari, tgl. Jam dst.)" required>{{ old('ket') }}</textarea>
                    @error('ket')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group">
                        <label for="foto" class="col-sm-9 col-form-label">Flyer</label>
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
                    <div class="col-sm-5">
                      <div class="form-group">
                        <div id="fotoPreview" class="mt-12 col-sm-12 mx-auto d-block">
                          <img class="img-preview img-fluid mt-8 col-sm-8 mx-auto p-1 d-block" style="display: none;">
                        </div>
                      </div>
                    </div>
                  </div>
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
        <div class="row">
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-12">
            {{-- Data Tabel --}}
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $tab_title }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Jenis - For</th>
                    <th style="width: 15%;">Judul</th>
                    <th style="width: 45%;">Deskripsi</th>
                    <th style="width: 12%;">Pembuat</th>
                    <th style="width: 8%;"></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($datas as $data)                   
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucwords($data->jenis) }} - {{ ucwords($data->untuk) }}</td>
                    <td>{{ ucwords($data->judul) }}</td>
                    <td>{{ ucfirst($data->ket) }}</td>
                    <td>{{ ucwords($data->created_by) }}</td>
                    <td>
                      @if ($data->foto)
                          <a class="btn btn-info badge bg-info" data-toggle="modal" data-target="#fotoModal{{$data->id}}"><span class="fas fa-eye"></span></a>
                      @endif
                      <div class="modal fade" id="fotoModal{{$data->id}}" tabindex="-1" aria-labelledby="fotoModalLabel{{$data->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="fotoModalLabel{{$data->id}}">Flyer</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <img src="{{  asset('storage/' . $data->foto) }}" class="img-fluid" alt="Foto">
                            </div>
                          </div>
                        </div>
                      </div>                      
                      <a href="/pengumuman/{{ $data->id }}/edit" class="badge bg-warning"><span class="fas fa-pen"></span></a>
                      <button class="badge bg-danger border-0" data-toggle="modal" data-target="#modal-delete{{ $data->id }}"><span class="fas fa-trash"></span></button>
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-delete{{ $data->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah yakin Pengumuman tentang <b>{{ ucwords($data->judul) }}</b> dihapus?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <form action="{{ route('pengumuman.destroy', ['pengumuman' => $data->id]) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Yakin</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div> 
                  @endforeach                 
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="width: 5%;">No</th>
                      <th style="width: 15%;">Jenis - For</th>
                      <th style="width: 15%;">Judul</th>
                      <th style="width: 45%;">Deskripsi</th>
                      <th style="width: 12%;">Pembuat</th>
                      <th style="width: 8%;"></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>            
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
 