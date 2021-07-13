<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;

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

Route::get('/', function () {
    return view('layouts.app1');
});
Route::get('/mainPage', [AuthController::class, 'mainPage'])->name('mainPage');
Route::get('/login-form', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registration-form', [AuthController::class, 'registrationPage'])->name('registerPage');
Route::post('/registration', [AuthController::class, 'registration'])->name('register');
Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');
Route::post('/subscribe', [AuthController::class, 'subscribe']);
Route::post('/unsubscribe', [AuthController::class, 'unsubscribe']);
Route::post('/information', [CampaignController::class, 'index']);
Route::get('/participants/pdf/{index}', [CampaignController::class, 'createPDF'])->name('PDF');
