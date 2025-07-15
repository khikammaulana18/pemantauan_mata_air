@extends('back.layouts.app')
@section('content-js')
    <script src="{{asset('/')}}back/js/plugin/datatables/datatables.min.js"></script>
    <script>
      $(document).ready(function() {
          $('#datatables').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ url()->current() }}',
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
                    data: 'nama',
                    name : 'nama',
                    
                  },
                  {
                    data: 'job',
                    name : 'job',
                    
                  },
                  {
                    data: 'status_laporan',
                    name : 'status_laporan',
                    
                  },
                  {
                      data: 'action',
                      name: 'action'
                  },

              ]
          });
      });
  </script>
@endsection
@section('content')
    
<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
      >
        <div>
          <h3 class="fw-bold mb-3">Data Pelaporan</h3>
          <h6 class="op-7 mb-2">Data Pelaporan akan muncul disini !</h6>
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
                        Data Pelaporan
                    </div>
                    <div class="card-tool">
                        <a href="{{route('pelaporan.create')}}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Mata Air</th>
                                <th>Nama</th>
                                <th>Job</th>
                                <th>Status</th>
                                <th>Aksi</th>
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