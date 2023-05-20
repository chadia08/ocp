<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function(){
    return view('welcome');
});
Route::get('/users/CreateUser', 'App\Http\Controllers\UserController@CreateUser');
Route::post('users/NewUser', 'App\Http\Controllers\UserController@register');
Route::get('/users', 'App\Http\Controllers\UserController@users');
Route::get('/users/deleteUser/{id}', 'App\Http\Controllers\UserController@deleteUser');
Route::get('/stock','App\Http\Controllers\ArticleController@stock');
Route::get('/barcode','App\Http\Controllers\ArticleController@barcode');
Route::get('/articles/{id}','App\Http\Controllers\ArticleController@details');
Route::get('/stock/local','App\Http\Controllers\ArticleController@stocklocal');
Route::get('/stock/fictif','App\Http\Controllers\ArticleController@stockFictif');
Route::post('/createOt','App\Http\Controllers\OtController@insertOt');
Route::post('/CessionHorsZone','App\Http\Controllers\OtController@HorsZone');
Route::post('/CessionLocal','App\Http\Controllers\OtController@insertcessloc');
Route::post('/FictifCessionLocal','App\Http\Controllers\OtController@ficcessloc');
Route::post('/pdr/CreerArticle','App\Http\Controllers\OtController@creerArticle');
Route::post('/pdr/ArticleExistant','App\Http\Controllers\OtController@ExistArticle');

Route::get('/ot','App\Http\Controllers\OtController@selectOt');
Route::get('/pdr','App\Http\Controllers\OtController@selectPdr');
Route::get('/cessions','App\Http\Controllers\OtController@selectcessions');
// Route::get('/excel','App\Http\Controllers\EquipementController@index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/logout',function(){
    Session::flush();
    return redirect()->route('login');
});
