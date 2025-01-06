<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TimetableController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('welcome');
    }
}
