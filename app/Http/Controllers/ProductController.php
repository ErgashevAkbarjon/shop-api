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
    public function index(Request $request)
    {
        $productsQuery = Product::with('categories');
        
        $this->processFilters($request, $productsQuery);

        return $productsQuery->get();
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

        return $createdProduct->load('categories');
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

        return $product->load('categories');
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

    /**
     * Helpers
     * 
     */

    private function processFilters(Request $request, $productsQuery)
    {
        if($request->has('name')){
            $productsQuery->where('name', $request->name);
        }

        if($request->has('category_id')){
            $productsQuery->byCategory('id', $request->category_id);
        }

        if($request->has('category_name')){
            $productsQuery->byCategory('name', $request->category_name);
        }

        if($request->has('price_from')){
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if($request->has('price_to')){
            $productsQuery->where('price', '<=', $request->price_to);
        }

        if($request->has('published')){
            $productsQuery->where('published', $request->boolean('published'));
        }

        if(!$request->has('without_trash')){
            $productsQuery->withTrashed();
        }
    }
}
