<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/{product}/comments', [ProductController::class, 'getComments'])->name('products.comments');;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('products/{product}/comments', [CommentController::class, 'store'])->name('products.comments.store');
    Route::put('products/{product}/comments/{comment}', [CommentController::class, 'update'])->name('products.comment.update');
    Route::delete('products/{product}/comments/{comment}', [CommentController::class, 'destroy'])->name('products.comment.delete');
});
