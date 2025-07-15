@extends('back.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Profile</h3>
                    <h6 class="op-7 mb-2">Data Profile Anda akan muncul disini !</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="card-title">
                                Data Pengguna
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset($data->image != '-' && $data->image != null ? 'uploads/' . $data->image : 'thumbnail/user.png') }}"
                                    class="img rounded-circle" width="100%">
                                <h5>{{ $data->name }}</h5>
                                <p class="text-mute">{{ $data->email }}</p>
                            </div>
                            <div class="table-responsive my-2">
                                <table class="table">
                                    <tr>
                                        <td>Nama </td>
                                        <td>: {{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: {{ $data->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>: ********</td>
                                    </tr>
                                </table>
                            </div>
                            <a href="{{ route('logout') }}" class="btn btn-sm form-control btn-danger a-confirm"><i
                                    class="fas fa-power-off"></i> Log out</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Form Data Pengguna
                            </div>
                        </div>
                        <form action="{{ route('profile.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="form-group">
                                    <img src="{{ asset($data->image != '-' && $data->image != null ? 'uploads/' . $data->image : 'thumbnail/user.png') }}"
                                        alt="" id="view_img" class="m-2" height="100">
                                    <br>
                                    <label for="image">Foto</label>
                                    <input type="file" name="image" id="image" class="form-control form-input"
                                        accept="image/png,image/*">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control form-input"
                                        placeholder="Nama" value="{{ $data->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" id="email" class="form-control form-input"
                                        placeholder="Email" value="{{ $data->email }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-input"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>
                                    Simpan</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-danger"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('content-js')
    <script>
        $('#image').change(function(event) {
            $("#view_img").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
    </script>
@endsection
