<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\FolioController;
use App\Http\Controllers\ImageFolioController;
use App\Http\Controllers\ImageServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//, 'middleware' => 'auth:api'

Route::group(['prefix' => 'companies'], function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::post('/', [CompanyController::class, 'store'])->middleware('auth:api');

    Route::get('/{company}', [CompanyController::class, 'show']);
    Route::patch('/{company}', [CompanyController::class, 'update'])->middleware('auth:api');
    Route::delete('/{company}', [CompanyController::class, 'destroy'])->middleware('auth:api');;

});


Route::group(['prefix' => 'services'], function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store'])->middleware('auth:api');
    Route::get('/{service}', [ServiceController::class, 'show']);
    Route::patch('/{service}', [ServiceController::class, 'update'])->middleware('auth:api');
    Route::delete('/{service}', [ServiceController::class, 'destroy'])->middleware('auth:api');

});


Route::group(['prefix' => 'image-services'], function () {
    Route::get('/', [ImageServiceController::class, 'index']);
    Route::post('/', [ImageServiceController::class, 'store'])->middleware('auth:api');
    Route::get('/{id}', [ImageServiceController::class, 'show']);

});


Route::group(['prefix' => 'folios'], function () {
    Route::get('/', [FolioController::class, 'index']);
    Route::post('/', [FolioController::class, 'store'])->middleware('auth:api');
    Route::get('/{folio}', [FolioController::class, 'show']);
    Route::patch('/{folio}', [FolioController::class, 'update'])->middleware('auth:api');
    Route::delete('/{folio}', [FolioController::class, 'destroy'])->middleware('auth:api');

});


Route::group(['prefix' => 'request-demo'], function () {
    Route::get('/', [DemoController::class, 'index']);
    Route::post('/', [DemoController::class, 'store']);

});


Route::group(['prefix' => 'users'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

});


Route::group(['prefix' => 'image-folios'], function () {
    Route::get('/', [ImageFolioController::class, 'index']);
    Route::post('/', [ImageFolioController::class, 'store'])->middleware('auth:api');
    Route::get('/{id}', [ImageFolioController::class, 'show']);

});


Route::group(['prefix' => 'pages'], function () {
    Route::get('/', [PageController::class, 'index']);
    Route::post('/', [PageController::class, 'store'])->middleware('auth:api');
    Route::get('/{id}', [PageController::class, 'show']);
    Route::patch('/{id}', [PageController::class, 'update'])->middleware('auth:api');
    Route::delete('/{id}', [PageController::class, 'destroy'])->middleware('auth:api');

});


Route::group(['prefix' => 'partners'], function () {
    Route::get('/', [PartnerController::class, 'index']);
    Route::post('/', [PartnerController::class, 'store'])->middleware('auth:api');
    Route::get('/{id}', [PartnerController::class, 'show']);

});







