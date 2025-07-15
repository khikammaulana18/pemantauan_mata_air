<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MataAir;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    //
    public function index(){
        $data = MataAir::latest()->get();
        return view('back.pages.peta.index',compact(['data']));
    }
}
