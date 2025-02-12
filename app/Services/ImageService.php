<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Upload an image and return its storage path.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function uploadImage(UploadedFile $file, string $directory = 'products'): string
    {
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs("public/$directory", $imageName);

        return str_replace('public/', '', $path); // Return relative path
    }

    /**
     * Delete an image from storage.
     *
     * @param string|null $imagePath
     * @return bool
     */
    public function deleteImage(?string $imagePath): bool
    {
        if ($imagePath && Storage::exists("public/$imagePath")) {
            return Storage::delete("public/$imagePath");
        }
        return false;
    }
}
