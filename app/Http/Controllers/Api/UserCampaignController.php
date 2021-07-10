<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCampaignResource;
use App\Models\User_Campaign;
use Illuminate\Http\Request;

class UserCampaignController extends Controller
{
    public function index()
    {
        return UserCampaignResource::collection(User_Campaign::all());
    }
}
