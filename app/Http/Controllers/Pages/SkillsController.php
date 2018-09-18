<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class SkillsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getSkills()
    {
        return view('pages.skills');
    }
}
