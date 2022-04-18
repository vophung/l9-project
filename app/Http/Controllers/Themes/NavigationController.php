<?php

namespace App\Http\Controllers\Themes;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function home_page() {
        return view('themes.homepage.index');
    }

    public function shop_page() {
        $categories = Category::whereNotNull('parent_id')->select('id','title','slug')->get();

        $products = Product::whereHas('images')->with([
            'images_default','images_hover'
        ])->orderBy('created_at','DESC')->take(8)->get();

        return view('themes.shop.index')->with([
            'products' => $products,
            'categories' => $categories
        ]);;
    }

    public function product_detail($slug) {
        return view('themes.product-details.index');
    }

    public function shop_slug($slug) {
        $categories = Category::whereNotNull('parent_id')->select('id','title','slug')->get();
        $products = Product::whereHas('category', function($q) use ($slug){
            $q->where('slug', $slug);
        })->with([
            'images_default','images_hover'
        ])->orderBy('created_at','DESC')->take(8)->get();

        return view('themes.shop.product-mix')->with([
            'products' => $products,
            'slug' => $slug,
            'categories' => $categories
        ]);;
    }
}
