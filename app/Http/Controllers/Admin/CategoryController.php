<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('parent_category')->get();
        
        return view('admin.category.index')->with('categories', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::whereNull('parent_id')->get();

        return view('admin.category.create')->with('categories', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $category = new Category();
            $category->title = $request->title;
            $category->metaTitle = $request->metaTitle;
            $category->slug = Str::slug($request->title);
            if($request->has('parent_id')) $category->parent_id = $request->parent_id;
            $category->save();

            DB::commit();

            return redirect()->back()->with('message', 'Data add successfully');
        }catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Something went wrong');
        }
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
        $category = Category::with('parent_category')->where('id', $id)->first();
        $parent_category = Category::whereNull('parent_id')->get();

        return view('admin.category.edit')->with([
            'category' => $category,
            'parent_category' => $parent_category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $category = Category::find($id);
            $category->title = $request->title;
            $category->metaTitle = $request->metaTitle;
            $category->slug = Str::slug($request->title);
            if($request->has('parent_id')) $category->parent_id = $request->parent_id;
            $category->updated_at = $category->freshTimestamp();
            $category->save();

            DB::commit();

            return redirect()->back()->with('message', 'Data updated successfully');
        }catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::find($id);
            $parent_id = Category::where('parent_id', $category->id)->select('id')->get();
            $category->delete();

            DB::commit();

            return response()->json([
                'cat_id' => $category->id,
                'parent_id' => $parent_id
            ]);
        }catch (Exception $e) {
            DB::rollback();

            return redirect()->back();
        }
    }
}
