<?php


namespace App\Http\Controllers\SecurityAlgorithms;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use RuntimeException;


class AESAlgo implements   MainSecurity

{
     /**
     * Define the number of blocks that should be read from the source file for each chunk.
     * We chose 255 because on decryption we want to read chunks of 4kb ((255 + 1)*16).
     */
    private   $FILE_ENCRYPTION_BLOCKS=255;

    public function Encryption($sourceFile, $key, $destinationFile, $AlogrithmMode='AES-256-CBC')
    {   
        $initialzationVector = openssl_random_pseudo_bytes(16);
        $error = false;
        if ($fpOut = fopen($destinationFile, 'w')) {
            // Put the initialzation vector to the beginning of the file
            fwrite($fpOut, $initialzationVector);
            if ($fpIn = fopen($sourceFile, 'rb')) {
                while (!feof($fpIn)) {
                    $plaintext = fread($fpIn, 16 * $this->FILE_ENCRYPTION_BLOCKS);
                    $ciphertext = openssl_encrypt($plaintext, $AlogrithmMode, $key, OPENSSL_RAW_DATA, $initialzationVector);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $initialzationVector = substr($ciphertext, 0, 16);
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

        return $error ? false : $destinationFile;
    }

    public function Decryption($sourceFile, $key, $destinationFile,$AlogrithmMode='AES-256-CBC')
    {
       
        $error = false;
        if ($fpOut = fopen($destinationFile, 'w')) {
            if ($fpIn = fopen($sourceFile, 'rb')) {
                // Get the initialzation vector from the beginning of the file
                $initialzationVector = fread($fpIn, 16);
                while (!feof($fpIn)) {
                    // we have to read one block more for decrypting than for encrypting
                    $ciphertext = fread($fpIn, 16 * ($this->FILE_ENCRYPTION_BLOCKS + 1));
                    $plaintext = openssl_decrypt($ciphertext, $AlogrithmMode, $key, OPENSSL_RAW_DATA, $initialzationVector);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $initialzationVector = substr($ciphertext, 0, 16);
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
        
        return $error ? false : $destinationFile;
    }

}
