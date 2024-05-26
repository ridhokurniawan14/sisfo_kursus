{{-- <table id="datapesertadidik" class="table table-bordered table-striped">
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
                  @foreach ($datas as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->no_induk }}</td>
                      <td>{{ ucwords($data->nm_lengkap) }}</td>
                      <td>
                          @if($data->gender == 'L')
                              Laki-Laki
                          @elseif($data->gender == 'P')
                              Perempuan
                          @else
                              Tidak Valid
                          @endif
                      </td>
                      <td>{{ ucwords($data->pil_prog) }}</td>
                      <td>{{ 'Rp '. number_format($data->biaya_kursus, 0, ',', '.') }}</td>
                      <td>{{ 'Rp '. number_format($data->kekurangan, 0, ',', '.') }}</td>
                      <td>    
                        <a href="https://wa.me/{{ $data->no_hp }}?text=Hai%20{{ ucwords($data->nm_lengkap) }},%20Terima%20Kasih%20sudah%20mendaftar%20online.%20Ditunggu%20kehadirannya%20untuk%20melakukan%20Administrasi%20di%20kantor%20LKP%20PTCC%20ya%20Kak%20:-)" target="_blank">{{ $data->no_hp }}</a>
                      </td>
                      <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                Perintah <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-left btn-sm" role="menu">
                                <a class="dropdown-item" href="{{ route('pendaftar-online.pdf', ['pendaftarOnline' => $data->id]) }}" target="_blank">Cetak Formulir</a>
                                <a class="dropdown-item" href="?pg=f_pd&amp;ver=35">Lanjutkan</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{ $data->id }}">Hapus</a>
                            </div>
                        </div>                                             
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
                            <p>Apakah yakin Pendaftar online a.n. <b>{{ ucwords($data->nm_lengkap) }}</b> dihapus?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <form action="{{ route('pendaftar-online.destroy', ['pendaftar_online' => $data->id]) }}" method="post" class="d-inline">
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
                </table>
                <div>
                  {{ $datas->links() }}
                </div> --}}