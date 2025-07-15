@extends('back.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pengguna</h3>
                    <h6 class="op-7 mb-2">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pengguna disini !</h6>
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">
                                Form Data Pengguna
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('pengguna') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ isset($data) ? route('pengguna.update', $data->id) : route('pengguna.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method(isset($data) ? 'PUT' : 'POST')
                            <div class="card-body">
                                <div class="form-group">
                                    <img src="{{ asset(isset($data) && $data->image != null && $data->image != '-' ? 'uploads/' . $data->image : 'thumbnail/user.png') }}"
                                        height="100" class="m-2" id="view_img">
                                    <br>
                                    <label for="image">Foto</label>
                                    <input type="file" name="image" id="image" class="form-control form-input"
                                        accept="image/*,image/png,image/jpg">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control form-input"
                                        placeholder="Nama" value="{{ isset($data) ? $data->name : old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" name="email" id="email" class="form-control form-input"
                                        placeholder="Email" value="{{ isset($data) ? $data->email : old('email') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password"
                                        value="{{ !isset($data) ? old('password') : '' }}" id="password"
                                        class="form-control form-input" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control form-input" required>
                                        <option value="admin" {{ (isset($data) && $data->role=='admin') ? 'selected' : '' }}>Admin</option>
                                        <option value="pelapor" {{ (isset($data) && $data->role=='pelapor') ? 'selected' : '' }}>Pelapor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>
                                    Simpan</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fas fa-ban"></i>
                                    Reset</button>
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
