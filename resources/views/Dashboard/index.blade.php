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
                                <h3 class="card-title text-bold">Grafik Pendaftar</h3>
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
                                <ul class="nav nav-tabs" id="year-tabs" role="tablist">
                                    @foreach (array_keys($registrantsData) as $year)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $year == date('Y') ? 'active' : '' }}"
                                                id="tab-{{ $year }}" data-toggle="tab"
                                                href="#content-{{ $year }}" role="tab">{{ $year }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-content">
                                @foreach ($registrantsData as $year => $monthlyData)
                                    <div class="tab-pane fade {{ $year == date('Y') ? 'show active' : '' }}"
                                        id="content-{{ $year }}" role="tabpanel">
                                        <div class="d-flex">
                                            <p class="d-flex flex-column">
                                                <span
                                                    class="text-bold text-lg">{{ array_sum($monthlyData['male']) + array_sum($monthlyData['female']) }}</span>
                                                <span>Total Peserta Tahun {{ $year }}</span>
                                            </p>
                                            <p class="ml-auto d-flex flex-column text-right">
                                                <span class="text-success">
                                                    {{ $monthlyData['male'][date('n') - 1] + $monthlyData['female'][date('n') - 1] }}
                                                </span>
                                                <span class="text-muted">Bulan Ini</span>
                                            </p>
                                        </div>
                                        <div class="position-relative mb-4">
                                            <canvas id="registrants-chart-{{ $year }}" height="200"></canvas>
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
                                @endforeach
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
                                        @foreach ($newStudent as $newStudents)
                                            <tr>
                                                <td><a
                                                        href="/admin/pendaftaran/{{ $newStudents->no_induk }}">{{ $newStudents->no_induk }}</a>
                                                </td>
                                                <td>{{ ucwords($newStudents->nm_lengkap) }}</td>
                                                <td><span
                                                        class="badge badge-{{ $newStudents->pil_prog == 'paket' ? 'success' : 'info' }}">{{ strtoupper($newStudents->pil_prog) }}</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($newStudents->tgl_masuk)->isoFormat('D MMMM YYYY') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{ route('pendaftaran.create') }}" class="btn btn-sm btn-primary float-left"><i
                                    class="fas fa-plus mr-1"></i>Add New</a>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-sm btn-secondary float-right"><i
                                    class="fas fa-eye mr-1"></i>View All Student</a>
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
                            <h3 class="card-title text-bold">Peserta belum isi Angket</h3>
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
                                    @foreach ($nullNewFormStudent as $nullNewFormStudents)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($nullNewFormStudents->nm_lengkap) }}</td>
                                            <td>
                                                @if (!empty($nullNewFormStudents->no_hp))
                                                    <a target="_blank"
                                                        href="https://wa.me/+62{{ $nullNewFormStudents->no_hp }}"><span
                                                            class="badge bg-success">
                                                            <i class="fab fa-whatsapp mr-1"></i>
                                                            {{ $nullNewFormStudents->no_hp }}</span>
                                                    </a>
                                                @else
                                                    <a
                                                        href="/admin/pendaftaran/{{ $nullNewFormStudents->no_induk }}/edit"><span
                                                            class="badge bg-warning">
                                                            <i class="fas fa-pen mr-1"></i>
                                                            Masukkan No. HP</span>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Alumni belum isi Angket Penilaian</h3>
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

    {{-- Grafik Batang Pendaftar 5 tahun terakhir --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var allData = @json($registrantsData);

            Object.keys(allData).forEach(function(year) {
                var ctx = document.getElementById('registrants-chart-' + year).getContext('2d');

                var maxValue = Math.max(...allData[year]['male'], ...allData[year]['female']);
                var maxY = Math.ceil(maxValue * 1.2);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept',
                            'Okt', 'Nov', 'Des'
                        ],
                        datasets: [{
                                label: 'Laki-laki',
                                backgroundColor: 'rgba(20, 90, 227, 0.2)',
                                borderColor: 'rgba(20, 90, 227, 1)',
                                borderWidth: 1,
                                data: allData[year]['male']
                            },
                            {
                                label: 'Perempuan',
                                backgroundColor: 'rgba(255, 193, 7, 0.2)',
                                borderColor: 'rgba(255, 193, 7, 1)',
                                borderWidth: 1,
                                data: allData[year]['female']
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: maxY
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
