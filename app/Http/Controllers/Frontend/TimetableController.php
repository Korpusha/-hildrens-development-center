<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TimetableController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('frontend.timetable.index');
    }
}
