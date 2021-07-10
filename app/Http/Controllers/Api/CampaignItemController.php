<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignItemResource;
use App\Models\Campaign_Item;
use Illuminate\Http\Request;

class CampaignItemController extends Controller
{
    public function index()
    {
        return CampaignItemResource::collection(Campaign_Item::all());
    }
}
