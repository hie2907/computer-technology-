<?php

use App\Http\Controllers\CategoryClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'categories'], function () {
    Route::get('popular', [CategoryClient::class, 'get_popular_products']);
    // Route::get('recommended', [CategoryClient::class, 'get_recommended_products']);
    // Route::get('test', [CategoryClient::class, 'test_get_recommended_products']);
});
