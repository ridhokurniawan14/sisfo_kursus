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
                            <h3 class="card-title">Silahkan Masukkan Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/admin/program-pilihan/{{ $cari->id }}">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="program">Program Baru <span class="text-danger">*</span></label>
                                    <input autofocus autocomplete="off"
                                        value="{{ old('program', ucwords($cari->program)) }}" required type="text"
                                        name="program" class="form-control @error('program') is-invalid @enderror"
                                        id="program" placeholder="Masukkan Program">
                                    @error('program')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="harga">Biaya Kursus <span class="text-danger">*</span></label>
                                    <input autocomplete="off" value="{{ old('harga', $cari->harga) }}" required
                                        type="text" name="harga"
                                        class="form-control @error('harga') is-invalid @enderror" id="harga"
                                        placeholder="Masukkan biaya kursus" onkeyup="formatRupiah(this)">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="/admin/program-pilihan"><button type="button"
                                        class="btn btn-secondary">Kembali</button></a>
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
                                        <th>Program Komputer</th>
                                        <th>Biaya</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($data->program) }}</td>
                                            <td>Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                                            <td>
                                                <a href="/jam/{{ $data->id }}/edit" class="badge bg-warning"><span
                                                        class="fas fa-pen"></span></a>
                                                <button class="badge bg-danger border-0" data-toggle="modal"
                                                    data-target="#modal-delete{{ $data->id }}"><span
                                                        class="fas fa-trash"></span></button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-delete{{ $data->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah yakin Program <b>{{ ucwords($data->program) }}</b>
                                                            dihapus?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form
                                                            action="{{ route('program-pilihan.destroy', ['program_pilihan' => $data->id]) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="button" class="btn btn-default ml-auto"
                                                                data-dismiss="modal">Close</button>
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
                                        <th>No</th>
                                        <th>Program Komputer</th>
                                        <th>Biaya</th>
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
