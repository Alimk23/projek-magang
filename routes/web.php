<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContributorController;
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
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/migratefs', function () {
    Artisan::call('migrate:fresh --seed');
});
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'checkRole']);
Route::get('/campaign/create/checkSlug', [CampaignController::class, 'checkSlug']);
Route::get('/campaigns/{slug}', [HomeController::class, 'show']);
Route::get('/status/{id}', [PaymentController::class, 'status']);
Route::get('/payment/getReceiverInfo', [PaymentController::class, 'getReceiverInfo']);
Route::get('/payment/getPaymentInfo', [PaymentController::class, 'getPaymentInfo']);
Route::get('profile/getLoginInfo', [ProfileController::class, 'getLoginInfo']);
Route::get('profile/getProfileInfo', [ProfileController::class, 'getProfileInfo']);
Route::get('profile/getCompanyInfo', [ProfileController::class, 'getCompanyInfo']);

Route::resources([
    'admin' => DashboardController::class,
    'user' => UserController::class,
    'campaign' => CampaignController::class,
    'category' => CategoryController::class,
    'profile' => ProfileController::class,
    'company' => CompanyController::class,
    'bank' => BankController::class,
    'donation' => DonationController::class,
    'payment' => PaymentController::class,
    'contributor' => ContributorController::class,
]);
