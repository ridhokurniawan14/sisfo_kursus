@extends('layouts.main')

@section('container')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($data->foto)
                                    <img src="{{ asset('storage/' . $data->foto) }}"
                                        class="profile-user-img img-fluid img-circle" alt="Personalia Image">
                                @else
                                    <img src="/img/user.png" class="profile-user-img img-fluid img-circle"
                                        alt="Personalia Image">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ ucwords($data->nm_lengkap) }}</h3>

                            <p class="text-muted text-center">{{ ucwords($data->hak_akses) }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right">{{ $data->username }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $data->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mulai bekerja</b> <a
                                        class="float-right">{{ \Carbon\Carbon::parse($data->tgl_masuk)->isoFormat('D MMMM YYYY') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>No. HP</b> <a class="float-right">{{ $data->no_hp }}</a>
                                </li>
                            </ul>

                            <a target="_blank" href="https://wa.me/+62{{ $data->no_hp }}"
                                class="btn btn-success btn-block">
                                <i class="fab fa-whatsapp mr-1"></i> <b>Whatsapp</b>
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Biodata </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>

                            <p class="text-muted">
                                Pendidikan Terakhir {{ strtoupper($data->pend_akhir) }} dibidang
                                {{ ucwords($data->jurusan) }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat Rumah</strong>

                            <p class="text-muted">{{ ucwords($data->alamat) }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Detail
                                        Data</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Aktivitas</a></li> --}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">NIK</label>
                                                <input type="text" class="form-control" id="nama"
                                                    value="{{ $data->nik }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">Jenis Kelamin:</label>
                                                <input type="text" class="form-control" id="gender"
                                                    value="{{ $data->gender == 'l' ? 'Laki-laki' : 'Perempuan' }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir:</label>
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                    value="{{ ucwords($data->tmp_lahir) }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_lahir">Tanggal Lahir:</label>
                                                <input type="text" class="form-control" id="tgl_lahir"
                                                    value="{{ \Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM YYYY') }}"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="ibu_kandung">Ibu Kandung</label>
                                                <input type="text" class="form-control" id="ibu_kandung"
                                                    value="{{ empty($data->nm_ibu) ? '-' : ucwords($data->nm_ibu) }}"
                                                    readonly>

                                            </div>
                                            <div class="form-group">
                                                <label for="agama">Agama</label>
                                                <input type="text" class="form-control" id="agama"
                                                    value="{{ ucwords($data->agama) }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <input type="text" class="form-control" id="status"
                                                    value="{{ ucwords($data->status) }}" readonly>
                                            </div>
                                            <!-- Tambahkan data lain sesuai kebutuhan -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="foto">Foto Profil:</label>
                                                <img src="{{ asset('storage/' . $data->foto) }}" class="img-fluid"
                                                    alt="Foto Profil">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left mt-1">
                                        <a href="/admin/user/{{ $data->email }}/edit" class="btn btn-warning"><i
                                                class="fas fa-edit mr-1"></i>Edit Data</a>
                                    </div>
                                </div>


                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                10 Feb. 2014
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-envelope bg-primary"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                    email</h3>

                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                    accepted your friend request
                                                </h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                    your post</h3>

                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                        comment</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                    photos</h3>

                                                <div class="timeline-body">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
