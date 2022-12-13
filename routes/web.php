<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Models\ModelProducts;
use App\Models\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('check-year');

Route::get('/about-us', function () {
    return view('about', ['name' => 'About Us']);
});
Route::get('/contact-us', function () {
    return view('contact');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// put method to update the resource
// post method to create the resource
Route::post('/profile/', [UserController::class, 'update']);
Route::view('/profile', 'dashboards.users.profile' )->middleware('auth');
//Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

Route::redirect('/here', '/profile');


//Route::controller(ProductsController::class)->group(function () {
//    Route::get('/products', [ProductsController::class,'index']);
//    Route::get('/products/{id}/edit', [ProductsController::class,'edit']);
//    Route::get('/products/{id}', [ProductsController::class,'show']);
//    Route::get('/products/create', [ProductsController::class,'create']);
//    Route::post('/products', [ProductsController::class,'store']);
//    Route::patch('/products/{id}', [ProductsController::class,'update']);

    // delete user from db
//    Route::delete('/products/{id}',[ProductsController::class,'destroy']);
//});
Route::get('/product/{single:name}', function (ModelProducts $single) {
    return $single;
});
Route::scopeBindings()->group(function () {
    Route::get('/users/{user}/posts/{post}', function (User $user, ModelProducts $post) {
        return $post;
    });
});


Route::prefix('/products' )->group(function () {

    Route::get('/', [ProductsController::class,'index'])->name('all');

    Route::get('/{ModelProducts}/edit', [ProductsController::class,'edit'])->where(['id'=>'[0-9]+']);
    Route::get('/{id}', [ProductsController::class,'show'])->where(['id' => '[0-9]+']);
    Route::get('/create', [ProductsController::class,'create']);
    Route::post('/', [ProductsController::class,'store']);
    Route::patch('/{id}', [ProductsController::class,'update']);

    // delete user from db
    Route::delete('/products/{id}',[ProductsController::class,'destroy']);
});
//Route::resource('products', ProductsController::class);

