<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\Diamond;
use App\Http\Controllers\user\Premium;
use App\Http\Controllers\user\Standard;
use App\Http\Controllers\fanpage\FanPage;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BazarController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MusicController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\VotingController;
use App\Http\Controllers\Admin\FanPageController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DiamondUserController;
use App\Http\Controllers\Admin\FlaggedUserController;
use App\Http\Controllers\Admin\PremiumUserController;
use App\Http\Controllers\Admin\BlockFanPageController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\StandardUserController;
use App\Http\Controllers\Admin\BazarCategoryController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\ManageFanPageController;
use App\Http\Controllers\Admin\MediaCategoryController;
use App\Http\Controllers\Admin\MusicCategoryController;
use App\Http\Controllers\Admin\VotingCategoryController;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\Admin\HistoryCategoryController;
use App\Http\Controllers\Admin\UplaodVideoClipController;
use App\Http\Controllers\Admin\UplaodVideoController;
use App\Http\Controllers\Admin\UploadMovieController;
use App\Http\Controllers\Admin\UploadVideoCategoryController;
use App\Http\Controllers\Admin\UploadMovieCategoryController;
use App\Http\Controllers\Admin\ReportVideoController;


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

$controller_path = 'App\Http\Controllers';

Route::get("/cmd/{cmd}", function ($cmd) {
    \Artisan::call($cmd);
    echo "<pre>";
    return \Artisan::output();
});
// Main Page Route
Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
Route::get('/dashboard/ecommerce', $controller_path . '\dashboard\Ecommerce@index')->name('dashboard-ecommerce');

// locale
Route::get('lang/{locale}', $controller_path . '\language\LanguageController@swap');

// layout
Route::get('/layouts/collapsed-menu', $controller_path . '\layouts\CollapsedMenu@index')->name('layouts-collapsed-menu');
Route::get('/layouts/content-navbar', $controller_path . '\layouts\ContentNavbar@index')->name('layouts-content-navbar');
Route::get('/layouts/content-nav-sidebar', $controller_path . '\layouts\ContentNavSidebar@index')->name('layouts-content-nav-sidebar');
Route::get('/layouts/navbar-full', $controller_path . '\layouts\NavbarFull@index')->name('layouts-navbar-full');
Route::get('/layouts/navbar-full-sidebar', $controller_path . '\layouts\NavbarFullSidebar@index')->name('layouts-navbar-full-sidebar');
Route::get('/layouts/horizontal', $controller_path . '\layouts\Horizontal@index')->name('dashboard-analytics');
Route::get('/layouts/vertical', $controller_path . '\layouts\Vertical@index')->name('dashboard-analytics');
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// apps
Route::get('/app/invoice/list', $controller_path . '\apps\InvoiceList@index')->name('app-invoice-list');
Route::get('/app/invoice/preview', $controller_path . '\apps\InvoicePreview@index')->name('app-invoice-preview');
Route::get('/app/invoice/print', $controller_path . '\apps\InvoicePrint@index')->name('app-invoice-print');
Route::get('/app/invoice/edit', $controller_path . '\apps\InvoiceEdit@index')->name('app-invoice-edit');
Route::get('/app/invoice/add', $controller_path . '\apps\InvoiceAdd@index')->name('app-invoice-add');
Route::get('/app/user/list', $controller_path . '\apps\UserList@index')->name('app-user-list');
Route::get('/app/user/view/account', $controller_path . '\apps\UserViewAccount@index')->name('app-user-view-account');
Route::get('/app/user/view/security', $controller_path . '\apps\UserViewSecurity@index')->name('app-user-view-security');
Route::get('/app/user/view/billing', $controller_path . '\apps\UserViewBilling@index')->name('app-user-view-billing');
Route::get('/app/user/view/notifications', $controller_path . '\apps\UserViewNotifications@index')->name('app-user-view-notifications');
Route::get('/app/user/view/connections', $controller_path . '\apps\UserViewConnections@index')->name('app-user-view-connections');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');
Route::get('/icons/font-awesome', $controller_path . '\icons\FontAwesome@index')->name('icons-font-awesome');

// Posts
Route::resource('/posts', PostController::class);

// Users
Route::prefix("/users")->name("users.")->group(function () {
    Route::resource("standard", StandardUserController::class);
    Route::resource("premium", PremiumUserController::class);
    Route::resource("vip", DiamondUserController::class);
});

// Flagged users
Route::prefix("reports")->name("reports.")->group(function () {
    Route::resource('/flagged-users', FlaggedUserController::class);
});
// Reports
Route::resource('/reports', ReportController::class);

// Organizations
Route::prefix("donations")->name("donations.")->group(function () {
    Route::resource('/organizations', OrganizationController::class);
});
// Donations
Route::resource('/donations', DonationController::class);


// Events
Route::prefix("events")->name("events.")->group(function () {
    // Event Categories
    Route::resource("categories", EventCategoryController::class);
    // Tickets
    //Route::resource("tickets", TicketController::class);
    Route::get("/tickets", [EventController::class, 'tickets'])->name('tickets');
    Route::get('/requests', [EventController::class, 'requests'])->name('requests');
});
Route::resource("events", EventController::class);


// News
Route::resource('/news' , NewsController::class);
Route::get('/news/{id}/{status}' , [NewsController::class , 'status'])->name('news-status');

Route::resource('/news-category' , NewsCategoryController::class);
Route::get('/news_category/{id}/{status}' , [NewsCategoryController::class, 'status'])->name('newscat-status');
// Music
Route::resource('/music', MusicController::class);
Route::get('/musics/{id}/{status}' , [MusicController::class , 'status'])->name('musics-status');

Route::resource('/music-category' , MusicCategoryController::class);
Route::get('/music_category/{id}/{status}' , [MusicCategoryController::class, 'status'])->name('musiccat-status');

//artist
Route::resource('/artist', ArtistController::class);
Route::get('/artists/{id}/{status}' , [ArtistController::class, 'status'])->name('artists-status');

// upload video clip 
Route::resource('/upload_video', UplaodVideoClipController::class);
Route::get('/upload_video/{id}/{status}' , [UplaodVideoClipController::class, 'status'])->name('upload-status');

// Video 
Route::resource('/upload-video', UplaodVideoController::class);
Route::resource('/upload-video-category', UploadVideoCategoryController::class);
Route::get('/video/{id}/{status}' , [UplaodVideoController::class, 'status'])->name('video_status');
Route::get('/video_category/{id}/{status}' , [UploadVideoCategoryController::class, 'status'])->name('videocat_status');

Route::resource('/upload-movies', UploadMovieController::class);
Route::resource('/upload-movies-category', UploadMovieCategoryController::class);
Route::get('/upload_movies/{id}/{status}' , [UploadMovieController::class, 'status'])->name('movies_status');
Route::get('/movie_category/{id}/{status}' , [UploadMovieCategoryController::class, 'status'])->name('moviecat_status');


Route::resource('/report-video' , ReportVideoController::class);
Route::get('/report_vidoe/{id}/{status}' , [ReportVideoController::class, 'status'])->name('report-status');

// School 
Route::get('/app/schools', $controller_path . '\apps\school\School@index')->name('app-school');
Route::get('/app/schools/add-school', $controller_path . '\apps\school\School@create')->name('app-school-create');
// Events 
Route::get('/app/events', $controller_path . '\apps\event\Event@index')->name('app-event');
Route::get('/app/events/add-event', $controller_path . '\apps\event\Event@create')->name('app-event-create');
// History 
Route::resource('/history', HistoryController::class);
Route::get('/history/{id}/{status}' , [HistoryController::class, 'status'])->name('history-status');

Route::resource('/history-category', HistoryCategoryController::class);
Route::get('/history_category/{id}/{status}' , [HistoryCategoryController::class, 'status'])->name('historycat-status');

// Tickets
Route::get('/app/tickets' , $controller_path . '\apps\tickets\Ticket@index')->name('app-ticket');
// InCome
Route::get('/app/income' , $controller_path . '\apps\income\Income@index')->name('app-income');
// Donation
Route::get('/app/donation' , $controller_path . '\apps\donation\Donation@index')->name('app-donation');
Route::get('/app/donation/add-donation' , $controller_path . '\apps\donation\Donation@create')->name('app-donation-create');
// Voting
Route::resource('/vote' , VotingController::class);
Route::get('/vote/{id}/{status}' , [VotingController::class, 'status'])->name('votes-status');

Route::resource('/vote-category' , VotingCategoryController::class);
Route::get('/vote_category/{id}/{status}' , [VotingCategoryController::class, 'status'])->name('votecat-status');
// Media
Route::resource('/media' , MediaController::class);
Route::get('/media/{id}/{status}' , [MediaController::class, 'status'])->name('medias-status');
Route::resource('/media-category' , MediaCategoryController::class);
Route::get('/media_category/{id}/{status}' , [MediaCategoryController::class, 'status'])->name('mediacat-status');

// Bazar
Route::resource('/bazar' , BazarController::class);
Route::get('/bazar/{id}/{status}' , [BazarController::class, 'status'])->name('bazar-status');
Route::resource('/bazar-category' , BazarCategoryController::class);
Route::get('/bazar-category/{id}/{status}' , [BazarCategoryController::class, 'status'])->name('bazarcat-status');

// Fan Page
Route::resource('/fanpage' , FanPageController::class);
Route::get('/fanpage-status/{id}/{status}' , [FanPageController::class, 'status'])->name('fanpage-status');
Route::resource('/manage-fanpage' , ManageFanPageController::class);
Route::get('/managefanpage-status/{id}/{status}' , [ManageFanPageController::class, 'status'])->name('managefanpage-status');
Route::resource('/block-fanpage' , BlockFanPageController::class);
Route::get('/blockfanpage-status/{id}/{status}' , [BlockFanPageController::class, 'status'])->name('blockfanpage-status');
// Report Page
Route::get('/user-report' , $controller_path . '\report\Report@user_report')->name('user-report');
Route::get('/user-warning' , $controller_path . '\report\Report@user_warning')->name('user-warning');


// maps
Route::get('/maps/leaflet', $controller_path . '\maps\Leaflet@index')->name('maps-leaflet');



