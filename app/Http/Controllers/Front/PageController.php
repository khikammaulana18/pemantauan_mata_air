<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\MataAir;
use App\Models\Media;
use App\Models\MediaLaporan;
use Illuminate\Http\Request;
use Validator;

class PageController extends Controller
{
    //
    public function index(){
        return view('front.pages.home');
    }
    public function peta(){
        $data = MataAir::latest()->get();
        return view('front.pages.peta',compact(['data']));
    }
    public function detailMap(string $id){
        $data = MataAir::findOrFail($id);
        return view('front.pages.detail_peta',compact(['data']));
    }
    public function lapor(){
        $data = MataAir::latest()->get();
        return view('front.pages.lapor',compact(['data']));
    }
    public function saveLapor(Request $request){
        //Save Laporan Masyarakat
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
            return redirect()->back()->with('success','Terimakasih telah melapor, Laporan anda akan kami tindaklanjuti segera !');
        }
        return redirect()->back()->with('error','Oops, Ada kesalahan.silahkan coba lagi !');
    
    }
}
