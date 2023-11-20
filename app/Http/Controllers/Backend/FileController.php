<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Facades\App\Models\File;
use Facades\App\Models\User;
use App\Http\Controllers\Controller;
use Facades\App\Repositories\UserRepository;
use Facades\App\Repositories\ImageRepository;

class FileController extends Controller
{
    function __construct()
    {
    }

    /**
     * Upload images/files to AWS S3 using ImageHelper.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** Upload original image */
        $image  = File::upload($request->file, ['thumb', 'medium', 'large']);        
        return $image;
    }

    /**
     * Handle all AJAX request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'thumb':
                return ImageRepository::getThumbnail($request->id);;
                break;   
            case 'image-upload':
                $image  = ImageRepository::upload($request->file, ['thumb', 'medium', 'large'], 500);
                return $image;        
                break;    
            case 'avatar':
                return User::find($request->id)->avatar;
                break;    
        }
    }
}
