<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productName' => 'required | max:200',
            'productDescription' => 'required | max:200',
            'price' => 'required | |regex:/^\d{1,13}(\.\d{1,4})?$/',
            'stock' => 'required | integer'
        ]);
        

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'validate_err' => $validator->errors()]);
        } else {
            $product = new Product();
            $product->productName = $request->input('productName');
            $product->productDescription = $request->input('productDescription');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->save();
            return response()->json(['status' => 200, 'message' => 'Product Added Successfully!']);
        }
    }
}