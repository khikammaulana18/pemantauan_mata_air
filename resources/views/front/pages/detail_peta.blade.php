@extends('front.layouts.app')
@section('content')

<section id="peta">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Aplikasi Pemantauan Sumber Mata Air</span>
      <h2>{{$data->nama_mata_air}}</h2>
      <p>{{$data->short_desc}}</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                @php
                $thumbnail = 'thumbnail/no-image.png';
                if (count($data->Media) > 0) {
                    foreach ($data->Media as $d) {
                        $thumbnail = 'uploads/' . $d->path;
                        break;
                    }
                }

            @endphp
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
                        <td>
                            Lokasi
                        </td>
                        <td>  <div id="map" style="width: 100%; height: 200px;"></div></td>
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
    
</section>

@endsection
@section('content-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <link rel="stylesheet" href="{{ asset('/') }}vendor/leafletjs/leaflet-panel-layers.css">
@endsection
@section('content-js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('/') }}vendor/leafletjs/leaflet.ajax.js"></script>
    <script src="{{ asset('/') }}vendor/leafletjs/leaflet-panel-layers.js"></script>
    <script>
        const map = L.map('map', {
            center: [{{$data->lat}}, {{$data->lng}}],
            zoom: 6,

        });
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 32,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        //add marker to map
        
        @php
            $foto = 'thumbnail/no-image.png';
            if(count($data->Media) > 0 ){
                foreach($data->Media as $md){
                    $foto = 'uploads/'.$md->path;
                    break;
                }
            }
        @endphp
        
        L.marker([{{$data->lat}}, {{$data->lng}}]).addTo(map);
        

    </script>
@endsection