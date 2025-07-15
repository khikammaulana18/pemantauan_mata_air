@extends('back.layouts.app')

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
                                    <td>Nama</td>
                                    <td>: {{$data->nama_mata_air}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{$data->alamat_mata_air}}</td>
                                </tr>
                                <tr>
                                    <td>Koordinat (Lat,Lng) </td>
                                    <td>: {{$data->lat}} , {{$data->lng}}</td>
                                </tr>
                                <tr>
                                    <td>Kondisi </td>
                                    <td>: {{$data->kondisi}} , {{$data->kondisi}}</td>
                                </tr>
                                <tr>
                                    <td>Status </td>
                                    <td>: {!! $data->status_mata_air == '0' ? '<span class="badge bg-danger">Tidak aktif</span>' : '<span class="badge bg-success">aktif</span>' !!}</td>
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
            </div>
        </div>
    </div>
@endsection
