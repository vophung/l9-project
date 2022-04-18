<?php

namespace App\Http\Controllers\Execution;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function store(Request $request) {
        DB::beginTransaction();

        try {
            $user = User::with(['cart.product','info'])->where('id', auth()->user()->id)->first();
            
            $product = Product::where('id', $request->id)->get();

            if(count($user->cart) > 0){
                $product = Product::where('id', $request->id)->get();
    
                $data = [
                    'sku' => $product->first()->sku,
                    'price' => $product->first()->price,
                    'discount' => $product->first()->discount,
                    'active' => 1
                ];
    
                $user->cart()->first()->product()->attach($product, $data);
    
            }else {
                if($user->cart()->exists()){
                    $user->cart()->save([
                        'name' => auth()->user()->name,
                        'address' => $user->info()->first()->address,
                        'mobile' => $user->info()->first()->mobile
                    ]);
                }else {
                    $cart = new Cart();
                    $cart->user_id = auth()->user()->id;
                    $cart->name = auth()->user()->name;
                    $cart->address = $user->info()->first()->address;
                    $cart->mobile = $user->info()->first()->mobile;
                    $user->cart()->save($cart);
    
                    $data = [
                        'sku' => $product->first()->sku,
                        'price' => $product->first()->price,
                        'discount' => $product->first()->discount,
                        'active' => 1
                    ];
    
                    $user->cart()->first()->product()->sync($product, $data);
                }
            }

            DB::commit();

            $message = ['title' => 'Sản phẩm '. $product->first()->title .' ', 'message' => 'đã thêm vào giỏ hàng của bạn'];

            return response()->json($message);

        }catch (Exception $e) {
            DB::rollback();
        
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
