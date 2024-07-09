@extends('layouts.main_student')

@section('container')
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12 col-sm-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Nilai Program Kursus</h3>
                                    <small class="float-right">{{ ucwords(auth()->user()->nm_lengkap) }}</small>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th style="width: 10px">#</th>
                                                <th>Program Kursus</th>
                                                <th style="width: 10%">Nilai</th>
                                                <th style="width: 50%">Kemampuan</th>
                                                <th>Predikat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($programs as $index => $program)
                                                @php
                                                    $kd_program = $kd_programs[$index];
                                                    $existing_score = $existing_scores->get($kd_program);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ ucwords($program) }}</td>
                                                    <td style="text-align: center">
                                                        @if ($existing_score)
                                                            {{ $existing_score->nilai }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center">
                                                        <div class="progress progress-sm progress-striped active">
                                                            <div class="progress-bar {{ $existing_score ? $existing_score->predikat['bg'] : '' }}"
                                                                style="width: {{ $existing_score ? $existing_score->nilai . '%' : '0%' }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center">
                                                        <span
                                                            class="badge {{ $existing_score ? $existing_score->predikat['bg'] : '' }}">
                                                            {{ $existing_score ? $existing_score->predikat['predikat'] : 'BELUM DINILAI' }}
                                                        </span>
                                                    </td>
                                                    <input type="hidden" name="programs[]" value="{{ $program }}">
                                                    <input type="hidden" name="kd_programs[]" value="{{ $kd_program }}">
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->

                            <!-- /.card -->

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
