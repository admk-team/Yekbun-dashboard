<?php

namespace App\Traits;

trait UploadMedia
{
    public static function index($file)
    {
        $imagePath = $file->store('public/images');

        $filtered_path = 'storage/' . explode('/', $imagePath, 2)[1];

        return $filtered_path;
    }
}
