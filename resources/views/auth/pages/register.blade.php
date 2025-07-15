@extends('front.layouts.app')
@section('content')
    <!-- Register Section -->
    <section id="signup" class="contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Aplikasi Pemantauan Sumber Mata Air</span>
            <h2>Sign Up</h2>
            <p>Daftar terlebih dahulu untuk melanjutkan pelaporan</p>
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-1">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <form action="{{ route('register.store') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label for="name" class="pb-2">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="pb-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="pb-2">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-md-12">
                                <label for="password_confirmation" class="pb-2">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="form-control">Daftar</button>
                            </div>
                            <div class="col-md-12 text-center">
                                <small>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></small>
                            </div>
                        </div>
                    </form>
                </div><!-- End Form -->
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section><!-- /Register Section -->
@endsection
