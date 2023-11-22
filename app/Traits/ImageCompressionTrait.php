<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageCompressionTrait
{
    public function compressImage($filePath)
    {
        $image = Image::make($filePath);

        // Resize the image to specific dimensions
        $image->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Adjust the quality value as per your requirements
        $image->save($filePath, 90); // 90 is the quality percentage

        return $filePath;
    }
}
