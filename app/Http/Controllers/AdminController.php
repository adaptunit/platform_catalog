<?php

namespace App\Http\Controllers;

use App\Category;
use App\Platform;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware(['auth', 'isAdmin']);
    }


    public function index()
    {
        return view('admin.index');
    }
/*
    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories.index', ['categories' => $categories]);
    }
*/
}
