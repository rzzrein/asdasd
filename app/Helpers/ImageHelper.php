<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageHelper
{
    /**
     * Default file storage
     * 'public' or 's3'
     */
    private const DISK = 'public';

    public static $dir = '';

    /**
     * Resize image from given url and size
     * Automatically upload thumbnail
     *
     * @param  string $file
     * @param  integer $height
     * @param  integer $width
     * @param  integer $crop
     * @return string S3 Path
     */
    public static function resize($file, int $width=null, int $height=null, $crop=true)
    {
        $file_name = (!is_string($file) && !empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);
        $img = is_string($file) ? Image::make(public_path($file)) : Image::make($file);
        $old_width = $img->width();
        $old_height = $img->height();

        /* Resize Image */
        if ($crop) {
            if (!empty($width) && !empty($height)) {
                $img = $img->fit($width, $height);
            } else if (!empty($width) && empty($height)) {
                $img = $img->fit($width, $old_height);
            } else if (!empty($height) && empty($width)) {
                $img = $img->fit($old_width, $height);
            }
        } else {
            if (!empty($width) && !empty($height)) {
                $img = $img->resize($width, $height);
            } else if (!empty($width) && empty($height)) {
                $img = $img->widen($width);
            } else if (!empty($height) && empty($width)) {
                $img = $img->heighten($height);
            }
        }

        return Self::putFile($img, $file_name);
    }

    /**
     * Convert Image
     * @param  image   $file
     * @param  int $size
     * @return string S3 Path
     */
    public static function convert($file, int $size=null)
    {
        $file_name = (!is_string($file) && !empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);
        $img        = is_string($file) ? Image::make(public_path($file)) : Image::make($file);
        $old_width  = $img->width();
        $old_height = $img->height();

        if ($old_width > $old_height) {
            $img = $img->widen($size);
        } else {
            $img = $img->heighten($size);
        }

        return Self::putFile($img, $file_name);
    }

    /**
     * Crop an image to specified aspect ratio with centered rectangle.
     *
     * @param  string $file
     * @param  integer $ratio_width
     * @param  integer $ratio_height
     * @return string S3 Path
     */
    public static function crop($file, $ratio_width, $ratio_height)
    {
        $file_name = (!is_string($file) && !empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);
        $src_image = is_string($file) ? Image::make(public_path($file)) : Image::make($file);

        $src_width = $src_image->width();
        $src_height = $src_image->height();

        $src_ratio = $src_width / $src_height;
        $dst_ratio = $ratio_width / $ratio_height;

        if ($src_ratio < $dst_ratio) {
            $dst_height = (int) ($src_width / $dst_ratio);
            $y = (int) (($src_height - $dst_height) / 2);
            $dst_image = $src_image->crop($src_width, $dst_height, 0, $y);
        } else {
            $dst_width = (int) ($src_height * $dst_ratio);
            $x = (int) (($src_width - $dst_width) / 2);
            $dst_image = $src_image->crop($dst_width, $src_height, $x, 0);
        }

        return Self::putFile($dst_image, $file_name);
    }

    /**
     * Create white canvas and fill it with source image file and watermark file (optional).
     *
     * @param string $sourceFile
     * @param string $watermarkFile
     * @param integer $canvasWidth
     * @param integer $ratioWidth
     * @param integer $ratioHeight
     *
     * @return string S3 Path
     */
    public static function canvas($sourceFile, $watermarkFile = null, $canvasWidth = 600, $ratioWidth = 4, $ratioHeight = 3)
    {
        // Define output file name
        $fileName = (!is_string($sourceFile) && !empty($sourceFile->getClientOriginalName()))
            ? $sourceFile->getClientOriginalName()
            : basename($sourceFile);

        // Create canvas
        $canvasHeight = (int) ($canvasWidth / $ratioWidth * $ratioHeight);
        $canvas = Image::canvas($canvasWidth, $canvasHeight, '#ffffff');

        // Make source image
        if (is_string($sourceFile)) {
            $sourceFile = self::readFromUrl($sourceFile);
            $sourceImage = Image::make($sourceFile);
        } else {
            $sourceImage = Image::make($sourceFile);
        }

        $sourceImage->resize($canvasWidth, $canvasHeight, function($c){
            $c->aspectRatio();
            $c->upsize();
        });

        // Put source image to canvas
        $canvas = $canvas->insert($sourceImage, 'center');

        // Put watermark into canvas
        if ($watermarkFile) {
            $canvas = $canvas->insert(Image::make($watermarkFile), 'top-right');
        }

        // Upload and return
        return Self::putFile($canvas, $fileName);
    }

    /**
     * Upload description
     *
     * @param  string $file
     * @param  string $dir
     * @return object
     **/
    public static function upload($file)
    {
        $file_name = (!empty($file->getClientOriginalName())) ? $file->getClientOriginalName() : basename($file);
        $img       = Image::make($file);

        return Self::putFile($img, $file_name);
    }

    /**
     * Put a file into S3
     * @param  object $encoded
     * @param  string $dir
     * @return String S3 Path
     */
    public static function putFile($img, string $file_name=null)
    {
        $rand      = Str::random(rand(10,50)).time();
        $key       = sha1($rand);
        $file_name = str_replace(' ', '-', $file_name);
        $full_path = date('Y/m/d')."/".$key."/".$file_name;
        $img       = $img->encode('jpg', 90);
        $full_path = (!empty(Self::$dir)) ? Self::$dir.'/'.$full_path : $full_path;

        Storage::disk(Self::DISK)->put($full_path, $img->encoded);


        $pathFinal = Storage::disk(Self::DISK)->path($full_path);
        // if ($pathFinal) {
        //     self::removeExifMetadata($pathFinal);
        // }

        return [
            'size'      => strlen($img->encoded),
            'width'     => $img->width(),
            'height'    => $img->height(),
            'mime_type' => $img->mime(),
            'file_name' => $file_name,
            'path'      => $full_path,
            'url'       => Self::getUrl($full_path)
        ];
    }

    public static function getUrl($path)
    {
        return Storage::disk(Self::DISK)->url($path);
    }

    /**
     * Delete file from S3
     * @param  string $path
     * @return Boolean
     */
    public static function delete(string $path)
    {
        if (Storage::exists($path)) {
            return Storage::delete($path);
        }

        return false;
    }

    /**
     * Set Directory
     * @param Self
     */
    public static function setDir(string $dir)
    {
        Self::$dir = $dir;
        return;
    }

    /**
     * Remove exif metadata
     *
     * @param binary $image
     * @return binary
     */
    private static function removeExifMetadata($image)
    {
        if (extension_loaded('imagick')) {
            $img = new \Imagick($image);
            $img->stripImage();
            $profiles = $img->getImageProfiles("icc", true);
            if (!empty($profiles)) {
                $img->profileImage("icc", $profiles['icc']);
            }

            return $img->writeImage($image);
        } else {
            if ($image) {
                $img = @imagecreatefromjpeg($image);
                return imagejpeg($img, $image, 100);
            }
        }

        return false;
    }

}
