<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $platforms = Platform::orderByDesc('rate')->get();
        return view('home',
                    [
                        'platforms' => $platforms,

                    ]);
        //return view('home');
    }
}
