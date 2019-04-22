<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = $this->validator($request);

        $category = new Category(['name' => $request->get('name')]);
        $result = $category->save();

        if (!$request->ajax()) {
            if ($result) {
                return redirect()->route('category')->with(['alert' => 'info', 'message' => 'Category created...']);
            }
            return redirect()->route('category')->with(['alert' => 'error', 'message' => 'Error...']);
        }

        if ($result) {
            return response(['status' => 'ok'], 201);
        }
        return response(['status' => 'error'], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);

        $validate = $this->validator($request);

        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('category')->with(['alert' => 'info', 'message' => 'Edit successfull...']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);

        $result = $category->delete();
        if ($result)
        {
            session()->flash('alert-info', "Category with id: $id has been deleted");
        }
        // return response()->json(['status'=>'ok'], 200);
        return redirect()->route('category');
    }


    private function validator(Request &$request)
    {
        return $request->validate([
            'name' => 'required | max:255'
        ]);
    }
}
