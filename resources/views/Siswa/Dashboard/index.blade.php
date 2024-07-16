@extends('layouts.main_student')

@section('container')
    <section class="content">
        <div class="container">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        @php
                            $previousDate = null;
                        @endphp
                        @foreach ($datas as $data)
                            @php
                                $currentDate = \Carbon\Carbon::parse($data->created_at)->format('d M. Y');
                            @endphp

                            @if ($previousDate !== $currentDate)
                                <div class="time-label">
                                    <span class="bg-primary">{{ $currentDate }}</span>
                                </div>
                                @php
                                    $previousDate = $currentDate;
                                @endphp
                            @endif

                            <div>
                                <i
                                    class="fas 
                                    @switch($data->jenis)
                                        @case('pemberitahuan') fa-info bg-blue @break
                                        @case('libur kursus') fa-calendar-alt bg-warning @break
                                        @case('lowongan pekerjaan') fa-briefcase bg-purple @break
                                        @case('lomba') fa-trophy bg-warning @break
                                    @endswitch">
                                </i>
                                <div class="timeline-item">
                                    @php
                                        $createdTime = \Carbon\Carbon::parse($data->created_at);
                                        $timeDiff = $createdTime->diffForHumans();
                                        $absoluteTime = $createdTime->format('H:i');
                                    @endphp
                                    <span class="time">
                                        <i class="fas fa-clock"></i>
                                        @if ($createdTime->diffInMinutes() < 60)
                                            {{ $timeDiff }}
                                        @else
                                            {{ $absoluteTime }}
                                        @endif
                                    </span>
                                    <h3 class="timeline-header">
                                        @if ($data->user->foto)
                                            <img src="{{ asset('storage/' . $data->user->foto) }}"
                                                class="brand-image img-circle" style="opacity: .8" width="25px"
                                                height="25px" alt="Foto {{ $data->user->nm_lengkap }}">
                                        @else
                                            <img src="/img/student.png" class="brand-image img-circle" style="opacity: .8"
                                                width="25px" height="25px">
                                        @endif
                                        <a href="#">{{ ucwords($data->created_by) }}</a> create
                                        @switch($data->jenis)
                                            @case('pemberitahuan')
                                                information
                                            @break

                                            @case('libur kursus')
                                                holiday information
                                            @break

                                            @case('lowongan pekerjaan')
                                                job vacancy information
                                            @break

                                            @case('lomba')
                                                contest information
                                            @break
                                        @endswitch
                                    </h3>

                                    <div class="timeline-body">
                                        <h5 class="text-bold">{{ strtoupper($data->judul) }}</h5>
                                        @if ($data->foto)
                                            <div style="overflow: hidden; /* menangani clear float */">
                                                <img src="{{ asset('storage/' . $data->foto) }}"
                                                    style="float: left; margin-right: 10px; width: 15%; height: auto; cursor: pointer;"
                                                    data-toggle="modal" data-target="#imageModal">
                                                <p style="text-align: justify;">{{ ucfirst($data->ket) }}</p>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog"
                                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageModalLabel">Detail Gambar</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/' . $data->foto) }}"
                                                                class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p style="text-align: justify;">{{ ucfirst($data->ket) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->

    </section>
@endsection
