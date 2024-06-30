@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Silahkan Masukkan Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/admin/jam">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jam">Jam <span class="text-danger">*</span></label>
                                    <input autofocus autocomplete="off" value="{{ old('jam') }}" required type="text"
                                        name="jam" class="form-control @error('jam') is-invalid @enderror"
                                        id="jam" placeholder="Masukkan Jam (07.xx Pagi/Malam)">
                                    @error('jam')
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
                                        <th>Jam</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($data->jam) }}</td>
                                            <td>
                                                <a href="/admin/jam/{{ $data->id }}/edit" class="badge bg-warning"><span
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
                                                        <p>Apakah yakin Jam <b>{{ strtoupper($data->jam) }}</b> dihapus?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form action="{{ route('jam.destroy', ['jam' => $data->id]) }}"
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
                                        <th>Jam</th>
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
