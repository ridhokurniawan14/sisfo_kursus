@extends('layouts.main')

@section('container')
    <style>
        .data-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .data-label {
            font-weight: bold;
        }

        .data-value {
            text-align: right;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Data Lembaga (Termasuk Logo) -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Data Profil Lembaga</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="#">
                            <div class="card-body">
                                <div id="accordion">
                                    <div class="row">
                                        <!-- Data Lembaga -->
                                        <div class="col-md-6">
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseLembaga">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">Data Lembaga</h4>
                                                    </div>
                                                </a>
                                                <div id="collapseLembaga" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <!-- Isi sesuai dengan data lembaga -->
                                                        <!-- Misalnya logo -->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Logo</div>
                                                            <div class="col-sm-8">
                                                                @if (!empty($data->logo))
                                                                    <img src="{{ asset('storage/' . $data->logo) }}"
                                                                        alt="Logo Lembaga" class="img-fluid">
                                                                @else
                                                                    <img src="{{ asset('img/unknown.png') }}"
                                                                        alt="Logo Default" class="img-fluid">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Nama Lembaga</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->nm_lembaga) ? strtoupper($data->nm_lembaga) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">NPSN</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->npsn) ? strtoupper($data->npsn) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Bentuk Lembaga</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->bentuk) ? ucwords($data->bentuk) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Status Lembaga</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->sts_lembaga) ? ucwords($data->sts_lembaga) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Status</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->sts) ? ucwords($data->sts) : '-' }}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Luas Tanah</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->luas_tanah) ? ucwords($data->luas_tanah) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Kategori Lembaga</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->kat_lembaga) ? ucwords($data->kat_lembaga) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Sumber Dana</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->sumber_dana) ? ucwords($data->sumber_dana) : '-' }}
                                                            </div>
                                                        </div>
                                                        <!-- Tambahkan sesuai dengan kebutuhan -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Data Alamat -->
                                        <div class="col-md-6">
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseAlamat">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">Data Alamat</h4>
                                                    </div>
                                                </a>
                                                <div id="collapseAlamat" class="collapse show" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <!-- Isi sesuai dengan data alamat -->
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Alamat</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->alamat) ? ucwords($data->alamat) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">RT</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->rt) ? strtoupper($data->rt) : '-' }}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">RW</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->rw) ? strtoupper($data->rw) : '-' }}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Provinsi</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->provinsi) ? ucwords($data->provinsi) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">No. Telepon</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->no_tel) ? ucwords($data->no_tel) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">No. Fax</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->no_fax) ? ucwords($data->no_fax) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Email Lembaga</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->email) ? $data->email : '-' }}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Website</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->web) ? $data->web : '-' }}</div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Nama Yayasan</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->nm_yayasan) ? ucwords($data->nm_yayasan) : '-' }}
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-4 font-weight-bold">Berkebutuhan Khusus</div>
                                                            <div class="col-sm-8">
                                                                {{ !empty($data->but_kus) ? $data->but_kus : '-' }}</div>
                                                        </div>
                                                        <!-- Tambahkan informasi alamat lainnya -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- Data Perizinan -->
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapsePerizinan">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Data Perizinan
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapsePerizinan" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">SK Izin</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->sk_izin) ? ucwords($data->sk_izin) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">SK Pendirian</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->sk_pendirian) ? ucwords($data->sk_pendirian) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Tgl. SK Pendirian</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->tgl_sk_pendirian) ? \Carbon\Carbon::parse($data->tgl_sk_pendirian)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Tgl. SK Izin</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->tgl_sk_izin) ? \Carbon\Carbon::parse($data->tgl_sk_izin)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Masa Ijin</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->ms_ijin) ? \Carbon\Carbon::parse($data->ms_ijin)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- Data Bank -->
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseBank">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Data Bank
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseBank" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Nama Bank</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->nm_bank) ? strtoupper($data->nm_bank) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Bank Cabang</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->bank_cabang) ? ucwords($data->bank_cabang) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Nama Rekening</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->nm_rekening) ? ucwords($data->nm_rekening) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapsePajak">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Data Pajak
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapsePajak" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Nama Wajib Pajak</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->nm_pajak) ? strtoupper($data->nm_pajak) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">No. NPWP</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->no_npwp) ? ucwords($data->no_npwp) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card card-info card-outline">
                                                <a class="d-block w-100" data-toggle="collapse"
                                                    href="#collapseAkreditasi">
                                                    <div class="card-header">
                                                        <h4 class="card-title w-100">
                                                            Data Akreditasi
                                                        </h4>
                                                    </div>
                                                </a>
                                                <div id="collapseAkreditasi" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">No. Sertifikat</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->no_sertifikat) ? ucwords($data->no_sertifikat) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">No. SK Akreditasi</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->no_sk_akreditasi) ? ucwords($data->no_sk_akreditasi) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Mulai Berlaku</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->mulai_berlaku) ? \Carbon\Carbon::parse($data->mulai_berlaku)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Masa Sertifikat</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->ms_akreditasi) ? \Carbon\Carbon::parse($data->ms_akreditasi)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Hasil Akreditasi</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->hasil) ? ucwords($data->hasil) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Penilai</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->penilai) ? ucwords($data->penilai) : '-' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-row">
                                                            <div class="col-sm-4 font-weight-bold">Tgl. Sertifikat</div>
                                                            <div class="col-sm-8">
                                                                <span
                                                                    class="data-value">{{ !empty($data->tgl_sertifikat) ? \Carbon\Carbon::parse($data->tgl_sertifikat)->isoFormat('D MMMM YYYY') : '-' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/admin/profil-lembaga/{{ $data->id }}/edit" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
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
