<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\APIProductController;

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

 
//Route::resource('products', APIProductController::class);


//public routes
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logoutuser', [AuthController::class,'logoutuser']);

Route::get('product', [APIProductController::class,'index']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::get('/product/{id}', [APIProductController::class,'show']);
    Route::put('/product/{id}', [APIProductController::class,'update']);
    Route::post('/product/add',[APIProductController::class,'store']);
    Route::delete('/product/{id}',[APIProductController::class,'destroy']);
});
