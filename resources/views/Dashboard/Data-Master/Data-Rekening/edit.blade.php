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
                        <form method="POST" action="/admin/data-rekening/{{ $cari->id }}">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nm_bank" class="col-sm-12 col-form-label">Bank <span
                                            class="text-danger">*</span></label>
                                    <select autofocus name="nm_bank" class="custom-select" required>
                                        <option value="" {{ old('nm_bank') ? '' : 'selected' }}>Pilih Bank</option>
                                        <option value="bca"
                                            {{ old('nm_bank', $cari->nm_bank) == 'bca' ? 'selected' : '' }}>BCA</option>
                                        <option value="bri"
                                            {{ old('nm_bank', $cari->nm_bank) == 'bri' ? 'selected' : '' }}>BRI</option>
                                        <option value="bni"
                                            {{ old('nm_bank', $cari->nm_bank) == 'bni' ? 'selected' : '' }}>BNI</option>
                                        <option value="mandiri"
                                            {{ old('nm_bank', $cari->nm_bank) == 'mandiri' ? 'selected' : '' }}>Mandiri
                                        </option>
                                        <option value="btn"
                                            {{ old('nm_bank', $cari->nm_bank) == 'btn' ? 'selected' : '' }}>BTN</option>
                                        <option value="cimb"
                                            {{ old('nm_bank', $cari->nm_bank) == 'cimb' ? 'selected' : '' }}>CIMB</option>
                                        <option value="danamon"
                                            {{ old('nm_bank', $cari->nm_bank) == 'danamon' ? 'selected' : '' }}>Danamon
                                        </option>
                                        <option value="panin"
                                            {{ old('nm_bank', $cari->nm_bank) == 'panin' ? 'selected' : '' }}>Panin</option>
                                        <option value="permata"
                                            {{ old('nm_bank', $cari->nm_bank) == 'permata' ? 'selected' : '' }}>Permata
                                        </option>
                                        <option value="mega"
                                            {{ old('nm_bank', $cari->nm_bank) == 'mega' ? 'selected' : '' }}>Mega</option>
                                        <option value="ovo"
                                            {{ old('nm_bank', $cari->nm_bank) == 'ovo' ? 'selected' : '' }}>OVO</option>
                                        <option value="dana"
                                            {{ old('nm_bank', $cari->nm_bank) == 'dana' ? 'selected' : '' }}>DANA</option>
                                    </select>
                                    @error('nm_bank')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nm_rekening">Nama Rekening <span class="text-danger">*</span></label>
                                    <input autocomplete="off" value="{{ old('nm_rekening', ucwords($cari->nm_rekening)) }}"
                                        required type="text" name="nm_rekening"
                                        class="form-control @error('nm_rekening') is-invalid @enderror" id="nm_rekening"
                                        placeholder="Nama Rekening atas nama">
                                    @error('nm_rekening')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_rek">No. Rekening <span class="text-danger">*</span></label>
                                    <input autocomplete="off" value="{{ old('no_rek', $cari->no_rek) }}" required
                                        type="number" name="no_rek"
                                        class="form-control @error('no_rek') is-invalid @enderror" id="no_rek"
                                        placeholder="Masukkan No. Rekening">
                                    @error('no_rek')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="/admin/data-rekening"><button type="button"
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
                                        <th>Bank</th>
                                        <th>Nama Rekening</th>
                                        <th>No. Rek</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($data->nm_bank) }}</td>
                                            <td>{{ ucwords($data->nm_rekening) }}</td>
                                            <td>{{ $data->no_rek }}</td>
                                            <td>
                                                <a href="/admin/data-rekening/{{ $data->id }}/edit"
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
                                                        <p>Apakah yakin Data Rekening a.n.
                                                            <b>{{ ucwords($data->nm_rekening) }}</b> dihapus?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <form
                                                            action="{{ route('data-rekening.destroy', ['data_rekening' => $data->id]) }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="button" class="btn btn-default ml-auto"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Yakin</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Bank</th>
                                        <th>Nama Rekening</th>
                                        <th>No. Rek</th>
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
