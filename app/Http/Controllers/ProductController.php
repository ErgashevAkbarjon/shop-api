<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "image" => "file",
            "price" => "required|numeric",
            "published" => "boolean",
            "categories" => "array"
        ]);

        $createdProduct = Product::create($request->all());

        if($request->has('categories')){
            $createdProduct->categories()->attach($request->categories);
        }

        return $createdProduct;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" => "string",
            "image" => "file",
            "price" => "numeric",
            "published" => "boolean",
            "categories" => "array"
        ]);
        
        $product->update($request->all());

        if($request->has('categories')){
            $product->categories()->sync($request->categories);
        }

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
