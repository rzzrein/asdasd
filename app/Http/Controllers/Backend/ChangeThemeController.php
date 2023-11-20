<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeThemeController extends Controller
{
    public function changeTheme(Request $request)
    {
        return \Cache::forever("metronic-dark-mode".session()->getId(), (string) $request->dark=='true');
    }

    public function narrowMode(Request $request)
    {
        return \Cache::forever("metronic-narrow-mode".session()->getId(), (string) $request->narrow=='true');
    }
}
