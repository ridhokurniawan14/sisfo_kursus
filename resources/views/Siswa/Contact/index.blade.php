@extends('layouts.main_student')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @foreach ($datas as $data)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        Teacher
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ ucwords($data->nm_lengkap) }}</b></h2>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-home"></i></span>
                                                        {{ ucwords($data->alamat) }}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> Phone :
                                                        {{ $data->no_hp }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                @if ($data->foto)
                                                    <img src="{{ asset('storage/' . $data->foto) }}"
                                                        class="img-circle img-fluid" style="opacity: .8"
                                                        alt="Foto {{ ucwords($data->nm_lengkap) }}">
                                                @else
                                                    <img src="/img/student.png" class="img-circle img-fluid"
                                                        style="opacity: .8">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="https://wa.me/{{ $data->no_hp }}?text=Hallo%20{{ $data->gender == 'l' ? 'Pak' : 'Bu' }}%20{{ ucwords($data->nm_lengkap) }}, Saya ingin bertanya tentang ..... &type=phone_number&app_absent=0"
                                                target="_blank" class="btn btn-sm bg-success">
                                                <i class="fab fa-whatsapp mr-1"></i> <b>Whatsapp</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
