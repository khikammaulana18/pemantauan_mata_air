@extends('front.layouts.app')
@section('content')
<section id="profile" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Profil Saya</h2>
        <p>Ubah informasi pribadi Anda</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-1">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <form action="{{ route('profile.save') }}" method="post" enctype="multipart/form-data" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">{!! session('error') !!}</div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 text-center">
                            @if ($data->image)
                                {{-- Jika user punya foto profil di database --}}
                                <img src="{{ asset('uploads/' . $data->image) }}" alt="Foto Profil" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                {{-- Jika user TIDAK punya foto, gunakan foto default --}}
                                <img src="{{ asset('thumbnail/user.png') }}" alt="Foto Profil Default" class="rounded-circle mb-3" width="120">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label class="pb-2">Foto</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="pb-2">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="pb-2">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="pb-2">Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi untuk mengganti password">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="form-control">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
@endsection
