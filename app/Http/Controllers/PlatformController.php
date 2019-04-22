<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use QCod\ImageUp\HasImageUploads;
use Session;

use Gumlet\ImageResize;
use App\Platform;
use App\Category;
// use Request;
use Illuminate\Support\Facades\Input;

class PlatformController extends Controller
{
    // use HasImageUploads;

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
        $rate = Input::get('rate');
        $is_discount_enable = $request->has('is_discount_enable') ? true : false;

        // print_r($is_discount_enable);
        // dd($request->all());
        // print_r($request); exit;

        if ($request->hasFile('logo'))
        {
            $fileName = $request->file('logo');
            $logoName = $this->createItemPicture($fileName, 'medium' );
            // foreach ($request->file('logo') as $image) {
            //    $this->createItemPicture($image, $product->id, $size );
            //}
        }
        $platformCategories = $request->get('category');

        $platform = new Platform([
                        'name' => $request->get('name'),
                        'description' => $request->get('description', ''),
                        'link' => $request->get('link', ''),
                        'rate' => $rate, // $request->get('rate', 0),
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
/*
        if ($validate->fails()) {
            return Redirect::to('platform/' . $id)
            ->withErrors($validator)
            ->withInput($request->input());
        } else {
*/
            // store Platform
            $platform = Platform::find($id);
            $platform->name                 = Input::get('name');
            $platform->description          = Input::get('description');
            $platform->link                 = Input::get('link');
            $platform->rate                 = Input::get('rate');
            $platform->is_discount_enable   = Input::has('is_discount_enable') ? true : false;
            // $request->has('is_discount_enable') ? true : false;

            // 'logo' => $logoName,
            // 'is_discount_enable' => $is_discount_enabl
            $platform->save();
            $platformCategories = $request->get('category');
            $platform->categories()->sync($platformCategories);

            Session::flash('message', 'Successfully update platform record...');
            // return Redirect::to('platfrom');
//        }

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

    private function createItemPicture($image, string $size): array
    {
/*
        switch ($size)
        {
            case 'large':
                $pixels = 450;
                break;
            case 'medium':
                $pixels = 250;
                break;
            case 'small':
            default:
                $pixels = 110;
                break;
        }
*/
        $path = $image->store('public/img');
        $filename = explode('/', $path);
        $imageTool = new ImageResize(base_path('storage/app/'.$path));
        $imageTool->resizeToLongSide($pixels);
        $imageTool->save(base_path('storage/app/'.$path));
        /*
        ItemPicture::create([
            'product_id' => $product_id,
            'size' => $type,
            'path' => implode('/', [$filename[1], $filename[2]])
        ]);
        */
        return $filename;
    }
}
