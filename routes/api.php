<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DiamondUserController;
use App\Http\Controllers\Api\PremiumUserController;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\StandardUserController;
use App\Http\Controllers\Api\MusicCategoryController;

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

// Posts
Route::resource("posts", PostController::class)->except(["create", "edit"]);
// Reports
Route::resource("reports", ReportController::class)->except(["create", "edit"]);

// Users
Route::prefix("/users")->name("users.")->group(function () {
    Route::resource("standard", StandardUserController::class);
    Route::resource("premium", PremiumUserController::class);
    Route::resource("diamond", DiamondUserController::class);
});

// News 
Route::resource('news' , NewsController::class)->only(['index', 'store', 'show', 'update' ,'destroy']);
Route::resource('news-category' , NewsCategoryController::class)->only(['index', 'store', 'update' , 'show', 'destroy']);
Route::resource('music-category' , MusicCategoryController::class)->only(['index', 'store', 'show', 'update' , 'destroy']);
Route::resource('music' , MusicController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('artist' , ArtistController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
