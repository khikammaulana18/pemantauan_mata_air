<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

use App\Models\Laporan;
use App\Models\MataAir;
use App\Models\Pemantauan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    //
    public function index(Request $request){
        
        return view('back.pages.laporan.index');
    }
    public function MataAir(Request $request){
        if ($request->ajax()) {
            $data = MataAir::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('lokasi', function (MataAir $mataAir) {
                    return '<p> Alamat : ' . $mataAir->alamat_mata_air . ' <br>  Koordinat <br> Lat : ' . $mataAir->lat . ' <br> Lng : ' . $mataAir->lng . ' <p>';
                })
                ->addColumn('status', function (MataAir $mataAir) {
                    return $mataAir->status_mata_air == 0 ? '<span class="badge bg-danger">Tidak aktif</span>' : '<span class="badge bg-success">aktif</span>';
                })
                ->addColumn('action', function (MataAir $mataAir) {
                    return '<a href="' . route('laporan.mata_air.detail', $mataAir->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
                })
                ->rawColumns(['lokasi', 'action', 'status'])
                ->make();
        }
        return view('back.pages.laporan.mata_air');
    }
    public function detail_mata_air(Request $request,string $id){
        $data = MataAir::findOrFail($id);
        return view('back.pages.laporan.detail_mata_air',compact(['data']));
    }
    public function Pemantauan(Request $request){
        $s = $request->get('s') != null ? $request->get('s') : '';
        $l = $request->get('l') != null ? $request->get('l') : '';
        
        if($request->ajax()){
            $where = [];
            if($request->input('s') != null){
                array_push($where,['pemantauan.tgl_pemantauan','>=',date_format(date_create($request->get('s')),'Y-m-d 00:00:00')]);
            }
            if($request->input('l') != null){
                array_push($where,['pemantauan.tgl_pemantauan','<=',date_format(date_create($request->get('l')),'Y-m-d 23:59:59')]);
            }
            $data = Pemantauan::where($where)->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('nama_mata_air',function(Pemantauan $p){
                return $p->MataAir->nama_mata_air;
            })
            ->addColumn('debit_mata_air',function(Pemantauan $p){
                return $p->debit_mata_air.' m3/detik';
            })
            ->addColumn('tgl_pemantauan',function(Pemantauan $p){
                return date_format(date_create($p->tgl_pemantauan),'d M, Y');
            })
           
            
            ->rawColumns(['tgl_pemantauan','debit_mata_air','nama_mata_air'])
            ->make();
        }
        return view('back.pages.laporan.pemantauan',compact(['s','l']));
    }
    public function Pelaporan(Request $request){
        $s = $request->get('s') != null ? $request->get('s') : '';
        $l = $request->get('l') != null ? $request->get('l') : '';
        
        if($request->ajax()){
            $where = [];
            if($request->input('s') != null){
                array_push($where,['laporan.tgl_pelaporan','>=',date_format(date_create($request->get('s')),'Y-m-d 00:00:00')]);
            }
            if($request->input('l') != null){
                array_push($where,['laporan.tgl_pelaporan','<=',date_format(date_create($request->get('l')),'Y-m-d 23:59:59')]);
            }
            $data = Laporan::where($where)->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('mata_air',function(Laporan $laporan){
                return $laporan->MataAir->nama_mata_air;
            })
            ->addColumn('pelapor',function(Laporan $laporan){
                return '<h5>'.$laporan->nama.'</h5><p>'.$laporan->job.'</p>';
            })
            ->addColumn('tgl_pelaporan',function(Laporan $laporan){
                return date_format(date_create($laporan->tgl_pelaporan),'d M, Y');
            })
            ->addColumn('status_laporan',function(Laporan $laporan){
               switch($laporan->status_laporan){
                case '0':
                    return '<span class="badge bg-primary">Baru</span>';
                case '1':
                    return '<span class="badge bg-warning">Dalam Penanganan</span>';
                case '2':
                    return '<span class="badge bg-success">Ditangani</span>';
               }
                
            })
            
            ->rawColumns(['tanggal_pelaporan','status_laporan','pelapor'])
            ->make();
        }
        return view('back.pages.laporan.pelaporan',compact(['s','l']));
    }
  
}
