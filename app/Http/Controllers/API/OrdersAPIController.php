<?php

namespace App\Http\Controllers\API;

use App\Orders;
use App\Http\Resources\OrdersCollection;
use App\Http\Resources\OrdersResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersAPIController extends Controller
{
    public function index()
    {
        return new OrdersCollection(Orders::paginate(5));
    }
 
    public function show(Orders $orders)
    {
        return new OrdersResource($orders->load([]));
    }

    public function store(Request $request)
    {
        return new OrdersResource(Orders::create($request->all()));
    }

    public function update(Request $request, Orders $orders)
    {
        $orders->update($request->all());

        return new OrdersResource($orders);
    }

    public function destroy(Request $request, Orders $orders)
    {
        $order=Order::findOrFail($id);
        $order->delete();
        //return response()->noContent();
    }
}
