<?php


namespace App\Http\Controllers\SecurityAlgorithms;

use Exception;
use Illuminate\Support\Str;
use RuntimeException;


class AECAlgo implements   MainSecurity

{
    private   $FILE_ENCRYPTION_BLOCKS=10000;

    public function Encryption($source, $key, $dest,$AlogrithmMode='AES-256-CBC')
    {
        
        $iv = openssl_random_pseudo_bytes(16);
        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            // Put the initialzation vector to the beginning of the file
            fwrite($fpOut, $iv);
            if ($fpIn = fopen($source, 'rb')) {
                while (!feof($fpIn)) {
                    $plaintext = fread($fpIn, 16 * $this->FILE_ENCRYPTION_BLOCKS);
                    $ciphertext = openssl_encrypt($plaintext, $AlogrithmMode, $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $ciphertext);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }

        return $error ? false : $dest;
    }

    public function Decryption($source, $key, $dest,$AlogrithmMode='AES-256-CBC')
    {
       
        $error = false;
        if ($fpOut = fopen($dest, 'w')) {
            if ($fpIn = fopen($source, 'rb')) {
                // Get the initialzation vector from the beginning of the file
                $iv = fread($fpIn, 16);
                while (!feof($fpIn)) {
                    // we have to read one block more for decrypting than for encrypting
                    $ciphertext = fread($fpIn, 16 * ($this->FILE_ENCRYPTION_BLOCKS + 1));
                    $plaintext = openssl_decrypt($ciphertext, $AlogrithmMode, $key, OPENSSL_RAW_DATA, $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $plaintext);
                }
                fclose($fpIn);
            } else {
                $error = true;
            }
            fclose($fpOut);
        } else {
            $error = true;
        }
    
        return $error ? false : $dest;
    }





}
