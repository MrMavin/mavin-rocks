<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getAbout()
	{
		return view('pages.about');
	}
}
