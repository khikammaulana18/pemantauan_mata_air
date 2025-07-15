<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MataAir;
use App\Models\Media;
use App\Models\MediaLaporan;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class PelaporanController extends Controller
{
    //
    public function index(Request $request){
        if($request->ajax()){
            $data = Laporan::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('mata_air',function(Laporan $laporan){
                return $laporan->MataAir->nama_mata_air;
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
            ->addColumn('action',function(Laporan $laporan){
                $result = '<form action="'.route('pelaporan.destroy',$laporan->id).'" method="POST" enctype="multipart/form-data">
                '.method_field('DELETE').'
                '.csrf_field().'
                
               <a href="'.route('pelaporan.edit',$laporan->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
             
                    $result .='|<button type="submit" class="btn btn-sm btn-danger form-confirm"><i class="fas fa-trash"></i></button>';
                
            $result .='</form>';
            return $result;
            })
            ->rawColumns(['action','tanggal_pelaporan','status_laporan'])
            ->make();
        }
        return view('back.pages.pelaporan.index');
    }
    public function create(){
        $mata_air = MataAir::latest()->get();
        return view('back.pages.pelaporan.form',compact(['mata_air']));
    }
    public function edit(string $id){
        $mata_air = MataAir::latest()->get();
        $data = Laporan::findOrFail($id);
        return view('back.pages.pelaporan.edit',compact(['mata_air','data']));
    }
    public function store(Request $request){
        $count = Laporan::count() + 1;
        $validator = Validator::make($request->all(),[
            'mata_air_id' => ['required'],
            'nama' => ['required'],
            'job' => ['required'],
        ]);
        if($validator->fails()){
            $error = '';
            foreach($validator->errors()->all() as $e){
                $error .= $e.'<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $data = [
            'mata_air_id' => $request->mata_air_id,
            'nama' => $request->nama,
            'job' => $request->job,
            'desc_laporan' => $request->desc_laporan != null ? $request->desc_laporan : '-',
            'kode_laporan' => 'LA00'.$count,
            'status_laporan' => '0'
        ];
        $insert = Laporan::insertGetId($data);
        if($insert){
            if(is_array($request->file('dokumentasi'))){
                foreach($request->file('dokumentasi') as $d){
                   $image = $this->uploadFileUploaded($d);
                   $mediaInsert = Media::insertGetId([
                        'nama_media' => $d->getClientOriginalName(),
                        'type' => $d->getClientOriginalExtension(),
                        'path' => $image
                   ]);
                   if($mediaInsert){
                    MediaLaporan::insert([
                        'laporan_id' => $insert,
                        'media_id' => $mediaInsert
                    ]);
                   }
                }
            }
            return redirect()->route('pelaporan')->with('success','Input Data Berhasil');
        }
        return redirect()->back()->with('error','Oops, Ada kesalahan.silahkan coba lagi !');
    }
    public function update(Request $request,string $id){
        $oldData = Laporan::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'mata_air_id' => ['required'],
            'nama' => ['required'],
            'job' => ['required'],
            'status_laporan' => ['required']
        ]);
        if($validator->fails()){
            $error = '';
            foreach($validator->errors()->all() as $e){
                $error .= $e.'<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $data = [
            'mata_air_id' => $request->mata_air_id,
            'nama' => $request->nama,
            'job' => $request->job,
            'desc_laporan' => $request->desc_laporan != null ? $request->desc_laporan : $oldData->laporan,
            'status_laporan' => $request->status_laporan
        ];
        if($oldData->update($data)){
            return redirect()->back()->with('success','Update Data Berhasil');
       }
       return redirect()->back()->with('error','Oops, Ada kesalahan. silahkan coba lagi !');

    }
    public function destroy(string $id){
        $data = Laporan::findOrFail($id);
        foreach ($data->Media as $media) {
            $this->deleteFile($media->path);
            $media->delete();
        }
        $data->delete();
        return redirect()->back()->with('success', 'Hapus Data Berhasil');
    }
    public function saveImage(Request $request){
        $validator = Validator::make($request->all(),[
            'path' => ['required']
        ]);
        if($validator->fails()){
            $error = '';
            foreach($validator->errors()->all() as $e){
                $error .= $e.'<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $upload = $this->uploadFile($request,'path');
        if($upload != null){
            $data = [
                'path' => $upload,
                'nama_media' => $request->file('path')->getClientOriginalName(),
                'type' => $request->file('path')->getClientOriginalExtension()
            ];
            $id = Media::insertGetId($data);
            if($id){
                MediaLaporan::insert([
                    'laporan_id' => $request->id,
                    'media_id' => $id
                ]);
                return redirect()->back()->with('success','Input Data Berhasil');
                
            }
            return redirect()->back()->with('error','Oops, Ada kesalahan, silahkan coba lagi !');
        }
        return redirect()->back()->with('error','Foto Tidak boleh kosong !');
    }
    public function deleteImage(string $id){
        $data = Media::findOrFail($id);
        $this->deleteFile($data->path);
        $data->delete();
        return redirect()->back()->with('success','Hapus Data Berhasil');
    }
}
