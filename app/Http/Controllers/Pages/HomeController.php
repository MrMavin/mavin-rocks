<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        return view('pages.home');
    }
}
