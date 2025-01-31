<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

trait HasImages
{
    public function storeImage(UploadedFile $file, string $path, int $width = 1200)
    {
        // Create image instance
        $image = Image::make($file);

        // Resize the image while maintaining aspect ratio
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Ensure the directory exists
        Storage::disk('public')->makeDirectory($path);

        // Store the image
        Storage::disk('public')->put(
            $path . '/' . $filename,
            (string) $image->encode()
        );

        return $path . '/' . $filename;
    }

    public function deleteImage(?string $path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}