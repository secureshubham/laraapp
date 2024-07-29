<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// simple route
// Route::get('/', function () {
//     return view('welcome');
// });

// Route with parameter
// Route::get('/post/{id?}/comment/{comment?}', function (string $id = null, string $comment = null ) {
//     if($id){
//         return '<h1>POST ID : '.$id.'</h1><br> <h2>Comment : '.$comment.'</h2>' ;
//     }else{
//         return '<h1> No post id found. </h1>';
//     }
// });

// Named Route
// Route::get('/posts', function () {
//     return view('post');
// })->name('mypost');

// Route Groups
// Route::prefix('page')->group(function(){
//     Route::get('/posts', function () {
//         return view('post');
//     })->name('mypost');
//     Route::get('/', function () {
//         return view('welcome');
//     });
// });

// Route::get('/createproduct', function () {
//     return view('create-new-product');
// })->name('createproduct');
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
        return view('welcome');
    });

// user handle
Route::controller(UserController::class)->group(function () {
    Route::get('/userloginpage', 'userloginpage')->middleware('guest')->name('userloginpage');
    Route::get('/registerpage', 'registerpage')->name('registerpage');
    Route::post('/registernewuser', 'newuserregister')->name('newuserregister');
    Route::post('/loginauth', 'loginauth')->name('loginauth');
    // Route::get('/dashboard', 'dashboard')->name('dashboard.dashboard');
    
});


// Route::get('/dashboard', function () {
//     if (auth()->check()) {
//         // User is authenticated, allow access
//         return view('dashboard.dashboard');
//     } else {
//         // User is not authenticated, redirect to login
//         return redirect('userloginpage');
//     }
// });



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




// Products handle
Route::controller(ProductController::class)->group(function(){
    Route::get('/products','products')->name('product.myproducts');
    Route::get('/product/updatepage/{id}','updatepage')->name('update.product.page');
    Route::post('/product/create/new','store')->name('new.product.create');
    Route::post('/product/update/{id}','update')->name('update.product');
    Route::get('/product/deleteproduct/{id}','delete')->name('delete.product');

});
Route::get('/product/create',function(){
    return view('products.create-new-product');
})->name('product.create');





// Route::post('/create',[ProductController::class,'store'])->name('store');


// fallback (if not found)
Route::fallback(function(){
    return "<h1>Page not found</h1>";
});
