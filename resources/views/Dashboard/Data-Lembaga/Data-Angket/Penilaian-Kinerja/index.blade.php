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
                <a href="{{ route('exportExcelPenilaian', ['type' => 'angket_penilaian']) }}" class="btn btn-info ml-3 col-sm-2 float-right"><i class="fas fa-download nav-icon mr-2"></i>Download Data</a>
                <a href="{{ route('exportExcelPeserta', ['type' => 'peserta_belum_isi_angket']) }}" class="btn btn-danger ml-3 col-sm-3 float-right"><i class="fas fa-download nav-icon mr-2"></i>Peserta Belum Isi Angket</a>
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
                    <th>Nilai Administrasi</th>
                    <th>Nilai Pendidik</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($datas as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->no_induk }}</td>
                      <td>{{ ucwords($data->nm_lengkap) }}</td>
                      <td>{{ \Carbon\Carbon::parse($data->tgl)->isoFormat('D MMMM YYYY') }}</td>
                      <td><a class="btn btn-info badge bg-info" data-toggle="modal" data-target="#modalAdministrasi{{$data->id}}"><span class="fas fa-eye"></span> Administrasi</a></td>
                      <td><a class="btn btn-info badge bg-info" data-toggle="modal" data-target="#modalPendidik{{$data->id}}"><span class="fas fa-eye"></span> Pendidik</a></td>
                      <td>
                        {{-- MODAL ADMINISTRASI --}}
                        <div class="modal fade" id="modalAdministrasi{{$data->id}}" tabindex="-1" aria-labelledby="fotoModalLabel{{$data->id}}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="fotoModalLabel{{$data->id}}">Penilaian Administrasi dari <b>{{ ucwords($data->nm_lengkap) }}</b> ({{ \Carbon\Carbon::parse($data->tgl)->isoFormat('D MMMM YYYY') }})</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p><b>INDIKATOR PENILAIAN</b></p>
                                        </div>
                                        <div class="col-sm-4"><b>NILAI</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>1. Senyum, Salam dan Sapa</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var1) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>2. Cepat dan Tanggap dalam menerima Pelanggan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var2) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>3. Keramahan dan Kesabaran melayani Pelanggan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var3) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>4. Kejelasan dalam menvar pertanyaan Pelanggan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var4) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>5. Cepat dan Teliti dalam mengerjakan Pengetikan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var5) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>6. Kerapian dalam Berpenampilan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var6) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>7. Tertib Waktu dan Disiplin</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var7) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>8. Cepat dalam Pencatatan Pembukuan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var8) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>9. Kepedulian terhadap Pelanggan dan Rekan Kerja</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var9) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>10. Kreativitas dan Rutinitas dalam Kebersihan Lingkungan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var10) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>11. Cepat dalam Mengevaluasi kesediaan bahan-bahan ajar</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var11) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>12. Peningkatan dalam belajar Bidang Keterampilan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var12) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>Rata-rata</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ $data->rata_rata_var }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><b>Saran / Kritik</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: justify;text-justify: inter-word;">
                                          @if (!empty($data->saran))
                                              <p>{{ ucwords($data->saran) }}</p>
                                          @else
                                              <p>Tidak ada Saran / Kritik</p>
                                          @endif
                                        </div>
                                    </div>
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
                        {{-- MODAL PENDIDIK --}}
                        <div class="modal fade" id="modalPendidik{{$data->id}}" tabindex="-1" aria-labelledby="fotoModalLabel{{$data->id}}" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="fotoModalLabel{{$data->id}}">Penilaian Pendidik dari <b>{{ ucwords($data->nm_lengkap) }}</b> ({{ \Carbon\Carbon::parse($data->tgl)->isoFormat('D MMMM YYYY') }})</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p><b>INDIKATOR PENILAIAN</b></p>
                                        </div>
                                        <div class="col-sm-4"><b>NILAI</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>1. Senyum, Salam dan Sapa</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var1_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>2. Keramahan dan Kesabaran melayani Peserta Didik</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var2_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>3. Kejelasan dalam menjawab pertanyaan Peserta Didik</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var3_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>4. Kecepatan dan Ketelitian dalam menjawab pertanyaan Peserta Didik</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var4_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>5. Kecepatan dalam pencatatan Penilaian</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var5_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>6. Kerapian dalam Berpenampilan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var6_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>7. Tertib Waktu dan Disiplin</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var7_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>8. Kreatif dalam memberikan pengajaran</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var8_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>9. Kepedulian terhadap Peserta Didik</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var9_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>10. Kepedulian terhadap teman sejawat</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var10_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>11. Rutinitas dalam Kebersihan lingkungan lembaga</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var11_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>12. Kecepatan dalam mengevaluasi Peserta Didik</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var12_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>13. Peningkatan dalam belajar Bidang Keterampilan</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ ucwords($data->var13_tutor) }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <p>Rata-rata</p>
                                        </div>
                                        <div class="col-sm-4"><b>{{ $data->rata_rata_var_tutor }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><b>Saran / Kritik</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" style="text-align: justify;text-justify: inter-word;">
                                          @if (!empty($data->saran_tutor))
                                              <p>{{ ucwords($data->saran_tutor) }}</p>
                                          @else
                                              <p>Tidak ada Saran / Kritik</p>
                                          @endif
                                        </div>
                                    </div>
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
                            <p>Apakah yakin Angket Penilaian a.n. <b>{{ ucwords($data->nm_lengkap) }}</b> dihapus?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <form action="{{ route('angket-penilaian.destroy', ['angket_penilaian' => $data->id]) }}" method="post" class="d-inline">
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
                    <th>Nilai Administrasi</th>
                    <th>Nilai Pendidik</th>
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
 