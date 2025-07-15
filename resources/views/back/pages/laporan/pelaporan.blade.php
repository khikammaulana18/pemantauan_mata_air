@extends('back.layouts.app')
@section('content-js')
    <script src="{{ asset('/') }}back/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                processing: true,
                serverSide: true,
                type: 'GET',
                ajax: '{{ url()->current() }}?s={{$s}}&l={{$l}}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                      data: 'tgl_pelaporan',
                      name : 'tgl_pelaporan',
                      
                    },
                    {
                      data: 'mata_air',
                      name : 'mata_air',
                      
                    },
                    {
                      data: 'pelapor',
                      name : 'pelapor',
                      
                    },
                    {
                      data: 'desc_laporan',
                      name : 'desc_laporan',
                      
                    },
                    {
                      data: 'status_laporan',
                      name : 'status_laporan',
                      
                    },
                    

                ]
            });
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Laporan Pelaporan Sumber Mata Air</h3>
                    <h6 class="op-7 mb-2">Laporan Pelaporan Sumber Mata Air akan muncul disini !</h6>
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
                                Laporan Pelaporan Sumber Mata Air
                            </div>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('laporan.pelaporan') }}" method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                       
                                           
                                            <input type="date" name="s" id="s" value="{{ $s }}"
                                                class="form-control form-input">
                                        
                                    </div>
                                    <div class="col-md-5">
                                       
                                           
                                            <input type="date" name="l" id="l" value="{{ $l }}"
                                                class="form-control form-input">
                                       
                                    </div>
                                    <div class="col-md-2">
                                            <button type="submit" class="btn btn-success form-control"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-reponsive">
                                <table class="table table-striped" id="datatables">
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Mata Air</th>
                                        <th>Pelapor</th>
                                        <th>Laporan</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
