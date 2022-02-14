<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Uploader
{
    /**
     * @param  UploadedFile $file
     * @param  string $path
     * @return string
     */
    public static function store(UploadedFile $file, string $path)
    {
        return asset( env('APP_URL') . "/contents/" . Storage::put($path, $file));
    }
}
