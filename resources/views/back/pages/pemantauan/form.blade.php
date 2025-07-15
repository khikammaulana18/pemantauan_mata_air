@extends('back.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pemantauan</h3>
                    <h6 class="op-7 mb-2">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pemantauan disini !</h6>
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
                                Form Data Pemantauan
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('pemantauan') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form
                            action="{{ isset($data) ? route('pemantauan.update', $data->id) : route('pemantauan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method(isset($data) ? 'PUT' : 'POST')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mata_air_id">Mata Air</label>
                                            <select name="mata_air_id" id="mata_air_id"
                                                class="form-control form-select-input" required>
                                                <option value="">-- Pilih Mata Air --</option>
                                                @foreach ($mata_air as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_mata_air }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_pemantauan">Tanggal Pemantauan</label>
                                            <input type="date" name="tgl_pemantauan" id="tgl_pemantauan"
                                                placeholder="Tanggal Pemantauan" class="form-control form-input" value="{{old('tgl_pemantauan')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="debit_mata_air">Debit Mata air (m3/detik)</label>
                                    <input type="number" name="debit_mata_air" id="debit_mata_air"
                                        class="form-control form-input" placeholder="Debit Mata Air" value="{{old('debit_mata_air')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi_air">Kondisi Air</label>
                                    <input type="text" name="kondisi_air" id="kondisi_air" value="{{old('kondisi_air')}}"
                                        class="form-control form-input" placeholder="Kondisi Air" required>
                                </div>
                                <div class="form-group">
                                    <label for="kerusakan">Kerusakan</label>
                                    <textarea name="kerusakan" id="kerusakan" placeholder="Kerusakan" class="form-control form-input" cols="30"
                                        rows="10">{{old('kerusakan')}}</textarea>
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
