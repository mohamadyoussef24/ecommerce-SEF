<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateProducts extends Controller
{
    public function createProduct(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ];
    
    
            $categoryId = $request->input('category_id');
            $category = Categorie::find($categoryId);
    
            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
    
            $product->category()->associate($category);
            $product->save();
            return response()->json(['message' => 'Product created successfully']);
        }

        function getProducts(){
            $products = Product::all();
            foreach($products as $product) 
            {
                $image64 = base64_encode(file_get_contents($product->image_path));
                $product -> image_path = $image64;
            }
            return json_encode(["products" => $products]);
        }

}
