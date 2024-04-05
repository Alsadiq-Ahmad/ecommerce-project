<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Shopping;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\App;


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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/dashboard', [Dashboard::class, 'Index'])->name('index');

Route::match(['get', 'post'], '/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');
// Route::post('/dashboard/products', [Dashboard::class, 'GetProducts'])->name('products');
Route::get('/del{id}', [Dashboard::class, 'Del'])->name('del');

Route::get('/deldetails/{id}', [Dashboard::class, 'DelDetails'])->name('del-details');

Route::get('/delcarts/{id}', [Shopping::class, 'DelCart'])->name('del-cart');


Route::get('/editdetails/{id}',[Dashboard::class,'EditDetails'])->name('edit-details');
Route::post('/updatedetails',[Dashboard::class,'UpdateDetails'])->name('update-details');

Route::get('/edit/{id}',[Dashboard::class,'Edit'])->name('edit-items');
Route::post('/update',[Dashboard::class,'Update'])->name('update-product');

Route::post('/dashboard/createproducts', [Dashboard::class, 'createproducts'])->name('CreateProducts');
// Route::post('/dashboard/search', [Dashboard::class, 'Search'])->name('search');
Route::get('/dashboard/searchdetails', [Dashboard::class, 'SearchProductDetails'])->name('search-details');

Route::get('/test', [Dashboard::class, 'test'])->name('test');

Route::get('/logout', [Dashboard::class, 'logout'])->name('logout');

Route::get('/dashboard/getproductdetails', [Dashboard::class, 'GetProductsDetails'])->name('product-details');

Route::post('/dashboard/createproductdetails', [Dashboard::class, 'createproductDetails'])->name('create-details');
Route::get('/shopping/showitems', [Shopping::class, 'ShowListItemsPhone'])->name('show-items-phone');
Route::get('/shopping/details/{id}', [Shopping::class, 'ShowDetailsPhone'])->name('show-items-details');

Route::get('/dashboard/count', [Dashboard::class,'countData'])->name('count');

Route::get('/shopping/add_to_cart/{id}', [Shopping::class,'Add_to_cart'])->name('add_to_cart');
// API route
Route::get('/shopping/getcafe', [Shopping::class,'getCafeHot']);
Route::get('getuserapi', [Shopping::class,'GetUsersAPI']);

Auth::routes();

Route::get('language/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/shopping/cartview', [Shopping::class, 'cartview'])->name('carts');



Route::get('/home', [HomeController::class, 'index'])->name('home');
