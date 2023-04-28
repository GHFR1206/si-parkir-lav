<?php

namespace App\Http\Controllers;

use App\Charts\ParkirChart;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ParkirChart $chart)
    {
        return view('index', ['chart' => $chart->build()]);
    }
}
