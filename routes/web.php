<?php
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Route::get('/home','App\Http\Controllers\OtController@returnHome'); 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/telecharger-excel', 'App\Http\Controllers\ExcelController@telechargerExcel')->name('telecharger.excel');
    Route::get('/users', 'App\Http\Controllers\UserController@users');
    Route::get('/articles','App\Http\Controllers\ArticleController@selectArticles');
    Route::get('/users/CreateUser', 'App\Http\Controllers\UserController@CreateUser');
    Route::post('users/NewUser', 'App\Http\Controllers\UserController@register');
    Route::get('/users/deleteUser/{id}', 'App\Http\Controllers\UserController@deleteUser');
    Route::get('/stock','App\Http\Controllers\ArticleController@stock');
    // Route::get('/barcode','App\Http\Controllers\ArticleController@barcode');
    Route::get('/articles/{id}','App\Http\Controllers\ArticleController@details');
    Route::get('/stock/local','App\Http\Controllers\ArticleController@stocklocal');
    Route::get('/stock/fictif','App\Http\Controllers\ArticleController@stockFictif');
    Route::post('/createOt','App\Http\Controllers\OtController@insertOt');
    Route::post('/CessionHorsZone','App\Http\Controllers\OtController@HorsZone');
    Route::post('/CessionLocal','App\Http\Controllers\OtController@insertcessloc');
    Route::post('/FictifCessionLocal','App\Http\Controllers\OtController@ficcessloc');
    Route::post('/pdr/CreerArticle','App\Http\Controllers\OtController@creerArticle');
    Route::post('/pdr/ArticleExistant','App\Http\Controllers\OtController@ExistArticle');

Route::get('/error',function(){
    return view('error');
});
    Route::get('/consommation','App\Http\Controllers\OtController@selectCons');
    Route::get('/cessions','App\Http\Controllers\OtController@selectcessions');
    Route::post('/consommation/otLocal','App\Http\Controllers\OtController@otlocal');
    Route::post('/consommation/otFictif','App\Http\Controllers\OtController@otfictif');
    Route::post('/consommation/OtLocalFictif','App\Http\Controllers\OtController@otlocalfictif');
    Route::post('/submitdprf','App\Http\Controllers\OtController@SubmitDprf');
    Route::post('/passerdprf','App\Http\Controllers\OtController@PasserDprf');
    Route::post('/PasserDa','App\Http\Controllers\OtController@passerda');
    Route::post('/modifierQte','App\Http\Controllers\OtController@modifierqte');

    Route::post('/AvancerDa','App\Http\Controllers\OtController@avancerDA'); 
    Route::post('/AvancerCommande','App\Http\Controllers\OtController@avancerCmd');
    Route::get('/dashboard','App\Http\Controllers\OtController@selectbar'); 

    // Route::get('/excel','App\Http\Controllers\EquipementController@index');


    Route::get('/dashboard', function () {
    $progress = DB::table('ot')
        ->join('article', 'ot.code_article', '=', 'article.code_article')
        ->join('famille','article.code_famille','=','famille.code_famille')
        ->where('type', '=', 'DA')
        ->get();
    
    $users = DB::table('users')->get();
    $ot = DB::table('ot')->get();
    $cmd = DB::table('ot')->where('statut','=','CMD')->get();
    
    $local= DB::table('stock')
        ->where('nom_magasin', '=', 'local')
        ->take(5)
        ->get();

    $fictif= DB::table('stock')
        ->where('nom_magasin', '=', 'fictif')
        ->take(5)
        ->get();
    
    $stockLocal = json_encode($local);
    $stockFictif = json_encode($fictif);

        return view('dashboard',['progress' => $progress,'users'=>$users,'ot'=>$ot,'cmd'=>$cmd,'stockLocal'=>$stockLocal,'stockFictif'=>$stockFictif]);
    })->name('dashboard');
});
Route::get('/logout',function(){
    //Session::flush();
    Auth::logout();
    return redirect('/home');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/users/CreateUser', 'App\Http\Controllers\UserController@CreateUser');
});

Route::middleware(['auth','role:admin,niveau2'])->group(function(){

    
    Route::get('/dprf','App\Http\Controllers\OtController@selectdprf');
    Route::get('/ot','App\Http\Controllers\OtController@selectOt');
    Route::get('/pdr','App\Http\Controllers\OtController@selectPdr');
    Route::get('/AttenteApprovisionnement','App\Http\Controllers\OtController@SelectAtt');
    Route::get('/da','App\Http\Controllers\OtController@selectDa'); 
    Route::get('/commande','App\Http\Controllers\OtController@selectCmd');
    Route::get('/notifications','App\Http\Controllers\ArticleController@selectNotifs');
});
    