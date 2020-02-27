<?php

namespace App\Http\Controllers\API;

use App\Order_details;
use App\Http\Resources\Order_detailsCollection;
use App\Http\Resources\Order_detailsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Order_detailsAPIController extends Controller
{
    public function index()
    {
        return new Order_detailsCollection(Order_details::paginate());
    }
 
    public function show(Order_details $orderDetails)
    {
        return new Order_detailsResource($orderDetails->load([]));
    }

    public function store(Request $request)
    {
        return new Order_detailsResource(Order_details::create($request->all()));
    }

    public function update(Request $request, Order_details $orderDetails)
    {
        $orderDetails->update($request->all());

        return new Order_detailsResource($orderDetails);
    }

    public function destroy(Request $request, Order_details $orderDetails)
    {
        $orderDetails->delete();

        return response()->noContent();
    }
}
