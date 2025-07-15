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
                                                    <form action="{{ route('pelaporan.delete_image', $item->id) }}"
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
                                Form Data Laporan
                            </div>
                            <div class="card-tool">
                                <a href="{{ route('pelaporan') }}" class="btn btn-danger btn-sm"><i
                                        class="fas fa-arrow-right"></i> Kembali</a>
                            </div>
                        </div>
                        <form action="{{ route('pelaporan.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="mata_air_id">Mata Air</label>
                                    <select name="mata_air_id" id="mata_air_id" class="form-control form-select-input"
                                        required>
                                        <option value="">-- Pilih Mata Air --</option>
                                        @foreach ($mata_air as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $data->mata_air_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_mata_air }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control form-input"
                                        placeholder="Nama" value="{{ $data->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="job">Pekerjaan</label>
                                    <input type="text" name="job" id="job" class="form-control form-input"
                                        placeholder="Pekerjaan" value="{{ $data->job }}">
                                </div>
                                <div class="form-group">
                                    <label for="desc_laporan">Keterangan</label>
                                    <textarea name="desc_laporan" placeholder="Keterangan Laporan" id="desc_laporan" class="form-control" cols="30"
                                        rows="10">{{ $data->desc_laporan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status_laporan">Status Laporan</label>
                                    <select name="status_laporan" id="status_laporan" class="form-control form-input" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="0" {{$data->status_laporan == '0' ? 'selected' : ''}}>Baru</option>
                                        <option value="1" {{$data->status_laporan == '1' ? 'selected' : ''}}>Dalam Penanganan</option>
                                        <option value="2" {{$data->status_laporan == '2' ? 'selected' : ''}}>Sudah Ditangani</option>
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
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pelaporan.save_image') }}" method="POST" enctype="multipart/form-data">
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
