<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;



abstract class Controller
{
    //

    public $directory = 'uploads';


    public function __construct()
    {
        
    }
    public function uploadFile(Request $request,$inputName = null){
        $result = null;
        if($inputName == null) return;
        if($request->hasFile($inputName)){
            $uploadName = Date('Ymdhis').$request->file($inputName)->getClientOriginalName();
            $upload = $request->file($inputName)->move($this->directory,$uploadName);
            $result = $uploadName;
        }
        return $result;
    }

    public function uploadFileUploaded(UploadedFile $file){
        
        $uploadName = Date('Ymdhis').$file->getClientOriginalName();
        $file->move($this->directory,$uploadName);
        return $uploadName;
    }
    public function deleteFile(string $filename = null){
        $result = false;
        if($filename == null) return;
        if($filename != '-' && file_exists($this->directory.'/'.$filename)){
            unlink($this->directory.'/'.$filename);
            $result = true;
        }
        return $result;
    }

}
