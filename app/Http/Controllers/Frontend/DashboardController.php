<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\Illuminate\Support\Composer;

class DashboardController extends Controller
{            
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readme = '';
        if (file_exists(base_path().'/README.md')) {
            $readme = markdown(file_get_contents(base_path().'/README.md'));
        }
        
        return redirect('/login');
        // return view('frontend.homepage.index', compact('readme'));
    }

    /**
     * A function to perform composer dumpautoload on server, if you found any errors, please delete any files within /bootstrap/cache
     *
     * @return  void
     */
    public function dumpautoload()
    {
        Composer::dumpAutoloads();
        \Artisan::call('optimize');
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
    }    
}
