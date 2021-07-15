<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        return redirect()->route('mainPage');
    } else {
        return view('auth/login');
    }
})->name('/');


Route::get('/login-form', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/registration-form', [AuthController::class, 'registrationPage'])->name('registerPage');
Route::post('/registration', [AuthController::class, 'registration'])->name('register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/mainPage', [AuthController::class, 'mainPage'])->name('mainPage');
    Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');
    Route::get('/subscribe/{index}', [AuthController::class, 'subscribe'])->name('subscribe');
    Route::get('/rate/{index}', [CampaignController::class, 'rate'])->name('rate');
    Route::get('/rateCampaign/{index}', [CampaignController::class, 'rateCampaign'])->name('rateCampaign');
    Route::get('/unsubscribe/{index}', [AuthController::class, 'unsubscribe'])->name('unsubscribe');
    Route::get('/information/{index}', [CampaignController::class, 'index'])->name('information');
    Route::get('/participants/pdf/{index}', [CampaignController::class, 'createPDF'])->name('PDF');
    Route::get('/items', [ItemController::class, 'index'])->name('items');
    Route::get('/editItem', [ItemController::class, 'edit'])->name('editItem');
    Route::post('/confirmEditItem/{index}', [ItemController::class, 'confirmEditItem'])->name('confirmEditItem');
    Route::get('/deleteItem/{index}', [ItemController::class, 'deleteItem'])->name('deleteItem');
    Route::get('/campaigns', [CampaignController::class, 'campaigns'])->name('campaigns');
    Route::get('/editCampaign', [CampaignController::class, 'edit'])->name('editCampaign');
    Route::post('/confirmEditCampaign/{index}', [CampaignController::class, 'confirmEditCampaign'])->name('confirmEditCampaign');
    Route::get('/deleteCampaign/{index}', [CampaignController::class, 'deleteCampaign'])->name('deleteCampaign');
    Route::get('/removeItem/{index}', [CampaignController::class, 'removeItem'])->name('removeItem');
    Route::get('/addItem/{index}', [CampaignController::class, 'addItem'])->name('addItem');
    Route::post('/addItemToCampaign', [CampaignController::class, 'addItemToCampaign'])->name('addItemToCampaign');
    Route::get('/feedback/{index}', [CampaignController::class, 'feedback'])->name('lookFeedback');
    Route::post('/rateSave/{index}', [CampaignController::class, 'rateSave'])->name('rateSave');
    Route::post('/addCampaign', [CampaignController::class, 'addCampaign'])->name('addCampaign');
    Route::post('/addItems', [ItemController::class, 'addItems'])->name('addItems');
    Route::get('/createCampaign', [CampaignController::class, 'createCampaign'])->name('createCampaign');
    Route::get('/createItems', [ItemController::class, 'createItems'])->name('createItems');
});
