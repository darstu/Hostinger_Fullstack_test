<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CampaignItemController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\UserCampaignController;
use App\Http\Controllers\Api\UserController;

use function Ramsey\Uuid\v1;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('campaign', [CampaignController::class, 'index']);
Route::get('item', [ItemController::class, 'index']);
Route::get('user', [UserController::class, 'index']);
Route::get('rating', [RatingController::class, 'index']);
Route::get('userCampaign', [UserCampaignController::class, 'index']);
Route::get('campaignItem', [CampaignItemController::class, 'index']);
