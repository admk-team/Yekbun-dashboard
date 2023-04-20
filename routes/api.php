<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\DiamondUserController;
use App\Http\Controllers\Api\FlaggedUserController;
use App\Http\Controllers\Api\PremiumUserController;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\StandardUserController;
use App\Http\Controllers\Api\MusicCategoryController;
use App\Http\Controllers\Api\UploadVideoClipController;
use App\Http\Controllers\Api\FanPageController;
use App\Http\Controllers\Api\ManageFanPageController;
use App\Http\Controllers\Api\BlockFanPageController;
use App\Http\Controllers\Api\VotingController;
use App\Http\Controllers\Api\VotingCategoryController;
use App\Http\Controllers\Api\MediaCategoryController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\HistoryCategoryController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\BazarCategoryController;
use App\Http\Controllers\Api\BazarController;


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
// Flagged users
Route::prefix("reports")->name("reports.")->group(function () {
    Route::resource("flagged-users", FlaggedUserController::class)->except(["create", "edit"]);
});
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
Route::resource('video-clip' , UploadVideoClipController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('fan-page' , FanPageController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('manage-fanpage' , ManageFanPageController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('voting' , VotingController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('voting-category' , VotingCategoryController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('media-category' , MediaCategoryController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('media' , MediaController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('history-category' , HistoryCategoryController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('history' , HistoryController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('bazar-category' , BazarCategoryController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);
Route::resource('bazar' , BazarController::class)->only(['index', 'store', 'show', 'destroy' ,'update']);