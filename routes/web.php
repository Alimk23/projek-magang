<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'checkRole']);
Route::get('/campaign/create/checkSlug', [CampaignController::class, 'checkSlug']);
Route::get('/campaigns/{slug}', [HomeController::class, 'show']);
Route::get('/status/{id}', [PaymentController::class, 'status']);

Route::resources([
    'admin' => DashboardController::class,
    'campaign' => CampaignController::class,
    'category' => CategoryController::class,
    'profile' => ProfileController::class,
    'bank' => BankController::class,
    'donation' => DonationController::class,
    'payment' => PaymentController::class,
]);
