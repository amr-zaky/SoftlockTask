<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SecurityAlgorithms\MainSecurity;
use App\Http\Requests\ValidateFilesRequest;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
  
    private $mainSecurity;

     public function __construct(MainSecurity $mainSecurity){
         //initialization mainSerurity Object 
        $this->mainSecurity = $mainSecurity;
     }

    public function index()
    {
        return view('home');
    }

    public function encryptFile(ValidateFilesRequest  $request)
    {
        //collect Request Data 
        $validated=$request->validated();
        //create destination File and set the extension
        $destinationFile="encrypted.";
        $SourcefileExtection =$validated['sourceFile']->getClientOriginalExtension();
        $destinationFile=$destinationFile.$SourcefileExtection;

        //call encryption function 
        $destinationFile=$this->mainSecurity->Encryption($validated['sourceFile'],$validated['key'],$destinationFile,$validated['algorithm']);
      
        // check the Encryption 
        if ($destinationFile === false)
            return redirect()->back()->withErrors(['Encytpion Error']);

        return view("download")->with("file",$destinationFile);
    }


    public function decryptFile(ValidateFilesRequest  $request)
    { 
        //collect Request Data 
        $validated=$request->validated();

        //create destination File and set the extension
        $destinationFile="decrypted.";
        $SourcefileExtection =$validated['sourceFile']->getClientOriginalExtension();
        $destinationFile=$destinationFile.$SourcefileExtection;

        //call decryption function 
        $destinationFile=$this->mainSecurity->Decryption($validated['sourceFile'],$validated['key'],$destinationFile,$validated['algorithm']);
        
        // check the decryption 
        if ($destinationFile === false)
            return redirect()->back()->withErrors(['Decytpion Error']);
        return view("download")->with("file",$destinationFile);
    }
    
    
}
