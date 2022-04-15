<?php

namespace App\Http\Controllers\Execution;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UploadImagesController extends Controller
{
    public function upload_images_product($id) {
        $product = Product::find($id);

        return view('admin.product.upload-images-products')->with('product', $product);
    }

    public function upload_images_product_store(Request $request, $id) {
       
        DB::beginTransaction();

        try {
            $data = json_decode($request->data);

            $exist = ProductImage::where('product_id', $id)->exists();
    
            if($exist){
                $products = Product::whereHas('images', function($q) use ($id){
                    $q->where('product_id', $id);
                })->first();
    
                $products->images()->delete();
    
                foreach($data as $product){
                    $product_image = new ProductImage();
                    $product_image->product_id = $id;
                    $product_image->product_image_path = $product->response->uploadURL;
                    $products->images()->save($product_image);
                }

                DB::commit();

                return response()->json('success');
            }else {
                $products = Product::find($id);
    
                foreach($data as $product){
                    $product_image = new ProductImage();
                    $product_image->product_id = $id;
                    $product_image->product_image_path = $product->response->uploadURL;
                    $products->images()->save($product_image);
                }
                DB::commit();

                return response()->json('success');
            }
        }catch (Exception $e){
            DB::rollback();

            return response()->json('error');
        }
    }

    public function set_upload_images_product($id){
        $product = Product::with(['images' => function($q) use ($id){
            $q->where('product_id', $id)->get();
        }])->where('id', $id)->first();

        return view('admin.product.set-upload-images-product')->with('product', $product);
    }

    public function set_upload_images_product_store(Request $request, $id){
        DB::beginTransaction();

        try {
            if($request->has('default')){
                ProductImage::where([
                    'product_image_path' => $request->default,
                    'product_id' => $id
                ])->update(['product_image_caption' => 'default']);
            }
            if($request->has('hover')){
                ProductImage::where([
                    'product_image_path' => $request->hover,
                    'product_id' => $id
                ])->update(['product_image_caption' => 'hover']);
            }
           
            DB::commit();

            return redirect()->route('product.index');
        }catch (Exception $e){
            DB::rollback();
        
            return view('templates.samples.404');
        }
    }

    public function upload_images_product_edit($id) {
        $product = Product::find($id);

        return view('admin.product.upload-images-products-edit')->with('product', $product);
    }

    public function upload_images_product_update(Request $request, $id) {
        DB::beginTransaction();

        try {
            $data = json_decode($request->data);

            $exist = ProductImage::where('product_id', $id)->exists();
    
            if($exist){
                $products = Product::whereHas('images', function($q) use ($id){
                    $q->where('product_id', $id);
                })->first();
    
                $products->images()->delete();
    
                foreach($data as $product){
                    $product_image = new ProductImage();
                    $product_image->product_id = $id;
                    $product_image->product_image_path = $product->response->uploadURL;
                    $products->images()->save($product_image);
                }

                DB::commit();

                Session::flash('message', 'Upload Gallary '. $products->title .' has been updated');

                return response()->json('success');
            }
        }catch (Exception $e){
            DB::rollback();

            return response()->json('error');
        }
    }

    public function set_upload_images_product_edit($id) {
        $product = Product::with(['images' => function($q) use ($id){
            $q->where('product_id', $id)->get();
        }])->where('id', $id)->first();

        $product1 = Product::with(['images' => function($q) use ($id){
            $q->where([
                'product_id' => $id,
                'product_image_caption' => 'default'
            ]);
        }])->where('id', $id)->first();

        $product2 = Product::with(['images' => function($q) use ($id){
            $q->where([
                'product_id' => $id,
                'product_image_caption' => 'hover'
            ]);
        }])->where('id', $id)->first();

        $default = $product1->images->first();
        $hover = $product2->images->first();

        return view('admin.product.set-upload-images-product-edit')->with([
            'product' => $product,
            'default' => $default,
            'hover' => $hover
        ]);
    }

    public function set_upload_images_product_update(Request $request, $id) {
        DB::beginTransaction();

        try {
            $product1 = Product::with(['images' => function($q) use ($id){
                $q->where([
                    'product_id' => $id,
                    'product_image_caption' => 'default'
                ]);
            }])->where('id', $id)->first();

            $product2 = Product::with(['images' => function($q) use ($id){
                $q->where([
                    'product_id' => $id,
                    'product_image_caption' => 'hover'
                ]);
            }])->where('id', $id)->first();

            $product1->images->first()->update(['product_image_caption' => null]);
            $product2->images->first()->update(['product_image_caption' => null]);

            if($request->has('default')){
                ProductImage::where([
                    'product_image_path' => $request->default,
                    'product_id' => $id
                ])->update(['product_image_caption' => 'default']);
            }
            if($request->has('hover')){
                ProductImage::where([
                    'product_image_path' => $request->hover,
                    'product_id' => $id
                ])->update(['product_image_caption' => 'hover']);
            }

            return redirect()->route('product.edit', $id)->with('message', 'Set Images has been updated');
           
            DB::commit();

            return redirect()->route('product.index');
        }catch (Exception $e){
            DB::rollback();
        
            return view('templates.samples.404');
        }
    }
}
