@extends('layouts.main')

@section('container')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $countStudent }}</h3>

                            <p>Peserta Didik</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-users"></i>
                        </div>
                        <a href="{{ route('pendaftaran.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $countUser }}</h3>

                            <p>Personalia</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $countProgramPilihan }}</h3>

                            <p>Program Pilihan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-archive"></i>
                        </div>
                        <a href="{{ route('program-pilihan.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $countProgramPaket }}</h3>

                            <p>Program Paket</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <a href="{{ route('program-paket.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title text-bold">Grafik Pendaftar Tahun {{ date('Y') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{ $countStudentThisYear }}</span>
                                    <span>Total Peserta Tahun Ini</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        {{ $registrantsThisMonth }}
                                    </span>
                                    <span class="text-muted">Bulan Ini</span>
                                </p>
                            </div>
                            <div class="position-relative mb-4">
                                <canvas id="registrants-chart" height="200"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Laki-laki
                                </span>
                                <span>
                                    <i class="fas fa-square text-yellow"></i> Perempuan
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title text-bold">Pendaftar Baru</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>No. Induk</th>
                                            <th>Nama</th>
                                            <th>Program</th>
                                            <th>Tgl. Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                            <td>Call of Duty IV</td>
                                            <td><span class="badge badge-success">Shipped</span></td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                    90,80,90,-70,61,-83,63</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- Map card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Program Paket Populer</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="150"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul id="chartLegend" class="chart-legend clearfix">
                                        <!-- Legend items will be dynamically generated -->
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Program Pilihan Populer</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Program</th>
                                        <th>Pendaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Microsoft Word</td>
                                        <td><span class="badge badge-success">140</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Peserta Baru belum isi Angket</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama</th>
                                        <th>Whatsapp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Peserta belum isi Angket Penilaian</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama</th>
                                        <th>Whatsapp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Update software</td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <script src="/plugins/chart.js/Chart.min.js"></script>
    {{-- pieChart Program Paket Populer --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var data = {
                labels: @json($popularProgramLabels),
                datasets: [{
                    data: @json($popularProgramData),
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef',
                        '#3c8dbc'
                    ], // Sesuaikan dengan jumlah dataset
                }]
            };

            var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue / total) * 100) +
                                    0.5); // Pembulatan persentase
                                return percentage + '%';
                            }
                        }
                    }
                }
            });

            // Generate legend items
            var legendItems = data.labels.map(function(label, index) {
                var dataset = data.datasets[0];
                var backgroundColor = dataset.backgroundColor[index];
                return '<li><i class="far fa-circle" style="color: ' + backgroundColor + '"></i> ' + label +
                    '</li>';
            });

            // Tampilkan legend
            document.getElementById('chartLegend').innerHTML = legendItems.join('');
        });
    </script>

    {{-- Grafik Batang Pendaftar 3 tahun terakhir --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('registrants-chart').getContext('2d');

            // Menggabungkan data laki-laki dan perempuan untuk mendapatkan nilai maksimum
            var maxValue = Math.max(...@json(array_merge($monthlyData['male'], $monthlyData['female'])));

            // Tambahkan beberapa ruang kosong di atas nilai tertinggi
            var maxY = Math.ceil(maxValue * 1.2); // Menggunakan faktor 1.2 untuk menambah ruang kosong 20%
            console.log('maxValue:', maxValue);
            console.log('maxY:', maxY);

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust',
                        'Sept', 'Okt', 'Nov', 'Des'
                    ],
                    datasets: [{
                            label: 'Laki-laki',
                            backgroundColor: 'rgba(20, 90, 227, 0.2)', // Warna biru dop
                            borderColor: 'rgba(20, 90, 227, 1)',
                            borderWidth: 1,
                            data: @json($monthlyData['male'])
                        },
                        {
                            label: 'Perempuan',
                            backgroundColor: 'rgba(255, 193, 7, 0.2)', // Warna kuning dop
                            borderColor: 'rgba(255, 193, 7, 1)',
                            borderWidth: 1,
                            data: @json($monthlyData['female'])
                        }
                    ]

                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxY // Menggunakan suggestedMax untuk memberi ruang ekstra
                        }
                    }
                }
            });
        });
    </script>
@endsection
