<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::has('images')->get();

        return view('admin.product.index')->with('products', $product);
    }

    public function getProduct() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','title')->whereNotNull('parent_id')->get();

        return view('admin.product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->sku = Str::sku($request->title);
            $product->price = (int)str_replace(',','', $request->price);
            $product->discount = (float)$request->discount;
            $product->quantity = $request->quantity;
            $product->sumary = $request->sumary;
            if($request->has('shop')){$product->shop = 1;} else {$product->shop = 0;}
            $product->save();
    
            $items_category = $request->category_id;
    
            Product::find($product->id)->category()->attach($items_category);
            
            DB::commit();
            
            return redirect()->route('product.uploads', $product->id)->with('message', $product->title . ' has been created');
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
        $categories = Category::select('id','title')->whereNotNull('parent_id')->get();
        $product = Product::with('category')->where('id', $id)->first();

        return view('admin.product.edit')->with([
            'categories' => $categories,
            'product' => $product
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
        DB::beginTransaction();

        try {

            $product = Product::find($id);

            if($request->has('shop')){ $shop = 1; } else { $shop = 0; };
    
            $data = [
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'sku' => Str::sku($request->title),
                'price' => (int)str_replace(',','', $request->price),
                'discount' => (float)$request->discount,
                'quantity' => $request->quantity,
                'sumary' => $request->sumary,
                'shop' => $shop
            ];
            
            Product::find($id)->update($data);
    
            $items_category = $request->category_id;
    
            Product::find($id)->category()->sync($items_category);
            
            DB::commit();
            
            return redirect()->back()->with('message', $product->title . ' has been updated');
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
            $product = Product::find($id);
            $product->delete();

            DB::commit();

            return response()->json($product->title);
        }catch (Exception $e) {
            DB::rollback();

            return redirect()->back();
        }
    }
}
