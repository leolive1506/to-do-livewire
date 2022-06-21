<?php

namespace App\Domains\Storage\Service;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    public static function deleteFileStorage($filename, $disk = 'local')
    {
        Storage::disk($disk)->delete($filename);
    }
}
