<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait UploadsImages
{

    protected function storeImage(UploadedFile $file, $directory = 'images', $disk = 'public')
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(25) . '.' . $extension;
        $filePath = $file->storeAs($directory, $fileName, $disk);

        return $filePath ?: null;
    }


    protected function deleteImage($filename, $disk = 'public')
    {
        //check if image exist in file
        if(File::exists(public_path().'/storage/'.$filename)){
            File::delete(public_path().'/storage/'.$filename);
        }

    }
}
