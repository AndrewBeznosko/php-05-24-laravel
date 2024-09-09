<?php

namespace App\Services;

use App\Services\Contracts\FileServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService implements FileServiceContract
{
    public function upload(string|UploadedFile $file, string $additionalPath = ''): string
    {
        if (is_string($file)) {
            return str_replace('public/storage/', '', $file);
        }

        $additionalPath = !empty($additionalPath) ? $additionalPath . '/' : '';

        $filePath = $additionalPath . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalName();

        Storage::put($filePath, file_get_contents($file));
        Storage::setVisibility($filePath, 'public');

        return $filePath;
    }

    public function remove(string $path): void
    {
        Storage::delete($path);
    }
}
