@extends('front.layouts.app')
@section('content')

<section id="peta">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Aplikasi Pemantauan Sumber Mata Air</span>
      <h2>Peta Pesebaran Mata Air</h2>
      <p>Titik Lokasi Pesebaran sumber mata air</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="map" style="width: 100%; height: 475px;"></div>
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
            center: [-0.8610032868145527, 115.47219514528805],
            zoom: 5,

        });
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 32,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        //add marker to map
        @foreach($data as $d)
        @php
            $foto = 'thumbnail/no-image.png';
            if(count($d->Media) > 0 ){
                foreach($d->Media as $md){
                    $foto = 'uploads/'.$md->path;
                    break;
                }
            }
        @endphp
        
        L.marker([{{$d->lat}}, {{$d->lng}}]).addTo(map).bindPopup('<div class="text-center"><p>{{$d->nama_mata_air}}</p><br> <img src="{{asset($foto)}}" width="100%" class="img"><small>{{$d->short_desc}}<small> <a href="{{route("map.show",$d->id)}}" class="btn btn-success form-control text-decoration-none text-white"><i class="fas fa-search"></i>Lihat Detail</a></div>');
        @endforeach

    </script>
@endsection