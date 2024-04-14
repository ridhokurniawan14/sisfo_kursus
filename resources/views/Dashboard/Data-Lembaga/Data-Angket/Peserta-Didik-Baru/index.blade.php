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
                <a href="{{ route('exportExcelPesertaDidikBaru', ['type' => 'angket_peserta_didik_baru']) }}" class="btn btn-info ml-3 col-sm-2 float-right"><i class="fas fa-download nav-icon mr-2"></i>Download Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Tgl. Pengisian Angket</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($datas as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->no_induk }}</td>
                      <td>{{ ucwords($data->Nama) }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->Tanggal)->isoFormat('D MMMM YYYY') }}</td>
                      <td>
                        <a class="btn btn-info badge bg-info" data-toggle="modal" data-target="#fotoModal{{$data->id}}"><span class="fas fa-eye"></span></a>
                        <div class="modal fade" id="fotoModal{{$data->id}}" tabindex="-1" aria-labelledby="fotoModalLabel{{$data->id}}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="fotoModalLabel{{$data->id}}">Informasi Angket <b>{{ ucwords($data->Nama) }}</b> ({{ \Carbon\Carbon::parse($data->Tanggal)->isoFormat('D MMMM YYYY') }})</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>1. Apa Keperluan Saudara kesini ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab1) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>2. Darimana Saudara mengenal LKP PTCC ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab2) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>3. Saat ini Saudara berstatus apa ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab3) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>4. Rencana untuk keperluan apa Saudara kursus ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab4) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>5. Siapa yang membiayai kursus ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab5) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>6. Apa pekerjaan Orang Tua Anda ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab6) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>7. Anda ingin masuk shief apa ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab7) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>8. Dalam 1 minggu ingin masuk berapa kali ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab8) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>9. Sejauh mana Saudara mengenal komputer saat ini ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab9) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>10. Jarak tempat tinggal Anda dengan LKP PTCC ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ strtoupper($data->jawab10) }}</b><p></p></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <p>11. Apakah saudara sanggup mentaati tata tertib LKP ?</p>
                                    </div>
                                    <div class="col-sm-4"><b> {{ ucwords($data->jawab11) }}</b><p></p></div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-default align-right" data-dismiss="modal">Close</button>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button class="badge bg-danger border-0" data-toggle="modal" data-target="#modal-delete{{ $data->id }}"><span class="fas fa-trash"></span></button>
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-delete{{ $data->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Apakah yakin Angket a.n. <b>{{ ucwords($data->Nama) }}</b> dihapus?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <form action="{{ route('angket-peserta-didik-baru.destroy', ['angket_peserta_didik_baru' => $data->id]) }}" method="post" class="d-inline">
                              @method('DELETE')
                              @csrf
                              <button type="button" class="btn btn-default ml-auto" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Yakin</button>
                            </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Tgl. Pengisian Angket</th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
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
 