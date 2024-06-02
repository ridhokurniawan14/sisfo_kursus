@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">{{ $halaman }}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('biaya-pendaftaran.update', $cari->id) }}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="biaya_daftar">Biaya Pendaftaran <span class="text-danger">*</span></label>
                        <input autocomplete="off" autofocus value="{{ old('biaya_daftar', $cari->biaya_daftar) }}" required type="text" name="biaya_daftar" class="form-control @error('biaya_daftar') is-invalid @enderror" id="biaya_daftar" placeholder="Masukkan Biaya Daftar">
                        @error('biaya_daftar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <a href="{{ route('biaya-pendaftaran.index') }}"><button type="button" class="btn btn-secondary">Kembali</button></a>
                </div>
              </form>         
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
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
                    <th>No</th>
                    <th>Biaya Pendaftaran</th>
                    <th>Tanggal Update</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($datas as $data)                   
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($data->biaya_daftar) }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('j F Y') }}</td>
                  </tr>
                  @endforeach                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Biaya Pendaftaran</th>
                    <th>Tanggal Update</th>
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
