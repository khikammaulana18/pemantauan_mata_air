@extends('back.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Sumber Mata Air</h3>
                    <h6 class="op-7 mb-2">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Sumber mata air disini !</h6>
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
                                Form Data Sumber Mata Air
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('mata_air') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ isset($data) ? route('mata_air.update', $data->id) : route('mata_air.store') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method(isset($data) ? 'PUT' : 'POST')
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
                                <div class="form-group">
                                    <div id="img-list" class="d-flex">

                                    </div>
                                    <label for="dokumentasi">Dokumentasi</label>
                                    <input type="file" name="dokumentasi[]" id="dokumentasi"
                                        class="form-control form-input" accept="image/*,image/png,image/jpeg" multiple>
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
        function onChangeDokumentasi() {

            const files = $('#dokumentasi')[0].files;
            let list = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                let url = URL.createObjectURL(file);
                list +=
                    '<div class="m-2" style="width: fit-content;" id="file-item" data-index="' +
                    i +
                    '"><div class="card-header"><div class="card-tools"><button type="button" class="close" onclick="deleteDokumentasi(' +
                    i + ')">&times;</button></div><div class="card-body"><img src="' + url +
                    '" height="50" class="img"></div></div></div>';
            }
            $('#img-list').html(list);
        }

        function deleteDokumentasi(index) {
            var dt = new DataTransfer();
            let files = $('#dokumentasi')[0].files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i]
                if (index !== i) dt.items.add(file)
                $('#dokumentasi')[0].files = dt.files;
            }
            onChangeDokumentasi();
        }
        $(document).ready(function() {
            $('#dokumentasi').on('change', onChangeDokumentasi);
            onChangeDokumentasi();
        })
    </script>
@endsection
