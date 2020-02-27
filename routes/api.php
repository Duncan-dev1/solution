<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
* Snippet for a quick route reference
*/
Route::get('/', function (Router $router) {
    return collect($router->getRoutes()->getRoutesByMethod()["GET"])->map(function($value, $key) {
        return url($key);
    })->values();   
});

Route::apiResource('orders', '\App\Http\Controllers\API\OrdersAPIController');

Route::apiResource('orderDetails', '\App\Http\Controllers\API\Order_detailsAPIController');

Route::apiResource('products', '\App\Http\Controllers\API\ProductsAPIController');

Route::apiResource('suppliers', '\App\Http\Controllers\API\SuppliersAPIController');

Route::apiResource('supplierProducts', '\App\Http\Controllers\API\Supplier_productsAPIController');