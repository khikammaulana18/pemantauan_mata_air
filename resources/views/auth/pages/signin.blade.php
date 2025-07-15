@extends('front.layouts.app')
@section('content')
    <!-- Contact Section -->
    <section id="signin" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Aplikasi Pemantauan Sumber Mata Air</span>
            <h2>Sign In</h2>
            <p>Masuk Menggunakan Email dan Password kamu</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-1">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <form action="{{ route('auth') }}" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        @method('POST')
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-12">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="pb-2">Email</label>
                                <input type="email" placeholder="Email" class="form-control" name="email" id="email"
                                    required="">
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="pb-2">Password</label>
                                <input type="password" placeholder="Password" class="form-control" name="password"
                                    id="password" required="">
                            </div>
                            <div class="col-md-12">

                                <button type="submit" class="form-control">Login</button>
                            </div>
                            <div class="col-md-12 text-center">
                                <small>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small>
                            </div>
                            <div class="col-md-12">
                            </div>
                        </div>
                    </form>
                </div><!-- End Contact Form -->
                <div class="col-lg-3"></div>
            </div>

        </div>

    </section><!-- /Contact Section -->
@endsection
