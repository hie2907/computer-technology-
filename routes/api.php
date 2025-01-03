<?php

use App\Http\Controllers\CategoryClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'categories'], function () {
    Route::get('laptop', [CategoryClient::class, 'get_popular_products_laptop']);
    Route::get('camera', [CategoryClient::class, 'get_popular_products_camera']);
    Route::get('accessory', [CategoryClient::class, 'get_popular_products_accessory']);
});
