<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facades\Illuminate\Support\Composer;

class DashboardController extends Controller
{
    /**
     * A function to perform composer dumpautoload on server, if you found any errors, please delete any files within /bootstrap/cache
     *
     * @return  void
     */
    public function dumpautoload()
    {
        return Composer::dumpAutoloads();
        //TODO SSDev, these 4 command can be executed in Artisan Runner menu
        // \Artisan::call('optimize');
        // \Artisan::call('cache:clear');
        // \Artisan::call('config:clear');
        // \Artisan::call('view:clear');
    }
        
    public function index()
    {    
        return view('backend.dashboard.index');
    }
}
