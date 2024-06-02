@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          
          @if ($datas->isEmpty())
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Silahkan Masukkan Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="/biaya-pendaftaran">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="biaya_daftar">Biaya Pendaftaran <span class="text-danger">*</span></label>
                    <input autofocus autocomplete="off" value="{{ old('biaya_daftar') }}" required type="text" name="biaya_daftar" class="form-control @error('biaya_daftar') is-invalid @enderror" id="biaya_daftar" placeholder="Masukkan Biaya Daftar" onkeyup="formatRupiah(this)">
                    @error('biaya_daftar')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
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
          @endif
          <!--/.col (left) -->
          <!-- right column -->
          @if ($datas->isEmpty())
            <div class="col-md-6">  
          @else
            <div class="col-md-12">  
          @endif
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
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($datas as $data)                   
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ strtoupper($data->biaya_daftar) }}</td>
                    {{-- <td>{{ strtoupper($data->created_at) }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('j F Y') }}</td>
                    <td>
                      <a href="/biaya-pendaftaran/{{ $data->id }}/edit" class="badge bg-warning"><span class="fas fa-pen"></span></a>
                    </td>
                  </tr>
                  @endforeach                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Biaya Pendaftaran</th>
                    <th>Tanggal Update</th>
                    <th></th>
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
 