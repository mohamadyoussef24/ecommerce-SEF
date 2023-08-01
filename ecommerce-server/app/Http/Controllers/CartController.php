<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $user_id = auth()->user()->id;
        $cart_item = new Cart;
        $cart_item->user_id = $user_id;
        $cart_item->product_id = $request->product_id;
        $cart_item->save();
        return json_encode(["cart_item" => $cart_item]);
    }
}
