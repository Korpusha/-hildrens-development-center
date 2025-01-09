<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.dashboard.index');
    }
}
