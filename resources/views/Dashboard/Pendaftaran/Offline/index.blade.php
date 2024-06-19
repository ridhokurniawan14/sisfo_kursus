@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">        
            {{-- Data Tabel --}}
            <div class="card">
              <div class="card-header d-flex align-items-center">
                <h3 class="card-title">{{ $tab_title }}</h3>
                <a href="/pendaftaran/create" class="btn btn-primary ml-3 col-sm-2 float-right"><i class="fas fa-pen nav-icon mr-2"></i>Tambah Pendaftar</a>
                {{-- Tombol Download --}}
                <a href="{{ route('pendaftaran.export') }}" class="btn btn-info ml-3 col-sm-2 float-right"><i class="fas fa-download nav-icon mr-2"></i>Download Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- Form Pencarian --}}
                <form method="GET" action="{{ route('pendaftaran.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" name="search" autofocus autocomplete="off" class="form-control" placeholder="Cari Nama atau NIS" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>  
                <table id="datapesertadidik" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>L/P</th>
                            <th>Prog. Kursus</th>
                            <th>Biaya Kursus</th>
                            <th>Kekurangan</th>
                            <th>HP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $index => $data)
                            <tr>
                                {{-- <td>{{ $datas->firstItem() + $index }}</td> --}}
                                <td>{{ $loop->iteration + ($datas->currentPage()-1) * $datas->perPage() }}</td>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $data->no_induk }}</td>
                                <td>{{ ucwords($data->nm_lengkap) }}</td>
                                <td>
                                  @switch(strtolower($data->gender))
                                      @case('l')
                                          Laki-Laki
                                          @break
                                      @case('p')
                                          Perempuan
                                          @break
                                      @default
                                          Tidak Valid
                                  @endswitch
                                </td>
                                <td>{{ ucwords($data->pil_prog) }}</td>
                                <td>{{ 'Rp ' . number_format(($data->biaya_kursus ?? 0) + ($data->biaya_daftar ?? 0), 0, ',', '.') }}</td>
                                <td>
                                    @if($data->kekurangan == 0)
                                        <span class="right badge badge-success">✅ LUNAS</span>
                                    @else
                                        {{ 'Rp '. number_format($data->kekurangan, 0, ',', '.') }}
                                    @endif
                                </td>                            
                                <td>
                                    @if(!empty($data->no_hp))
                                        <a href="https://wa.me/{{ $data->no_hp }}?text=Hai%20{{ ucwords($data->nm_lengkap) }}, Kami dari LKP PTCC.+Ada+yang+perlu+Kami+sampaikan+terkait+.......&type=phone_number&app_absent=0" target="_blank">{{ $data->no_hp }}</a>
                                    @else
                                        <span class="right badge badge-warning">MOHON DIISI‼️</span>
                                    @endif
                                </td>                              
                                <td>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                          Perintah <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-left btn-sm" role="menu">
                                          <a class="dropdown-item" href="/pendaftaran/{{ $data->no_induk }}">Detail Data</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="/pendaftaran/verifikasi/{{ $data->no_induk }}/edit">Pembayaran</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="/pendaftaran/{{ $data->no_induk }}/edit">Edit Bio</a>
                                          <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{ $data->no_induk }}">Hapus</a>
                                      </div>
                                  </div>                                             
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-delete{{ $data->no_induk }}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah yakin Pendaftar online a.n. <b>{{ ucwords($data->nm_lengkap) }}</b> dihapus?</p>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <form action="{{ route('pendaftar-online.destroy', ['pendaftar_online' => $data->no_induk]) }}" method="post" class="d-inline">
                                      @method('DELETE')
                                      @csrf
                                      <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
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
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>L/P</th>
                        <th>Prog. Kursus</th>
                        <th>Biaya Kursus</th>
                        <th>Kekurangan</th>
                        <th>HP</th>
                        <th></th>
                      </tr>
                      </tfoot>
                </table>
                <!-- Menampilkan pagination links -->
                {{ $datas->links() }}
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