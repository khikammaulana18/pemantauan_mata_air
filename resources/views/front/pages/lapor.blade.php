@extends('front.layouts.app')
@section('content')
    <!-- Contact Section -->
    <section id="lapor" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Aplikasi Pemantauan Sumber Mata Air</span>
            <h2>Lapor</h2>
            <p>Laporkan Kejadian atau perkara yang terkait dengan sumber air</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-12">
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
                    <form action="{{ route('lapor.save') }}" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        @csrf
                        @method('POST')
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <label for="mata_air_id" class="pb-2">Sumber Mata Air</label>
                                <select name="mata_air_id" id="mata_air_id" class="form-control" required>
                                    <option value="">-- Pilih Sumber --</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('mata_air_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_mata_air }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="pb-2">Nama</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    class="form-control" placeholder="Nama" required="">
                            </div>

                            <div class="col-md-6">
                                <label for="job" class="pb-2">Pekerjaan</label>
                                <input type="text" class="form-control" value="{{ old('nama') }}" name="job"
                                    id="job" placeholder="Pekerjaan" required="">
                            </div>

                            <div class="col-md-12">
                                <label for="desc_laporan" class="pb-2">Deskripsi</label>
                                <textarea class="form-control" name="desc_laporan" rows="10" id="desc_laporan" required=""></textarea>
                            </div>
                            <div class="col-md-12">
                                <div id="img-list" class="d-flex">

                                </div>
                                <label for="dokumentasi" class="pb-2">Dokumentasi</label>
                                <input type="file" name="dokumentasi[]" accept="image/jpg,image/png,image/jpeg,image/*"
                                    id="dokumentasi" class="form-control" placeholder="Dokumentasi" multiple>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit">Laporkan</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
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
                    '"><div class="card-header d-flex justify-content-between"><div></div><div class="card-tools"><button type="button" class="close btn btn-sm btn-light" onclick="deleteDokumentasi(' +
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
