@extends('back.layouts.app')
@section('content-js')
    <script src="{{ asset('/') }}back/js/plugin/datatables/datatables.min.js"></script>
    <!-- Chart JS -->
    <script src="{{ asset('/') }}back/js/plugin/chart.js/chart.min.js"></script>
    <script>
        $('#dataTables').DataTable({});
        $('#dataTables2').DataTable({});
        $('#dataTables3').DataTable({});

        var canvasChart = document.getElementById("debitChart").getContext('2d')

        var lineChart = new Chart(canvasChart, {
            type: "line",
            data: {
                labels: [
                    @foreach ($data->Pemantauan as $dp)
                        '{{ $dp->tgl_pemantauan }}',
                    @endforeach
                ],
                datasets: [{
                    label: "Debit Air",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    borderWidth: 2,
                    data: [
                        @foreach ($data->Pemantauan as $dp)
                        '{{ $dp->debit_mata_air }}',
                    @endforeach
                    ],
                }, ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 10,
                        fontColor: "#1d7af3",
                    },
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    },
                },
            },
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3"> Data Sumber Mata Air</h3>
                    <h6 class="op-7 mb-2">Data Sumber Mata Air disini !</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="card-title">
                                {{ $data->nama_mata_air }}
                            </div>
                        </div>
                        @php
                            $thumbnail = 'thumbnail/no-image.png';
                            if (count($data->Media) > 0) {
                                foreach ($data->Media as $d) {
                                    $thumbnail = 'uploads/' . $d->path;
                                    break;
                                }
                            }

                        @endphp
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        <img src="{{ asset($thumbnail) }}" class="mx-2" width="100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gambar Lainnya</td>
                                    <td>
                                        <div class="d-flex">
                                            @foreach ($data->Media as $dm)
                                                <a target="_blank"
                                                    href="{{ asset($dm->path != null && $dm->path != '-' ? 'uploads/' . $dm->path : 'thumbnail/no-image.png') }}">
                                                    <img src="{{ asset($dm->path != null && $dm->path != '-' ? 'uploads/' . $dm->path : 'thumbnail/no-image.png') }}"
                                                        class="img" height="50" alt="">
                                                </a>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $data->nama_mata_air }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $data->alamat_mata_air }}</td>
                                </tr>
                                <tr>
                                    <td>Koordinat (Lat,Lng) </td>
                                    <td>: {{ $data->lat }} , {{ $data->lng }}</td>
                                </tr>
                                <tr>
                                    <td>Kondisi </td>
                                    <td>: {{ $data->kondisi }} , {{ $data->kondisi }}</td>
                                </tr>
                                <tr>
                                    <td>Status </td>
                                    <td>: {!! $data->status_mata_air == '0'
                                        ? '<span class="badge bg-danger">Tidak aktif</span>'
                                        : '<span class="badge bg-success">aktif</span>' !!}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan Singkat</td>
                                    <td>: {!! $data->short_desc !!}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi </td>
                                    <td>: {!! $data->long_desc !!}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Pemantauan {{ $data->nama_mata_air }}
                            </div>
                        </div>

                        <div class="card-body text-small">
                            <div class="table-responsive">
                                <table class="table" id="dataTables">
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Debit Air</th>
                                        <th>Kondisi Air</th>
                                        <th>Kerusakan</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->Pemantauan as $dp)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ date_format(date_create($dp->tgl_pemantauan), 'd M, Y') }}</td>
                                                <td>
                                                    {{ $dp->debit_mata_air }} m3/detik
                                                </td>
                                                <td>
                                                    {{ $dp->kondisi_air }}
                                                </td>
                                                <td>
                                                    {{ $dp->kerusakan }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Perubahan debit air Berdasarkan Hasil Pemantauan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="debitChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Laporan {{ $data->nama_mata_air }}
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTable2">
                                    <thead>
                                        <th>No</th>
                                        <th>Pelapor</th>
                                        <th>Deskripsi Laporan</th>
                                    </thead>
                                    @foreach ($data->Laporan as $item)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td width="20%"><h5>{{$item->nama}}</h5><p>{{$item->job}}</p></td>
                                            <td>{{$item->desc_laporan}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
