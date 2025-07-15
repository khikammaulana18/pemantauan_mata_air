@extends('front.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section mt-1">

        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
              <h1>Aplikasi Pemantauan Sumber Mata Air</h1>
              <p>LINTAS KOMUNITAS PENJAGA MATA AIR.</p>
              <div class="d-flex">
                <a href="{{route('peta')}}" class="btn-get-started">Lihat Peta Pesebaran</a>
                {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
              </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
              <img src="{{asset('/')}}front/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
          </div>
        </div>
  
      </section><!-- /Hero Section -->

  
@endsection