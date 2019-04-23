<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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
        $categories = Category::all()->sortBy('name');
        $platforms = Platform::orderByDesc('rate')->get();
        return view('home', [
                    'platforms' => $platforms,
                    'categories' => $categories,
                ]);
        //return view('home');
    }

    public function category($id)
    {
        $categories = Category::all()->sortBy('name');
        $platforms = Platform::orderByDesc('rate')->hasCategories([$id])->get();
        return view('home', [
                    'platforms' => $platforms,
                    'categories' => $categories,
                ]);
    }
}
