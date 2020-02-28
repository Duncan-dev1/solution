<?php

namespace App\Http\Controllers\API;

use App\Products;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\ProductsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsAPIController extends Controller
{
    public function index()
    {
        return new ProductsCollection(Products::orderBy('created_at','desc')->paginate(5));
    }
 
    public function show(Products $products)
    {
        return new ProductsResource($products->load([]));
    }

    public function store(Request $request)
    {
        return new ProductsResource(Products::create($request->all()));
    }

    public function update(Request $request, Products $products)
    {
        $products->update($request->all());

        return new ProductsResource($products);
    }

    public function destroy(Request $request, Products $products)
    {
        $products->delete();

        return response()->noContent();
    }
}
