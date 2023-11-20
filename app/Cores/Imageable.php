<?php
namespace App\Cores;
use App\Helpers\ImageHelper;

/**
 * Imageable Trait
 */
trait Imageable
{
    /**
     * Do upload file
     *
     * @param File object $file
     * @param array $resize available values are thumb, medium, large, crop_[ratio width]_[ratio height] (eg: crop_4_1)
     * @param array $params additional params
     * @return void
     */
    public function upload($file, $resize=[], $params=[], $mimeType=null)
    {
        ImageHelper::setDir('images');

        $uploaded = ImageHelper::upload($file);

        $new_data = $uploaded;
        $new_data['type'] = 'origin';
        if (!empty($params)) $new_data = array_merge($new_data, $params);

        $origin = $this->image()->create($new_data);

        if (!empty($resize)) {
            foreach ($resize as $size) {
                $uploaded = $this->processVariant($file, $size, null, null, 1, $mimeType);
                $new_data = $uploaded;
                $new_data['parent_id'] = $origin->id;
                $new_data['type']   = $size;
                if (!empty($params)) $new_data = array_merge($new_data, $params);
                $this->image()->create($new_data);
            }
        }
        return $origin;
    }


    /**
     * Resize Image
     * @param  image $origin
     */
    public function resize($file, $type='thumb', $width=null, $height=null, $crop=1)
    {
        if (str_starts_with($type, 'crop_')) {
            $token = explode('_', $type);
            $ratio_width = intval($token[1]);
            $ratio_height = intval($token[2]);

            return ImageHelper::crop($file, $ratio_width, $ratio_height);
        }

        switch ($type) {
            case 'thumb':
                $width  = 300;
                $height = 300;
                return ImageHelper::resize($file, $width, $height, $crop);
                break;
            case 'small':
                $width  = 500;
                return ImageHelper::convert($file, $width);
                break;
            case 'medium':
                $width  = 800;
                return ImageHelper::convert($file, $width);
                break;
            case 'large':
                $width  = 1280;
                return ImageHelper::convert($file, $width);
                break;
        }
    }

    public function processVariant($file, $variant = 'thumb', $width = null, $height = null, $crop = 1, $mimeType = null)
    {
        if (str_starts_with($variant, 'crop_') || str_starts_with($variant, 'canvas_')) {
            $token = explode('_', $variant);
            $ratioWidth = intval($token[1]);
            $ratioHeight = intval($token[2]);

            return str_starts_with($variant, 'crop_')
                ? ImageHelper::crop($file, $ratioWidth, $ratioHeight)
                : ImageHelper::canvas($file, null, 600, $ratioWidth, $ratioHeight);
        }

        switch ($variant) {
            case 'thumb':
                $width  = 300;
                $height = 300;
                return ImageHelper::resize($file, $width, $height, $crop, $mimeType);
                break;
            case 'small':
                $width  = 500;
                return ImageHelper::convert($file, $width, $mimeType);
                break;
            case 'medium':
                $width  = 800;
                return ImageHelper::convert($file, $width, $mimeType);
                break;
            case 'large':
                $width  = 1280;
                return ImageHelper::convert($file, $width, $mimeType);
                break;
        }
    }
}
