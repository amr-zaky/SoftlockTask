<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFilesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,doc,docx,pdf|
        return [
            "sourceFile"=>"required|max:10000" ,
            "key"=>"required|min:32,max:32",      
            "algorithm"   =>"required|in:AES-256-CBC" ,     
        ];
    }

}
