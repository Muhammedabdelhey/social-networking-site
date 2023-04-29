<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\File;

trait ManageFileTrait
{
    function uploadFile( $request, $fileName, $foldarName)
    {
        
        if ($request->hasfile($fileName)&&$request->$fileName!==Null) {
            $path = $request->file($fileName)->store($foldarName, 'mypublic');
            return $path;
        } else {
            return null;
        }
    }

    function deleteFile($path)
    {
        if (file_exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    function getFile($path)
    {
        try {
            return response()->file(public_path($path));
        } catch (Exception $e) {
            return "an error can't find Image";
        }
    }
}
