<?php


namespace App\Http\Controllers\SecurityAlgorithms;

interface MainSecurity
{

    public function Encryption($source, $key, $dest,$AlogrithmMode);
    public function  Decryption($source, $key, $dest,$AlogrithmMode);
}
