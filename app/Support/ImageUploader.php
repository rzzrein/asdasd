<?php

namespace App\Support;

use App\Helpers\ImageHelper;
use App\Repositories\ImageRepository;

class ImageUploader
{
    private $image_helper;

    function __construct(ImageHelper $image_helper, ImageRepository $image)
    {
        $this->image_helper = $image_helper;
        $this->image = $image;
    }

    public function upload($image, $type = null)
    {
        $file = $this->image->upload($image, ['thumb', 'small', 'medium', 'large'], $type);
        return $file;

        // return [
        //     'type' => $type,
        //     'size' => $file['size'],
        //     'width' => $file['width'],
        //     'height' => $file['height'],
        //     'mime_type' => $file['mime_type'],
        //     'file_name' => $file['file_name'],
        //     'path' => $file['path'],
        // ];
    }
}
