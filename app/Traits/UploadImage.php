<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait UploadImage
{
    public function saveImage($request, $disk)
    {
        $name = uniqid(5) . $request->getClientOriginalName();
        $request->storeAs('', $name, $disk);
        return $name;
        // $data['logo'] = "uploads/logo/" .   $name;
    }
    public function deleteImage($image)
    {
        return File::delete(ltrim(parse_url($image)['path'], '/'));
    }
}