<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Session;
use File;

use Gumlet\ImageResize;
use App\Platform;
use App\Category;
// use Request;
use Illuminate\Support\Facades\Input;

class PlatformController extends Controller
{
    const MIN_RATE = 0;
    const MAX_RATE = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        $platforms = Platform::all();
        return view('admin.platform.index',
                    [
                        'platforms' => $platforms,
                        'categories' => $categories,
                        'rate' => [
                            'min' => self::MIN_RATE,
                            'max' => self::MAX_RATE
                        ]
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $validate = $this->validator($request);

        $logoName = '';
        $rate = Input::get('rate', 0);
        $is_discount_enable = $request->has('is_discount_enable') ? true : false;

        if ($request->hasFile('logo'))
        {
            $fileName = $request->file('logo');
            $logoName = $this->createItemPicture($fileName, 'medium' );

        }

        $platformCategories = $request->get('category');

        $platform = new Platform([
                        'name' => $request->get('name'),
                        'description' => $request->get('description', ''),
                        'link' => $request->get('link', ''),
                        'rate' => $rate,
                        'logo' => $logoName,
                        'is_discount_enable' => $is_discount_enable,
                    ]);

        $result = $platform->save();
        $platform->categories()->sync($platformCategories);

        if (!$request->ajax()) {
            if ($result) {
                return redirect()->route('platform')->with(['alert' => 'info', 'message' => 'Platform created...']);
            }
            return redirect()->route('platform')->with(['alert' => 'error', 'message' => 'Error...']);
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
        $categories = Category::all();
        $platform = Platform::findOrFail($id);

        $category_id = !empty($platform->categories()->exists()) ? $platform->categories()->first()->id : '';

        return view('admin.platform.edit', [
            'platform' => $platform,
            'categories' => $categories,
            'category_id' => $category_id,
            'rate' => [
                'min' => self::MIN_RATE,
                'max' => self::MAX_RATE
            ]
        ]);
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
        $validate = $this->validator($request);

        // store Platform
        $platform = Platform::find($id);
        $platform->name                 = Input::get('name');
        $platform->description          = Input::get('description');
        $platform->link                 = Input::get('link');
        $platform->rate                 = Input::get('rate');
        $platform->is_discount_enable   = Input::has('is_discount_enable') ? true : false;

        if ($request->hasFile('logo'))
        {
            $logoImg = $request->file('logo');
            $previousPathLogo = public_path($platform->logo);
            if (File::exists($previousPathLogo) && !is_dir($previousPathLogo)) {
                unlink($previousPathLogo); //remove previous image
            }

            $fn = $this->createItemPicture($logoImg);
            $platform->logo = $fn;

        }

        $platform->save();
        $platformCategories = $request->get('category');
        $platform->categories()->sync($platformCategories);

        Session::flash('message', 'Successfully update platform record...');

        return redirect()->route('platform')->with(['alert' => 'info', 'message' => 'Edit successfull...']);
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
        $platform = Platform::findOrFail($id);
        unlink(public_path($platform->logo));

        $result = $platform->delete();
        if ($result)
        {
            session()->flash('alert-info', "Platform with id: $id has been deleted");
        }
        return redirect()->route('platform');
    }

    private function validator(Request &$request) {
        return $request->validate([
            'name' => 'required | max:255',
            'description' => 'max:1000', // 65535
            'logo.*' => 'image | mimes:jpeg,png,jpg,gif | max:2048',
            'category.*'  => 'integer',
            'rate' => 'string',
            'is_discount_enable' => 'boolean'
            // 'rate' => 'integer | min:0 | max:10',
        ]);
    }

    private function createItemPicture($image)
    {
        $defaultWidth = Config::get('imageup.card.image.maxWidth', 300);
        $relPath = Config::get('imageup.card.image.relPath', '/img/');

        $path = $image->path();
        $originalName = $image->getClientOriginalName();
        $originalExt = $image->getClientOriginalExtension();
        $newName = uniqid().$originalExt;
        $relativeFileName = $relPath.$newName; //$originalName;
        $public_path_img = public_path().$relativeFileName;
        $imageTool = new ImageResize($path);

        $imageTool->resizeToWidth($defaultWidth);

        $filename = $imageTool->save($public_path_img);

        return $relativeFileName;
    }
}
