<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SecurityAlgorithms\MainSecurity;
use App\Http\Requests\ValidateFilesRequest;


use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  
    private $mainSecurity;

     public function __construct(MainSecurity $mainSecurity){
         
        $this->mainSecurity = $mainSecurity;
     }

    public function index ()
    {
        return view('home');
    }

    public function encryptFile(ValidateFilesRequest  $request)
    {
        $validated=$request->validated();
        $des="encrypted.";
        $fileExtection =$validated['sourceFile']->getClientOriginalExtension();
        $des=$des.$fileExtection;
        $des=$this->mainSecurity->Encryption($validated['sourceFile'],$validated['key'],$des,$validated['algorithm']);
        if ($des === false)
            return redirect()->back()->withErrors(['Encytpion Error']);
        return view("download")->with("file",$des);
    }


    public function decryptFile(ValidateFilesRequest  $request)
    { 
        $des="decrypted.";
        $validated=$request->validated();
        $fileExtection =$validated['sourceFile']->getClientOriginalExtension();
        $des=$des.$fileExtection;
        $des=$this->mainSecurity->Decryption($validated['sourceFile'],$validated['key'],$des,$validated['algorithm']);
        if ($des === false)
            return redirect()->back()->withErrors(['Encytpion Error']);
        return view("download")->with("file",$des);
    }
    


        
}
