@extends('layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">History Activity</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="text-align: center">
                                        <th width="5%">#</th>
                                        <th width="10%">Nama</th>
                                        <th width="70%">Deskripsi</th>
                                        <th width="15%">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $index => $activity)
                                        <tr data-widget="expandable-table" aria-expanded="false">
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td>{{ !empty($activity->causer_id) ? explode(' ', trim(ucwords($activity->nm_lengkap)))[0] : 'Unknown' }}
                                            </td>
                                            <td>
                                                @if (!empty($activity->causer_id))
                                                    {{ ucwords($activity->description) . ' ' . ucwords($activity->log_name) . '. ' }}
                                                    @php
                                                        $properties = json_decode($activity->properties, true);
                                                    @endphp
                                                    @if (is_array($properties))
                                                        @php
                                                            $output = [];
                                                            if (isset($properties['attributes'])) {
                                                                foreach ($properties['attributes'] as $key => $value) {
                                                                    $oldValue = isset($properties['old'][$key])
                                                                        ? $properties['old'][$key]
                                                                        : null;
                                                                    if ($oldValue) {
                                                                        $output[] =
                                                                            ucfirst($key) .
                                                                            ' : ' .
                                                                            ucfirst($oldValue) .
                                                                            ' => ' .
                                                                            ucfirst($value);
                                                                    } else {
                                                                        $output[] =
                                                                            ucfirst($key) . ': ' . ucfirst($value);
                                                                    }
                                                                }
                                                            }

                                                            if (isset($properties['old'])) {
                                                                foreach ($properties['old'] as $key => $oldValue) {
                                                                    if (!isset($properties['attributes'][$key])) {
                                                                        $output[] =
                                                                            ucfirst($key) . ' : ' . ucfirst($oldValue);
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        {!! implode('<br>', $output) !!}
                                                    @else
                                                        {{ $activity->properties }}
                                                    @endif
                                                @else
                                                    {{ ucwords($activity->description) . ' ' . $activity->properties }}
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                {{ \Carbon\Carbon::parse($activity->created_at)->isoFormat('D MMMM YYYY') . ' (' . \Carbon\Carbon::parse($activity->created_at)->format('H:i:s') . ')' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <!-- Menampilkan pagination links -->
                                {{ $activities->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- /.timeline -->

    </section>
    <!-- /.content -->
@endsection
