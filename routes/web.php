<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\user\Diamond;
use App\Http\Controllers\user\Premium;
use App\Http\Controllers\user\Standard;
use App\Http\Controllers\fanpage\FanPage;

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
Route::get('/app/calendar', $controller_path . '\apps\Calendar@index')->name('app-calendar');
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

// User 
Route::get('/user/standard' , [Standard::class, 'index'])->name('user-standard');
Route::get('/user/premium' , [Premium::class, 'index'])->name('user-premium');
Route::get('/user/diamond' , [Diamond::class, 'index'])->name('user-diamond');

// Post
Route::resource('/posts', PostController::class);

// News
Route::get('/app/news', $controller_path . '\apps\news\News@index')->name('app-news');
Route::get('/app/news/add-news', $controller_path . '\apps\news\News@Create')->name('app-news-create');

// Music
Route::get('/musics/music', $controller_path . '\musics\music\Music@index')->name('music');
Route::get('/musics/add-music', $controller_path . '\musics\music\Music@create')->name('music-create');

//artist
Route::get('/musics/artist', $controller_path . '\musics\artist\Artist@index')->name('music-artist');
Route::get('/musics/add-artist', $controller_path . '\musics\artist\Artist@create')->name('music-artist-create');

// Video 
Route::get('/app/videos', $controller_path . '\apps\video\Video@index')->name('app-video');
Route::get('/app/videos/add-video', $controller_path . '\apps\video\Video@create')->name('app-video-create');
// School 
Route::get('/app/schools', $controller_path . '\apps\school\School@index')->name('app-school');
Route::get('/app/schools/add-school', $controller_path . '\apps\school\School@create')->name('app-school-create');
// Events 
Route::get('/app/events', $controller_path . '\apps\event\Event@index')->name('app-event');
Route::get('/app/events/add-event', $controller_path . '\apps\event\Event@create')->name('app-event-create');
// History 
Route::get('/app/history', $controller_path . '\apps\history\History@index')->name('app-history');
Route::get('/app/history/add-history', $controller_path . '\apps\history\History@create')->name('app-history-create');
// Tickets
Route::get('/app/tickets' , $controller_path . '\apps\tickets\Ticket@index')->name('app-ticket');
// InCome
Route::get('/app/income' , $controller_path . '\apps\income\Income@index')->name('app-income');
// Donation
Route::get('/app/donation' , $controller_path . '\apps\donation\Donation@index')->name('app-donation');
Route::get('/app/donation/add-donation' , $controller_path . '\apps\donation\Donation@create')->name('app-donation-create');
// Voting
Route::get('/app/voting' , $controller_path . '\apps\voting\Voting@index')->name('app-voting');
Route::get('/app/voting/add-voting' , $controller_path . '\apps\voting\Voting@create')->name('app-voting-create');
// Media
Route::get('/app/media' , $controller_path . '\apps\media\Media@index')->name('app-media');
Route::get('/app/media/add-media' , $controller_path . '\apps\media\Media@create')->name('app-media-create');
// Bazar
Route::get('/app/bazar' , $controller_path . '\apps\bazar\Bazar@index')->name('app-bazar');
Route::get('/app/bazar/category' , $controller_path . '\apps\bazar\Bazar@show_category')->name('app-bazar-category');
// Fan Page
Route::get('/new-request' , [FanPage::class, 'new_request_index'])->name('new-request');
Route::get('/manage-fanpage' , [FanPage::class, 'manage_fan_page_index'])->name('manage_fan_page');
Route::get('/blocked-fanpage' , [FanPage::class, 'block_fan_page_index'])->name('block_fan_page');

// Report Page
Route::get('/user-report' , $controller_path . '\report\Report@user_report')->name('user-report');
Route::get('/user-warning' , $controller_path . '\report\Report@user_warning')->name('user-warning');


// maps
Route::get('/maps/leaflet', $controller_path . '\maps\Leaflet@index')->name('maps-leaflet');



