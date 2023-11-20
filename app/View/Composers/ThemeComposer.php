<?php

namespace App\View\Composers;

use Illuminate\View\View;

class ThemeComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('darkmode', (bool) \Cache::get('metronic-dark-mode'.session()->getId()) ?? false);
        $view->with('narrowmode', (bool) \Cache::get('metronic-narrow-mode'.session()->getId()) ?? false);
    }
}