@extends('back.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Sumber Mata Air</h3>
                    <h6 class="op-7 mb-2">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Sumber Mata Air disini !</h6>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">
                                Dokumentasi
                            </div>
                            <div class="card-tools">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambah"
                                    class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="dataTables">
                                    <thead>
                                        <th>No</th>
                                        <th>Dokumentasi</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->Media as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    <img src="{{ asset($item->path != '-' && $item->path != null ? 'uploads/' . $item->path : 'thumbnail/no-image.png') }}"
                                                        height="50" class="img">
                                                </td>
                                                <td>
                                                    <form action="{{ route('mata_air.delete_image', $item->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm form-confirm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">
                                Form Data Sumber Mata Air
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('mata_air') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ route('mata_air.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_mata_air">Nama</label>
                                    <input type="text"
                                        value="{{ isset($data) ? $data->nama_mata_air : old('nama_mata_air') }}"
                                        name="nama_mata_air" id="nama_mata_air" class="form-control form-input" required
                                        placeholder="Nama Mata Air">
                                </div>

                                <div class="form-group">
                                    <label for="alamat_mata_air">Alamat</label>
                                    <input type="text"
                                        value="{{ isset($data) ? $data->alamat_mata_air : old('alamat_mata_air') }}"
                                        name="alamat_mata_air" id="alamat_mata_air" class="form-control form-input"
                                        placeholder="Alamat" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Koordinat</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lat">Lat</label>
                                            <input type="text" value="{{ isset($data) ? $data->lat : old('lat') }}"
                                                name="lat" id="lat" placeholder="Latitude"
                                                class="form-control form-input" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lng">Lng</label>
                                            <input type="text" value="{{ isset($data) ? $data->lng : old('lng') }}"
                                                name="lng" id="lng" placeholder="Longitude"
                                                class="form-control form-input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi">Kondisi</label>
                                    <select name="kondisi" id="kondisi" class="form-control form-select-input" required>
                                        <option value="">-- Pilih Kondisi --</option>
                                        <option value="Baik"
                                            {{ isset($data) && $data->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Rusak"
                                            {{ isset($data) && $data->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_mata_air">Status</label>
                                    <select name="status_mata_air" id="status_mata_air"
                                        class="form-control form-select-input" required>
                                        <option value="">-- Pilih Status</option>
                                        <option value="0"
                                            {{ isset($data) && $data->status_mata_air == '0' ? 'selected' : '' }}>Tidak
                                            Aktif</option>
                                        <option value="1"
                                            {{ isset($data) && $data->status_mata_air == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc">Deskripsi Singkat</label>
                                    <input type="text"
                                        value="{{ isset($data) ? $data->short_desc : old('short_desc') }}"
                                        name="short_desc" id="short_desc" class="form-control form-input"
                                        placeholder="Deskripsi Singkat Mata Air" required>
                                </div>
                                <div class="form-group">
                                    <label for="long_desc">Deskripsi</label>
                                    <textarea name="long_desc" id="long_desc" class="form-control form-input" placeholder="Deskripsi Mata Air"
                                        cols="30" rows="10">{{ isset($data) ? $data->long_desc : old('long_desc') }}</textarea>
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
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('mata_air.save_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="modal-header">
                        <div class="modal-title">
                            Upload Dokumentasi
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close"> <span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                            <img src="{{ asset('thumbnail/no-image.png') }}" width="100%" id="view_img">
                            <label for="path">Path</label>
                            <input type="file" name="path" id="path" accept="image/*,image/png,image/jpeg"
                                class="form-control form-input" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i> Simpan</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-danger"><i
                                class="fas fa-times"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content-js')
    <script src="{{ asset('/') }}back/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({});
        })
        $('#path').change(function(event) {
            $("#view_img").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
    </script>
@endsection
