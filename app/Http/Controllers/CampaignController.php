<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Item;
use App\Models\Campaign_Item;
use App\Models\User_Campaign;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaign = Campaign::where('id', '=', $request->campaign_id)->first();
        $campaign_users = User_Campaign::where('campaign_id', '=', $request->campaign_id)->get();
        $users = User::all();
        $items = Item::all();
        $campaign_items = Campaign_Item::where('campaign_id', '=', $request->campaign_id)->get();

        return view('campaign', compact('campaign', 'items', 'campaign_items', 'campaign_users', 'users'));
    }

    public function createPDF($index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $campaign_users = User_Campaign::where('campaign_id', '=', $index)->get();
        $users = User::all();
        //view()->share(compact('campaign', 'campaign_users', 'users'));
        $pdf = PDF::loadView('participants', compact('campaign', 'campaign_users', 'users'));

        return $pdf->download('pdf_file.pdf');
    }
}
