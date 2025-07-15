<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MataAir;
use App\Models\Media;
use App\Models\MediaMataAir;
use Illuminate\Http\Request;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class MataAirController extends Controller
{
    //
    public function index(Request $request)
    {
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
                    $result = '<form action="' . route('mata_air.destroy', $mataAir->id) . '" method="POST" enctype="multipart/form-data">
                ' . method_field('DELETE') . '
                ' . csrf_field() . '
              
                ';
                    $result .= '<a href="' . route('mata_air.edit', $mataAir->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
                    $result .= '|<button type="submit" class="btn btn-sm btn-danger form-confirm"><i class="fas fa-trash"></i></button>';

                    $result .= '</form>';
                    return $result;
                })
                ->rawColumns(['lokasi', 'action', 'status'])
                ->make();
        }
        return view('back.pages.sumber.index');
    }
    public function create()
    {
        return view('back.pages.sumber.form');
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_mata_air' => ['required'],
            'short_desc' => ['required'],
            'alamat_mata_air' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'kondisi' => ['required'],
            'status_mata_air' => ['required'],
        ]);
        if ($validate->fails()) {
            $error = '<ul>';
            foreach ($validate->messages() as $error) {
                $error .= '<li>' . $error . '</li>';
            }
            $error .= '</ul>';
            return redirect()->back()->with('error', $error)->withInput();
        }
        $data = [
            'nama_mata_air' => $request->nama_mata_air,
            'short_desc' => $request->short_desc,
            'alamat_mata_air' => $request->alamat_mata_air,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'kondisi' => $request->kondisi,
            'status_mata_air' => $request->status_mata_air,
            'long_desc' => $request->long_desc != null ? $request->long_desc : '-',
        ];
        $insert = MataAir::insertGetId($data);
        if ($insert) {
            if(is_array($request->file('dokumentasi'))){
                foreach($request->file('dokumentasi') as $d){
                   $image = $this->uploadFileUploaded($d);
                   $mediaInsert = Media::insertGetId([
                        'nama_media' => $d->getClientOriginalName(),
                        'type' => $d->getClientOriginalExtension(),
                        'path' => $image
                   ]);
                   if($mediaInsert){
                    MediaMataAir::insert([
                        'mata_air_id' => $insert,
                        'media_id' => $mediaInsert
                    ]);
                   }
                }
            }
            return redirect()->route('mata_air')->with('success', 'Input Data Berhasil !');
        }
        return redirect()->back()->with('error', 'Oops, Ada kesalahan. silahkan coba lagi !');

    }
    public function edit(string $id)
    {
        $data = MataAir::findOrFail($id);
        return view('back.pages.sumber.edit', compact(['data']));
    }
    public function update(Request $request, string $id)
    {
        $oldData = MataAir::findOrFail($id);
        $validate = Validator::make($request->all(), [
            'nama_mata_air' => ['required'],
            'short_desc' => ['required'],
            'alamat_mata_air' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'kondisi' => ['required'],
            'status_mata_air' => ['required'],
        ]);
        if ($validate->fails()) {
            $error = '<ul>';
            foreach ($validate->messages() as $error) {
                $error .= '<li>' . $error . '</li>';
            }
            $error .= '</ul>';
            return redirect()->back()->with('error', $error)->withInput();
        }
        $data = [
            'nama_mata_air' => $request->nama_mata_air,
            'short_desc' => $request->short_desc,
            'alamat_mata_air' => $request->alamat_mata_air,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'kondisi' => $request->kondisi,
            'status_mata_air' => $request->status_mata_air,
            'long_desc' => $request->long_desc,
        ];
        if ($oldData->update($data)) {
            return redirect()->back()->with('success', 'Update Data Berhasil !');
        }
        return redirect()->back()->with('error', 'Oops, Ada kesalahan. silahkan coba lagi !');

    }
    public function destroy(string $id)
    {
        $data = MataAir::findOrFail($id);
        foreach ($data->Media as $media) {
            $this->deleteFile($media->path);
            $media->delete();
        }
        $data->delete();
        return redirect()->back()->with('success', 'Hapus Data Berhasil');
    }

    public function show(string $id){
        $data = MataAir::findOrFail($id);
        return view('back.pages.sumber.show', compact(['data']));
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
                MediaMataAir::insert([
                    'mata_air_id' => $request->id,
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
