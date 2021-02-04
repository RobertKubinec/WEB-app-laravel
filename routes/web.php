<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

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
});

Route::get('/welcome', [App\Http\Controllers\PagesRouteController::class, 'welcome'])->name('welcome');
Route::get('/factsAboutSlovakia', [App\Http\Controllers\PagesRouteController::class, 'facts'])->name('factsAboutSlovakia');
Route::get('/touristMapSlovakia', [App\Http\Controllers\PagesRouteController::class, 'map'])->name('touristMapSlovakia');
Route::get('/sightseeings', [App\Http\Controllers\PagesRouteController::class, 'sights'])->name('sightseeings');
Route::get('/caves', [App\Http\Controllers\PagesRouteController::class, 'caves'])->name('caves');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//do vnutra ma pusti len vtedy, ak je konkretny clovek prihlaseny
//protect route from an unauthorized access
Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', \App\Http\Controllers\UserController::class);
    Route::get('user/{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');
});



Route::resource('articles', \App\Http\Controllers\ArticlesController::class);
Route::get('/article', [App\Http\Controllers\PagesRouteController::class, 'articles'])->name('article');