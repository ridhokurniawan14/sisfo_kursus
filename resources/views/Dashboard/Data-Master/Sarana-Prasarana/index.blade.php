@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    {{-- Data Tabel --}}
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="card-title">{{ $tab_title }}</h3>
                            <a href="/admin/sarana-prasarana/create" class="btn btn-primary ml-3 col-sm-2 float-right"><i
                                    class="fas fa-pen nav-icon mr-2"></i>Tambah SarPras</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Nama SarPras</th>
                                        <th>Banyak</th>
                                        <th>Ket.</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($data->jenis) }}</td>
                                            <td>{{ ucwords($data->status) }}</td>
                                            <td>{{ ucwords($data->nm_sarpras) }}</td>
                                            <td>{{ $data->banyak }}</td>
                                            <td>{{ ucwords($data->ket) }}</td>
                                            <td>
                                                <a href="/admin/sarana-prasarana/{{ $data->id }}/edit"
                                                    class="badge bg-warning"><span class="fas fa-pen"></span></a>
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
                                                        <p>Apakah yakin <b>{{ ucwords($data->nm_sarpras) }}</b> dihapus?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form
                                                            action="{{ route('sarana-prasarana.destroy', ['sarana_prasarana' => $data->id]) }}"
                                                            method="post" class="d-inline">
                                                            @method('DELETE')
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
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Nama SarPras</th>
                                        <th>Banyak</th>
                                        <th>Ket.</th>
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
