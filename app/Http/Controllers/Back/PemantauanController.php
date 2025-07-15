<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MataAir;
use App\Models\Media;
use App\Models\MediaPemantauan;
use App\Models\Pemantauan;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class PemantauanController extends Controller
{
    //
    public function index(Request $request){
        if($request->ajax()){
            $data = Pemantauan::latest()->get();
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
           
            ->addColumn('action',function(Pemantauan $p){
                $result = '<form action="'.route('pemantauan.destroy',$p->id).'" method="POST" enctype="multipart/form-data">
                '.method_field('DELETE').'
                '.csrf_field().'
                <a href="'.route('pemantauan.edit',$p->id).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
             
                    $result .='|<button type="submit" class="btn btn-sm btn-danger form-confirm"><i class="fas fa-trash"></i></button>';
                
            $result .='</form>';
            return $result;
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('back.pages.pemantauan.index');
    }
    public function create(){
        $mata_air = MataAir::latest()->get();
        return view('back.pages.pemantauan.form',compact(['mata_air']));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'mata_air_id' => ['required'],
            'tgl_pemantauan' => ['required'],
            'debit_mata_air' => ['required'],
            'kondisi_air' => ['required'],
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
            'user_id' => auth()->user()->id,
            'tgl_pemantauan' => $request->tgl_pemantauan,
            'debit_mata_air' => $request->debit_mata_air,
            'kondisi_air' => $request->kondisi_air,
            'kerusakan' => $request->kerusakan != null ? $request->kerusakan : '-'
       ];
       $insert = Pemantauan::insertGetId($data);
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
                MediaPemantauan::insert([
                    'pemantauan_id' => $insert,
                    'media_id' => $mediaInsert
                ]);
               }
            }
        }
        return redirect()->route('pemantauan')->with('success','Input Data Berhasil');
       }
       return redirect()->back()->with('error','Oops, Ada kesalahan.silahkan coba lagi !');
    }
    public function edit(string $id){
        $data = Pemantauan::findOrFail($id);
        $mata_air = MataAir::latest()->get();
        return view('back.pages.pemantauan.edit',compact(['mata_air','data']));
    }
    public function update(Request $request,string $id){
        $oldData = Pemantauan::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'mata_air_id' => ['required'],
            'tgl_pemantauan' => ['required'],
            'debit_mata_air' => ['required'],
            'kondisi_air' => ['required'],
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
            'user_id' => auth()->user()->id,
            'tgl_pemantauan' => $request->tgl_pemantauan,
            'debit_mata_air' => $request->debit_mata_air,
            'kondisi_air' => $request->kondisi_air,
            'kerusakan' => $request->kerusakan != null ? $request->kerusakan : $oldData->kerusakan
       ];
       if($oldData->update($data)){
            return redirect()->back()->with('success','Update Data Berhasil');
       }
       return redirect()->back()->with('error','Oops, Ada kesalahan. silahkan coba lagi !');

    }
    public function destroy(string $id){
        $data = Pemantauan::findOrFail($id);
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
                MediaPemantauan::insert([
                    'pemantauan_id' => $request->id,
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
