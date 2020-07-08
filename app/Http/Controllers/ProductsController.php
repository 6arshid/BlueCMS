<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function get_all()
    {
        $product =  Product::orderBy('id', 'DESC')->paginate(9);;
        $menus =  Menu::orderBy('id', 'DESC')->paginate(15);;

        return view('shop', compact('product','menus'));
    }
    public function get_product_detail($id,Product $product,Request $request)
    {

        // $id = $product['id'];
        // $product = Product::find($product['id']);
        $product = Product::where('id', '=', $id)->first();

        return view('product', compact('product'));
    }
}
