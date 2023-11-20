<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\File as Filesystem;

class ImageRepository extends ModelRepository
{    
    function __construct(Image $model)
    {
        $this->model = $model;
    }
    
    /**
     * Show file based on MIME
     */
    public function showFile($file_id='')
    {
        $file = Self::find($file_id);
		if ($file) {
            $path = storage_path('app/public/'.$file->path);
			if (!Filesystem::exists($path)) {
				abort(404);
			}
		
			$file = Filesystem::get($path);
			$type = Filesystem::mimeType($path);
		
			$response = \Response::make($file, 200);
			$response->header("Content-Type", $type);
		
			return $response;
		}
    }

    /**
     * Do upload file
     *
     * @param File object $file
     * @param array $resize available values are thumb, medium, large
     * @param int $width Width in pixel
     * @param int $height Height in pixel
     * @return void
     */
    public function upload($file, $resize=[], $width = '', $height = '') 
    {
        ImageHelper::setDir('images');
        
        if ($width=='' && $height=='') {
            $uploaded = ImageHelper::upload($file);
        } elseif ($width!='' && $height!='') {
            $uploaded =  ImageHelper::resize($file, $width, $height, 0);
        } elseif ($width!='') {
            $uploaded =  ImageHelper::convert($file, $width);            
        }

        $new_data = $uploaded;
        $new_data['type'] = 'origin';
        $origin = Image::create($new_data);


        if (!empty($resize)) {
            foreach ($resize as $size) {
                $uploaded = $this->resize($file, $size);
                $new_data = $uploaded;
                $new_data['parent_id'] = $origin->id;
                $new_data['type'] = $size;
                Image::create($new_data);
            }
        }
        return $origin;
    }

    /**
     * Resize image object
     *
     * @param File object $file
     * @param string $type available values are thumb, medium, large
     * @param int $width
     * @param int $height
     * @param integer $crop , if 1, the image will be cropped
     * @return void
     */
    public function resize($file, $type='thumb', $width=null, $height=null, $crop=1)
    {
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

    /**
     * Get Thumbnail Image
     */
    public function getThumbnail($parent_id)
    {
        $where = [
            'parent_id' => $parent_id,
            'type' => 'thumb'
        ];
        $image = Image::where($where)->first();
        if ($image) {
            $image['path'] = Storage::url($image['path']);
            return $image;
        } else {
            $origin = self::find($parent_id);
            $thumb = self::resize($origin, 'thumb');
            $new_thumb = $thumb;
            $new_thumb['path'] = Storage::url($new_thumb['path']);
            return $thumb;
        }
    }

    public function getThumbnailSecure($parent_id)
    {
        $where = [
            'parent_id' => $parent_id,
            'type' => 'thumb'
        ];
        $image = Image::where($where)->first();
        if ($image) {
            $image['path'] = Storage::url($image['path']);
            return $image;
        } else {
            $origin = self::find($parent_id);
            $thumb = self::resize($origin, 'thumb');
            $new_thumb = $thumb;
            $new_thumb['path'] = Storage::url($new_thumb['path']);
            return $thumb;
        }
    }    
}
