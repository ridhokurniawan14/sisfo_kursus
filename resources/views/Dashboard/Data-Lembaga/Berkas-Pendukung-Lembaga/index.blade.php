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
                        <form method="POST" action="/admin/berkas-akreditasi" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="nm_brk">Nama Berkas<span class="text-danger"> *</span></label>
                                            <input autofocus autocomplete="off" value="{{ old('nm_brk') }}" required
                                                type="text" name="nm_brk"
                                                class="form-control @error('nm_brk') is-invalid @enderror" id="nm_brk"
                                                placeholder="Misal : Silabus/RPP">
                                            @error('nm_brk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="thn">Tahun<span class="text-danger"> *</span></label>
                                            <select name="thn" class="form-control @error('thn') is-invalid @enderror"
                                                id="thn">
                                                <option value="">Pilih Tahun</option>
                                                @for ($year = date('Y'); $year >= 1990; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ old('thn') == $year ? 'selected' : '' }}>{{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('thn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nm_fl">Upload File<span class="text-danger"> *</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="nm_fl" type="file"
                                                        class="form-control @error('nm_fl') is-invalid @enderror"
                                                        id="nm_fl" onchange="previewPdf(this)">
                                                    <label class="input-group-text" for="nm_fl">Upload File</label>
                                                    @error('nm_fl')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pdfViewer" class="mt-3 col-sm-6 mx-auto d-block"></div>
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
                                        <th style="width: 30%;">Berkas</th>
                                        <th style="width: 30%;">Tahun</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($data->nm_brk) }}</td>
                                            <td>{{ ucwords($data->thn) }}</td>
                                            <td>
                                                @if ($data->nm_fl)
                                                    <a class="btn btn-info badge bg-info" data-toggle="modal"
                                                        data-target="#fotoModal{{ $data->id }}"><span
                                                            class="fas fa-eye"></span></a>
                                                @endif
                                                <div class="modal fade" id="fotoModal{{ $data->id }}" tabindex="-1"
                                                    aria-labelledby="fotoModalLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="fotoModalLabel{{ $data->id }}">
                                                                    {{ ucfirst($data->nm_brk) }}
                                                                    ({{ ucfirst($data->thn) }})</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <iframe src="{{ asset('storage/' . $data->nm_fl) }}"
                                                                    width="100%" height="500px"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="/admin/berkas-akreditasi/{{ $data->id }}/edit"
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
                                                        <p>Apakah yakin File <b>{{ ucwords($data->nm_brk) }}</b> dihapus?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form
                                                            action="{{ route('berkas-akreditasi.destroy', ['berkas_akreditasi' => $data->id]) }}"
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
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 30%;">Berkas</th>
                                        <th style="width: 30%;">Tahun</th>
                                        <th style="width: 10%;"></th>
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
