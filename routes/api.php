<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BazarController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\VotingController;
use App\Http\Controllers\Api\FanPageController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\DiamondUserController;
use App\Http\Controllers\Api\FlaggedUserController;
use App\Http\Controllers\Api\PremiumUserController;
use App\Http\Controllers\Api\BlockFanPageController;
use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\StandardUserController;
use App\Http\Controllers\Api\BazarCategoryController;
use App\Http\Controllers\Api\EventCategoryController;
use App\Http\Controllers\Api\ManageFanPageController;
use App\Http\Controllers\Api\MediaCategoryController;
use App\Http\Controllers\Api\MusicCategoryController;
use App\Http\Controllers\Api\VotingCategoryController;
use App\Http\Controllers\Api\HistoryCategoryController;
use App\Http\Controllers\Api\UploadVideoClipController;
use App\Http\Controllers\Api\UploadVideoCategoryController;
use App\Http\Controllers\Api\UploadVideoController;
use App\Http\Controllers\Api\UploadMovieCategoryController;
use App\Http\Controllers\Api\UploadMovieController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BazarSubCategoryController;
use App\Http\Controllers\Api\TwoFactorController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\PrivacyAndPolicyController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\AccountSettingController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\FeedBackgroundImageController;
use App\Http\Controllers\Api\UserSettingController;
use App\Http\Controllers\Api\FeedController;
use App\Http\Controllers\Api\RingtoneController;
use App\Http\Controllers\Api\UploadMediaController;


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
Route::resource("flagged-users", FlaggedUserController::class)->except(["create", "edit"]);
// Reports
Route::resource("reports", ReportController::class)->except(["create", "edit"]);

// Organizations
Route::resource("organizations", OrganizationController::class)->except(["create", "edit"]);
// Donations
Route::resource("donations", DonationController::class)->except(["create", "edit"]);

// Events
Route::resource("events", EventController::class)->except(["create", "edit"]);
// Event Categories
Route::resource("event-categories", EventCategoryController::class)->except(["create", "edit"]);
// Tickets
Route::resource("tickets", TicketController::class)->except(["create", "edit"]);

// Users
Route::prefix("/users")->name("users.")->group(function () {
    Route::resource("standard", StandardUserController::class);
    Route::resource("premium", PremiumUserController::class);
    Route::resource("diamond", DiamondUserController::class);
});

// News 
Route::resource('news', NewsController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('news-category', NewsCategoryController::class)->only(['index', 'store', 'update', 'show', 'destroy']);
Route::resource('music-category', MusicCategoryController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('music', MusicController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('artist', ArtistController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('video-clip', UploadVideoClipController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('fan-page', FanPageController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('manage-fanpage', ManageFanPageController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('voting', VotingController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('voting-category', VotingCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('media-category', MediaCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('media', MediaController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('history-category', HistoryCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('history', HistoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('bazar-category', BazarCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('bazar-subcategory', BazarSubCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);

Route::resource('bazar', BazarController::class)->only(['index', 'store', 'show', 'destroy', 'update']);

Route::resource('video-category', UploadVideoCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('video', UploadVideoController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('movie-category', UploadMovieCategoryController::class)->only(['index', 'store', 'show', 'destroy', 'update']);
Route::resource('movie', UploadMovieController::class)->only(['index', 'store', 'show', 'destroy', 'update']);


// User 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/signup', [AuthController::class, 'signup']);

Route::post('forgot-password', [AuthController::class, 'forgot_password']);

Route::post('change-password', [AuthController::class, 'change_password']);
Route::post('/reset/password', [AuthController::class, 'reset'])->name('password.reset');
Route::post('/reset', [AuthController::class, 'resetpassword'])->name('reset.complete');
Route::post('/reset/resend', [AuthController::class, 'reset_resend'])->name('reset.resend');

// Account Setting  Controller
Route::post('/change-password' , [AccountSettingController::class , 'change_password'])->name('change-password')->middleware('auth:sanctum');
Route::post('/send-email-code' , [AccountSettingController::class , 'send_email_code'] )->name('send-email-code');
Route::post('/resend-email' , [AccountSettingController::class , 'resend_email_code'] )->name('resend-email');
Route::post('/change-email' , [AccountSettingController::class , 'change_email'] )->name('change-email');
Route::post('/upgrade-account' , [AccountsettingController::class , 'upgrade_account'])->name('upgrade-account');

// Contact Us Controller
Route::post('/contact-us', [ContactUsController::class , 'contact_us'])->name('contact-us');


Route::post('2fa', [TwoFactorController::class, 'store'])->name('2fa.post');
Route::post('2fa/reset', [TwoFactorController::class, 'resend'])->name('2fa.resend');


// Country Controller 
Route::get('province', [CountryController::class , 'province'])->name('province');

// Privacy and Policy
Route::get('privacy', [PrivacyAndPolicyController::class , 'privacy'])->name('privacy');
Route::get('/single-privacy/{name}' , [PrivacyAndPolicyController::class , 'single_privacy'])->name('single_privacy');

// Translation
Route::prefix('/translate')->name('api.translate.')->group(function () {
    Route::get('/languages', [TranslationController::class, 'fetch_languages'])->name('languages');
    Route::get('/{id}', [TranslationController::class, 'translate'])->name('translate');
});

// User  Setting Controller 
Route::post('/user-setting/{user_id}' , [UserSettingController::class , 'index'])->name('user-setting');
Route::post('/user-setting/save', [UserSettingController::class , 'save'])->name('user-setting-save')->middleware('auth:sanctum');


// Feed Controller 
Route::get('share-feed' , [FeedController::class , 'shareWidget'])->name('share-feed');


// Ringtone Controller
Route::get('/ringtone', [RingtoneController::class , 'get'])->name('ringtone');

Route::post('/upload-media', [UploadMediaController::class, 'index']);
Route::post('/add-feed' , [FeedController::class , 'add_feed'])->name('add-feed');
Route::get('/fetch-feed' , [FeedController::class , 'fetch_feed'])->name('fetch-feed');
Route::get('/get-feed/{id}' , [FeedController::class , 'get_feed'])->name('get-feed');
Route::get('/get-first-feed/{id}' , [FeedController::class , 'get_first_feed'])->name('get-feed-first');


// Feed image backgroind
Route::post('/upload-background' , [FeedBackgroundImageController::class , 'upload'])->name('upload-background');
Route::get('/get-background', [FeedBackgroundImageController::class , 'get'])->name('get-background');
