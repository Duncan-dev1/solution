<?php

namespace App\Http\Controllers\API;

use App\Suppliers;
use App\Http\Resources\SuppliersCollection;
use App\Http\Resources\SuppliersResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuppliersAPIController extends Controller
{
    public function index()
    {
        return new SuppliersCollection(Suppliers::paginate());
    }
 
    public function show(Suppliers $suppliers)
    {
        return new SuppliersResource($suppliers->load([]));
    }

    public function store(Request $request)
    {
        return new SuppliersResource(Suppliers::create($request->all()));
    }

    public function update(Request $request, Suppliers $suppliers)
    {
        $suppliers->update($request->all());

        return new SuppliersResource($suppliers);
    }

    public function destroy(Request $request, Suppliers $suppliers)
    {
        $suppliers->delete();

        return response()->noContent();
    }
}
