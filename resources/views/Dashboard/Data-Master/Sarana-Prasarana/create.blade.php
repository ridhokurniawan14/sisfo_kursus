@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Silahkan Masukkan Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="/admin/sarana-prasarana" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="jenis" class="col-sm-12 col-form-label">Jenis
                                                Sarana/Prasarana<span class="text-danger">*</span></label>
                                            <select autofocus name="jenis" id="jenis"
                                                class="form-control @error('jenis') is-invalid @enderror" required>
                                                <option value="">Pilih Jenis</option>
                                                <option value="sarana" {{ old('jenis') == 'sarana' ? 'selected' : '' }}>
                                                    Sarana</option>
                                                <option value="prasarana"
                                                    {{ old('jenis') == 'prasarana' ? 'selected' : '' }}>Prasarana</option>
                                            </select>
                                            @error('jenis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="status" class="col-sm-12 col-form-label">Status Kepemilikan <span
                                                    class="text-danger">*</span></label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="">Pilih Status</option>
                                                <option value="milik" {{ old('status') == 'milik' ? 'selected' : '' }}>
                                                    Milik</option>
                                                <option value="sewa" {{ old('status') == 'sewa' ? 'selected' : '' }}>Sewa
                                                </option>
                                                <option value="pinjam" {{ old('status') == 'pinjam' ? 'selected' : '' }}>
                                                    Pinjam</option>
                                                <option value="bukan milik"
                                                    {{ old('status') == 'bukan milik' ? 'selected' : '' }}>Bukan Milik
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="nm_sarpras" class="col-sm-12 col-form-label">Nama Sarana/Prasarana
                                                <span class="text-danger">*</span></label>
                                            <input value="{{ old('nm_sarpras') }}" required type="text" name="nm_sarpras"
                                                class="form-control @error('nm_sarpras') is-invalid @enderror"
                                                autocomplete="off" id="nm_sarpras" placeholder="Masukkan Nama SarPras">
                                            @error('nm_sarpras')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="banyak" class="col-sm-12 col-form-label">Banyak <span
                                                    class="text-danger">*</span></label>
                                            <input value="{{ old('banyak') }}" required type="number" name="banyak"
                                                class="form-control @error('banyak') is-invalid @enderror" id="banyak"
                                                placeholder="Qty Barang">
                                            @error('banyak')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="ket" class="col-sm-12 col-form-label">Keterangan <span
                                                    class="text-danger">*</span></label>
                                            <select name="ket" id="ket"
                                                class="form-control @error('ket') is-invalid @enderror" required>
                                                <option value="">Pilih Keterangan</option>
                                                <option value="layak digunakan"
                                                    {{ old('ket') == 'layak digunakan' ? 'selected' : '' }}>Layak Digunakan
                                                </option>
                                                <option value="tidak layak digunakan"
                                                    {{ old('ket') == 'tidak layak digunakan' ? 'selected' : '' }}>Tidak
                                                    Layak Digunakan</option>
                                            </select>
                                            @error('ket')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info float-right">Save</button>
                                <button type="reset" class="btn btn-default float-right mr-2">Reset</button>
                                <a href="/admin/sarana-prasarana"><button type="button"
                                        class="btn btn-secondary">Back</button></a>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
