<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\MataAir;
use App\Models\Pemantauan;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = User::count();
        $pemantauan = Pemantauan::count();
        $laporan = Laporan::count();
        $new_laporan = Laporan::where('status_laporan','=','0')->latest()->get();
        $data_mata_air = MataAir::latest()->get();
        $sumber = MataAir::count();
        return view('back.pages.dashboard', compact(['user', 'pemantauan', 'laporan', 'sumber','new_laporan','data_mata_air']));
    }
    public function profile()
    {
        $data = User::findOrFail(auth()->user()->id);
        if(auth()->user()->role === 'pelapor'){
            return view('front.pages.profile', compact('data'));
        }
        return view('back.pages.user.profile', compact('data'));
    }

    public function saveProfile(Request $request)
    {
        $oldData = User::findOrFail(auth()->user()->id);
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required']
        ]);
        if ($validate->failed()) {
            $error = '';
            foreach($validate->errors()->all() as $e){
                $error .= $e.'<br>';
            }
            return redirect()->back()->with('error', $error)->withInput();
        }
        $image = $this->uploadFile($request, 'image');
        if ($image && $image != null) {
            $this->deleteFile($oldData->image);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password != null ? Hash::make($request->password) : $oldData->password,
            'image' => $image != null ? $image : $oldData->image
        ];

        if ($oldData->update($data)) {
            return redirect()->back()->with('success', 'Update Profile Berhasil');
        }
        return redirect()->back()->with('error', 'Oops, Ada kesalahan. silahkan coba lagi !');
    }

}
