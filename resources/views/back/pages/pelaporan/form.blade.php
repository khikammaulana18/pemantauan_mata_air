@extends('back.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pelaporan</h3>
                    <h6 class="op-7 mb-2">{{ isset($data) ? 'Edit' : 'Tambah' }} Data Pelaporan disini !</h6>
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
                                Form Data Pelaporan
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('pelaporan') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ route('pelaporan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="mata_air_id">Mata Air</label>
                                    <select name="mata_air_id" id="mata_air_id" class="form-control form-select-input"
                                        required>
                                        <option value="">-- Pilih Mata Air --</option>
                                        @foreach ($mata_air as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_mata_air }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" name="nama" id="nama" class="form-control form-input" placeholder="Nama" value="{{old('nama')}}">
                                </div>
                                <div class="form-group">
                                  <label for="job">Pekerjaan</label>
                                  <input type="text" name="job" id="job" class="form-control form-input" placeholder="Pekerjaan" value="{{old('job')}}">
                                </div>
                                <div class="form-group">
                                  <label for="desc_laporan">Keterangan</label>
                                  <textarea name="desc_laporan" placeholder="Keterangan Laporan" id="desc_laporan" class="form-control" cols="30" rows="10">{{old('desc_laporan')}}</textarea>
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
