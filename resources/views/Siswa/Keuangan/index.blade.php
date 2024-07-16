@extends('layouts.main_student')

@section('container')
    <style>
        .address-row {
            display: flex;
            margin-bottom: 10px;
        }

        .address-label {
            flex: 1;
            font-weight: bold;
        }

        .address-data {
            flex: 2;
            text-align: left;
        }

        .address-row h5 {
            margin-left: 10px;
            /* Menambahkan margin kiri */
        }

        .address-row .badge {
            margin-left: 10px;
            /* Menambahkan margin kiri pada elemen badge */
        }

        .highlight-green {
            background-color: green;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .highlight-red {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }

        .table-bordered th {
            text-align: center;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 3px;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        .address-row h5 {
            margin-left: 0;
            /* Menghilangkan margin kiri default */
        }

        .address-row h5 .badge {
            margin-left: 0;
            /* Menghilangkan margin kiri pada elemen badge di dalam h5 */
        }
    </style>
    <section class="content">
        <div class="container">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="card card-primary card-tabs">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-receipt"></i> Detail Keuangan
                                                <small class="float-right">{{ ucwords($data->nm_lengkap) }}</small>
                                            </h4>
                                            <hr>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <!-- Sisi Kiri -->
                                        <div class="col-sm-6 invoice-col">
                                            <div class="address-row">
                                                <span class="address-label">Biaya Kursus</span>
                                                <span class="address-data">Rp.
                                                    {{ number_format($data->biaya_kursus, 0, ',', '.') }},-</span>
                                            </div>
                                            <div class="address-row">
                                                <span class="address-label">Pendaftaran</span>
                                                <span class="address-data">Rp.
                                                    {{ number_format($data->biaya_daftar, 0, ',', '.') }},-</span>
                                            </div>
                                            <div class="address-row">
                                                <span class="address-label">Discount</span>
                                                <span class="address-data">Rp.
                                                    {{ number_format($data->discount, 0, ',', '.') }},-</span>
                                            </div>
                                            <div class="address-row">
                                                <span class="address-label">Total Biaya Kursus</span>
                                                <span class="address-data">Rp.
                                                    {{ number_format($data->tot_biaya, 0, ',', '.') }},-</span>
                                            </div>
                                            <div class="address-row">
                                                <span class="address-label">Kekurangan</span>
                                                <span
                                                    class="address-data {{ $data->ket == 'Lunas' || strtolower($data->ket) == 'lunas' ? 'highlight-green' : 'highlight-red' }}">Rp.
                                                    {{ number_format($data->kekurangan, 0, ',', '.') }},-</span>
                                            </div>
                                        </div>
                                        <!-- /.col -->

                                        <!-- Sisi Kanan -->
                                        <div class="col-sm-6 invoice-col">
                                            <div class="address-row">
                                                <span class="address-label">Jam Kursus</span>
                                                <span class="address-data">{{ $data->jam }}</span>
                                            </div>
                                            <div class="address-row">
                                                <span class="address-label">Program Kursus</span>
                                                <span class="address-data">
                                                    {{ $data->pil_prog == 'paket' || $data->pil_prog == 'Paket'
                                                        ? ($data->kd_paket != 0
                                                            ? ($data->kd_tambahan != 0
                                                                ? 'Paket ' . $data->kd_paket . ' + Program Tambahan'
                                                                : 'Paket ' . $data->kd_paket)
                                                            : 'Pilihan')
                                                        : 'Pilihan' }}
                                                </span>
                                            </div>
                                            <div class="address-row">
                                                <div class="address-data">
                                                    <table class="table table-bordered custom-table-style">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Program Kursus</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($programs as $index => $program)
                                                                <tr>
                                                                    <td style="text-align: center">
                                                                        {{ $index + 1 }}</td>
                                                                    <td>{{ ucwords($program) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <!-- /.row -->
                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr style="text-align: center">
                                                        <th>#</th>
                                                        <th>Keterangan</th>
                                                        <th>Tanggal</th>
                                                        <th>Bayar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($installments as $index => $installment)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $installment['keterangan'] }}</td>
                                                            <td style="text-align: center">
                                                                {{ \Carbon\Carbon::parse($installment['tanggal'])->isoFormat('D MMMM YYYY') }}
                                                            </td>
                                                            <td>Rp.
                                                                {{ number_format($installment['angsuran'], 0, ',', '.') }},-
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6">
                                            <p class="lead mb-0">Metode Pembayaran</p>
                                            <img src="/img/bri-card.webp" width="15%" alt="BRI">
                                            <img src="/img/ovo-card.webp" width="15%" alt="OVO">
                                            <img src="/img/dana-card.webp" width="15%" alt="DANA">
                                            <p class="text-muted well well-sm shadow-none mb-0" style="margin-top: 10px;">
                                                Cash atau Transfer Rekening :
                                            <ol style="margin-left: 0; padding-left: 1.2em;">
                                                @foreach ($rekenings as $rekening)
                                                    <li>{{ '(' . strtoupper($rekening->nm_bank) . ') ' . ucwords($rekening->nm_rekening) . ' : ' . formatNoRek($rekening->no_rek) }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                            </p>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <p class="lead">Jumlah yang harus dibayar</p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Total Biaya Kursus</th>
                                                        <td>Rp.
                                                            {{ number_format($data->tot_biaya, 0, ',', '.') }},-
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sudah Dibayarkan</th>
                                                        <td>Rp.
                                                            {{ number_format($data->tot_biaya - $data->kekurangan, 0, ',', '.') }},-
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Kekurangan</th>
                                                        <td>Rp.
                                                            {{ number_format($data->kekurangan, 0, ',', '.') }},-
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Keterangan</th>
                                                        <td>
                                                            <h4><span
                                                                    class="right badge badge-{{ $data->ket == 'Lunas' || strtolower($data->ket) == 'lunas' ? 'success' : 'danger' }}">
                                                                    {{ strtoupper($data->ket) }} </span></h4>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
@endsection
