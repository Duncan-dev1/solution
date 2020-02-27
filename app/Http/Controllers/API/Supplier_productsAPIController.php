<?php

namespace App\Http\Controllers\API;

use App\Supplier_products;
use App\Http\Resources\Supplier_productsCollection;
use App\Http\Resources\Supplier_productsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Supplier_productsAPIController extends Controller
{
    public function index()
    {
        return new Supplier_productsCollection(Supplier_products::paginate());
    }
 
    public function show(Supplier_products $supplierProducts)
    {
        return new Supplier_productsResource($supplierProducts->load([]));
    }

    public function store(Request $request)
    {
        return new Supplier_productsResource(Supplier_products::create($request->all()));
    }

    public function update(Request $request, Supplier_products $supplierProducts)
    {
        $supplierProducts->update($request->all());

        return new Supplier_productsResource($supplierProducts);
    }

    public function destroy(Request $request, Supplier_products $supplierProducts)
    {
        $supplierProducts->delete();

        return response()->noContent();
    }
}
