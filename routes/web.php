<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Models\ModelProducts;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


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

Route::get('/swagger',function (){
    return view('swagger');
});
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

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/email',function(){
    Mail::to('mubeeniqbal82@gmail.com')->send(new WelcomeMail() );
    return new WelcomeMail();
} );

// put method to update the resource
// post method to create the resource
Route::post('/profile/', [UserController::class, 'update']);
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

Route::post('/add-to-wishlist', [WishlistController::class, 'add']);

Route::middleware(['auth'])->group(function (){
    Route::post('/add-to-wishlist', [WishlistController::class, 'add']);
    Route::post('/remove-from-wishlist', [WishlistController::class, 'RemovedFromWishlist']);
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::get('/thank-you', [CheckoutController::class, 'thankyou']);
    Route::post('/place-order', [CheckoutController::class, 'PlaceOrder']);
});

Route::group(['middleware' => 'auth'],function (){
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ],function (){
        Route::get('/profile', [UserController::class,'profile']);
        Route::get('/', [AdminController::class,'index']);
        Route::get('/all-users', [AdminController::class,'listUsers']);


        Route::get('/all-comments', [ProductController::class,'ListComments']);
        Route::post('/all-comments',[ProductController::class,'updateComment']);

        Route::get('/products',[ProductController::class,'index']);
        Route::post('/products',[ProductController::class,'store']);
        Route::get('/product/add',[ProductController::class,'create'])->name('create');
        Route::get('/product/edit/{id}',[ProductController::class,'edit'])->where(['id'=>'[0-9]+']);
        Route::patch('/product/{id}',[ProductController::class,'update']);

        Route::delete('products/{id}',[ProductController::class,'destroy']);


        Route::get('/categories',[CategoriesController::class,'index']);
        Route::post('/categories',[CategoriesController::class,'store']);
        Route::get('/category/create',[CategoriesController::class,'create']);
        Route::get('/category/edit/{id}',[CategoriesController::class,'edit'])->where(['id'=>'[0-9]+']);
        Route::patch('/categories/{id}',[CategoriesController::class,'update']);

        Route::delete('categories/{id}',[CategoriesController::class,'destroy']);
    });


});



Route::get('/product/{single:slug}', [ProductController::class,'show']);
Route::post('/product/{single:slug}', [ProductController::class,'PostComments']);
Route::get('/cart', [ProductController::class,'cart']);
Route::get('/add-to-cart/{id}', [ProductController::class,'AddToCart']);
Route::patch('/update-cart', [ProductController::class,'UpdateCart']);
Route::delete('/remove-from-cart', [ProductController::class,'RemovedFromCart']);


//public root
Route::get('/products',[ProductController::class,'shop']);



