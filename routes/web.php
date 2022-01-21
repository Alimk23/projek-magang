<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DonationController;

use App\Http\Controllers\UserDataController;
use App\Http\Controllers\User\DashboardController as userDashboard;
use App\Http\Controllers\User\UserProfileController as userProfile;
use App\Http\Controllers\User\FundraisingController as userFundraising;
use App\Http\Controllers\User\DonationController as userDonation;


use App\Http\Controllers\Admin\BankController as adminBank;
use App\Http\Controllers\Admin\NewsController as adminNewsInfo;
use App\Http\Controllers\Admin\CompanyController as adminCompany;
use App\Http\Controllers\Admin\ProfileController as adminProfile;
use App\Http\Controllers\Admin\CampaignController as adminCampaign;
use App\Http\Controllers\Admin\WithdrawController as adminWithdraw;
use App\Http\Controllers\Admin\FundraiserController as adminFundraiser;
use App\Http\Controllers\Admin\CustomerServiceController as adminCustomerService;

use App\Http\Controllers\Admin\DashboardController as adminDashboard;
use App\Http\Controllers\SuperAdmin\BankController as superAdminBank;
use App\Http\Controllers\Admin\ContributorController as adminContributor;
use App\Http\Controllers\SuperAdmin\CompanyController as superAdminCompany;
use App\Http\Controllers\SuperAdmin\PaymentController as superAdminPayment;
use App\Http\Controllers\SuperAdmin\CampaignController as superAdminCampaign;
use App\Http\Controllers\SuperAdmin\CategoryController as superAdminCategory;
use App\Http\Controllers\SuperAdmin\SettingsController as superAdminSettings;
use App\Http\Controllers\SuperAdmin\WithdrawController as superAdminWithdraw;
use App\Http\Controllers\SuperAdmin\AnalyticsController as superAdminAnalytics;
use App\Http\Controllers\SuperAdmin\DashboardController as superadminDashboard;
use App\Http\Controllers\SuperAdmin\FundraiserController as superAdminFundraiser;
use App\Http\Controllers\SuperAdmin\ContributorController as superAdminContributor;

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
Route::get('/ms', function () {
    Artisan::call('migrate --seed');
    return "Successfull";
});
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'redirectUrl']);
Route::get('/admin/campaign/create/checkSlug', [adminCampaign::class, 'checkSlug']);
Route::get('/admin/withdraw/create/checkCampaign', [adminWithdraw::class, 'checkCampaign']);
Route::get('/campaigns/{slug}', [HomeController::class, 'show']);
Route::get('/status/{id}', [PaymentController::class, 'status']);

Route::get('/user-data/getLoginInfo', [UserDataController::class, 'getLoginInfo']);
Route::get('/user-data/getProfileInfo', [UserDataController::class, 'getProfileInfo']);
Route::get('/user-data/getCompanyInfo', [UserDataController::class, 'getCompanyInfo']);
Route::get('/user-data/withdraw/getWithdrawInfo', [UserDataController::class, 'getWithdrawInfo']);
Route::get('/payment/getReceiverInfo', [superAdminPayment::class, 'getReceiverInfo']);
Route::get('/payment/getPaymentInfo', [superAdminPayment::class, 'getPaymentInfo']);
Route::get('/campaign/getCampaignInfo', [superAdminCampaign::class, 'getCampaignInfo']);

Route::resource('userdata', UserDataController::class);
Route::resource('donation', DonationController::class)->except('index','destroy','update');
Route::resource('payment', PaymentController::class)->except('index','destroy');
Route::resource('profile', adminProfile::class)->only('show');
Route::resource('category', superAdminCategory::class)->only('show');

Route::middleware(['auth','User'])->group(function () {
    Route::resource('user', userDashboard::class)->only('index');
    Route::resource('user/fundraising', userFundraising::class);
    Route::resource('user/profile', userProfile::class);
    Route::resource('user/donation', userDonation::class);
});
Route::middleware(['auth','Admin'])->group(function () {
    Route::resource('admin', adminDashboard::class)->only('index');
    Route::resource('admin/campaign', adminCampaign::class)->except('show');
    Route::resource('admin/contributor', adminContributor::class)->only('index','destroy');
    Route::resource('admin/fundraiser', adminFundraiser::class)->only('index');
    Route::resource('admin/profile', adminProfile::class)->except('edit','create', 'destroy','show');
    Route::resource('admin/company', adminCompany::class)->only('update');
    Route::resource('admin/bank', adminBank::class)->except('show');
    Route::resource('admin/news', adminNewsInfo::class);
    Route::resource('admin/withdraw', adminWithdraw::class);
    Route::resource('admin/customer-service', adminCustomerService::class);
    Route::get('admin/donation', [DonationController::class, 'index']);
    Route::patch('admin/donation/{donation}', [DonationController::class, 'update']);
    Route::delete('admin/donation/{donation}', [DonationController::class, 'destroy']);
});
Route::middleware(['auth','SuperAdmin'])->group(function () {
    Route::resource('superadmin', superadminDashboard::class)->only('index');
    Route::resource('superadmin/category', superAdminCategory::class)->except('show');
    Route::resource('superadmin/bank', superAdminBank::class)->except('show');
    Route::resource('superadmin/contributor', superAdminContributor::class);
    Route::resource('superadmin/company', superAdminCompany::class)->only('update');
    Route::resource('superadmin/fundraiser', superAdminFundraiser::class)->except('update','edit');
    Route::resource('superadmin/payment', superAdminPayment::class)->only('index','update','destroy');
    Route::resource('superadmin/campaign', superAdminCampaign::class)->only('index','update','destroy','show');
    Route::resource('superadmin/withdraw', superAdminWithdraw::class)->only('index','update','destroy');
    Route::resource('superadmin/settings', superAdminSettings::class)->only('index','update','destroy');
    Route::resource('superadmin/analytics', superAdminAnalytics::class)->only('index','update','destroy');
});
