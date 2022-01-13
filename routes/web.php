<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DonationController;

use App\Http\Controllers\Admin\BankController as adminBank;
use App\Http\Controllers\Admin\CompanyController as adminCompany;
use App\Http\Controllers\Admin\ProfileController as adminProfile;
use App\Http\Controllers\Admin\CampaignController as adminCampaign;
use App\Http\Controllers\Admin\CategoryController as adminCategory;
use App\Http\Controllers\Admin\DashboardController as adminDashboard;
use App\Http\Controllers\Admin\ContributorController as adminContributor;
use App\Http\Controllers\Admin\NewsController as adminNewsInfo;
use App\Http\Controllers\SuperAdmin\DashboardController as superadminDashboard;
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
    return "Successfull";
});
Route::get('/mfs', function () {
    Artisan::call('migrate:fresh --seed');
    return "Successfull";
});
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'checkRole']);
Route::get('/admin/campaign/create/checkSlug', [adminCampaign::class, 'checkSlug']);
Route::get('/campaigns/{slug}', [HomeController::class, 'show']);
Route::get('/status/{id}', [PaymentController::class, 'status']);

Route::get('/payment/getReceiverInfo', [PaymentController::class, 'getReceiverInfo']);
Route::get('/payment/getPaymentInfo', [PaymentController::class, 'getPaymentInfo']);
Route::get('profile/getLoginInfo', [adminProfile::class, 'getLoginInfo']);
Route::get('/profile/getProfileInfo', [adminProfile::class, 'getProfileInfo']);
Route::get('/profile/getCompanyInfo', [adminProfile::class, 'getCompanyInfo']);

Route::resource('donation', DonationController::class)->except('index','destroy','update');
Route::resource('payment', PaymentController::class)->except('index','destroy');
Route::resource('profile', adminProfile::class)->only('show');
Route::resource('category', adminCategory::class)->only('show');

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::resource('admin', adminDashboard::class)->only('index');
    Route::resource('admin/campaign', adminCampaign::class)->except('destroy','show');
    Route::resource('admin/contributor', adminContributor::class)->only('index','destroy');
    Route::resource('admin/category', adminCategory::class)->except('show');;
    Route::resource('admin/profile', adminProfile::class)->except('edit','create', 'destroy','show');
    Route::resource('admin/company', adminCompany::class)->only('update');
    Route::resource('admin/bank', adminBank::class)->except('show');
    Route::resource('admin/news', adminNewsInfo::class);
    Route::get('admin/donation', [DonationController::class, 'index']);
    Route::get('admin/payment', [PaymentController::class, 'index']);
    Route::patch('admin/donation/{donation}', [DonationController::class, 'update']);
    Route::delete('admin/donation/{donation}', [DonationController::class, 'destroy']);
    Route::delete('admin/payment/{payment}', [PaymentController::class, 'destroy']);
});
Route::middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::resource('superadmin', superadminDashboard::class)->only('index');
});
