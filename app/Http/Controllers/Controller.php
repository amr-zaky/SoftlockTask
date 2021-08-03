<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SecurityAlgorithms\AECAlgo;
use App\Http\Controllers\SecurityAlgorithms\MainSecurity;
use App\Http\Requests\ValidateFilesRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
   // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $mainSecurity;

     public function __construct(AECAlgo $mainSecurity){
        $this->mainSecurity = $mainSecurity;
     }

    public function index ()
    {
        return view('home');
    }

    public function encryptFile(ValidateFilesRequest  $request)
    {
    
        $des="encrypted.";
        $fileInfo=$request->file("sourceFile");
        $fileExtection =$request->file("sourceFile")->getClientOriginalExtension();
        $des=$des.$fileExtection;
        $key=$request->input("key");
        $alogrithmMode=$request->input("algorithm");
        $des=$this->mainSecurity->Encryption($fileInfo,$key,$des,$alogrithmMode);

        return view("download")->with("file",$des);
    }


    public function decryptFile(ValidateFilesRequest  $request)
    { 
      
        $des="decrypted.";
        $fileInfo=$request->file("sourceFile");
        $fileExtection =$request->file("sourceFile")->getClientOriginalExtension();
        $des=$des.$fileExtection;
        $key=$request->input("key");
        $alogrithmMode=$request->input("algorithm");
        $des=$this->mainSecurity->Decryption($fileInfo,$key,$des,$alogrithmMode);
        return view("download")->with("file",$des);
    }


        
}
