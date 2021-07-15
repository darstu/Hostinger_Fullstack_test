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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Rating;

class CampaignController extends Controller
{

    public function index($index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $campaign_users = User_Campaign::where('campaign_id', '=', $index)->get();
        $users = User::all();
        $user = User::where('id', '=', Auth::user()->id)->first();
        $items = Item::all();
        $campaign_items = Campaign_Item::where('campaign_id', '=', $index)->get();
        $count = Rating::where('campaign_id', '=', $index)->get();
        $c = count($count);
        $rating = 0;
        if ($c != 0) {
            foreach ($count as $cou) {
                $rating = $rating + $cou->rating;
            }
            $rating = $rating / $c;
            $rating = round($rating * 2) / 2;
        }
        //$rating = $this.calculateRating($index);

        return view('campaign', compact('campaign', 'rating', 'items', 'user', 'campaign_items', 'campaign_users', 'users'));
    }
    private function calculateRating($index)
    {
        $count = Rating::where('campaign_id', '=', $index)->get();
        $c = count($count);
        $rate = 0;
        if ($c != 0) {
            foreach ($count as $cou) {
                $rate = $rate + $cou->rating;
            }
            $rate = $rate / $c;
            $rate = round($rate * 2) / 2;
        }
        return $rate;
    }

    public function rate($index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $user = User::where('id', '=', Auth::user()->id)->first();

        return view('feedback', compact('campaign', 'user'));
    }

    public function rateSave(Request $request, $index)
    {
        $data = Rating::Create([
            'rating' => $request->input('stars'),
            'feedback' => $request->input('Feedback'),
            'user_id' => Auth::user()->id,
            'campaign_id' => $index
        ]);
        return Redirect::route('mainPage')->with('success', 'You have submitted your feedback');
    }

    public function createPDF($index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $campaign_users = User_Campaign::where('campaign_id', '=', $index)->get();
        $users = User::all();
        //view()->share(compact('campaign', 'campaign_users', 'users'));
        $pdf = PDF::loadView('participants', compact('campaign', 'campaign_users', 'users'));

        return $pdf->download('participants.pdf');
    }

    public function campaigns()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();

        return view('campaigns', compact('user'));
    }
    public function edit(Request $request)
    {
        $query = $request->get('q');
        $user = User::where('id', '=', Auth::user()->id)->first();
        $campaign = Campaign::where('id', '=', $query)->first();
        $campaign_items = Campaign_Item::where('campaign_id', '=', $query)->get();
        $items = Item::all();
        return view('campaignPage', compact('campaign', 'user', 'items', 'campaign_items'));
    }

    public function confirmEditCampaign(Request $request, $index)
    {
        $validator = Validator::make(
            [
                'campaign_name' => $request->input('campaign_name'),
                'status' => $request->input('status'),
                'dispatch_date' => $request->input('dispatch_date'),
                'delivery_date' => $request->input('delivery_date')
            ],
            [
                'campaign_name' => 'required|min:3|max:40',
                'status' => 'required',
                'dispatch_date' => 'required',
                'delivery_date' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $data = Campaign::where('id', '=', $index)->update(
                [
                    'campaign_name' => $request->input('campaign_name'),
                    'status' => $request->input('status'),
                    'dispatch_date' => $request->input('dispatch_date'),
                    'delivery_date' => $request->input('delivery_date')
                ]
            );
        }
        return Redirect::route('campaigns')->with('success', 'Campaign information was edited');
    }

    public function deleteCampaign($index)
    {
        $campaign_items = Campaign_Item::where('campaign_id', '=', $index)->delete();
        $data = Campaign::where('id', '=', $index)->delete();
        return Redirect::route('campaigns')->with('success', 'Campaign deleted');
    }

    public function removeItem($index)
    {
        $campaign_items = Campaign_Item::where('gift_id', '=', $index)->delete();
        return Redirect::back()->with('success', 'Item removed');
    }

    public function addItem(Request $request, $index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $items = Item::all();
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('addItem', compact('user', 'campaign', 'items'));
    }

    public function addItemToCampaign(Request $request)
    {
        $data = Campaign_Item::create([
            'campaign_id' => $request->input('campaign_id'),
            'gift_id' => $request->input('id'),
            'gift_item_count' => $request->input('gift_item_count'),
        ]);
        return Redirect::route('campaigns')->with('success', 'Item added');
    }

    public function feedback($index)
    {
        $campaign = Campaign::where('id', '=', $index)->first();
        $feedback = Rating::where('campaign_id', '=', $index)->get();

        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('comments', compact('campaign', 'feedback', 'user'));
    }

    public function addCampaign(Request $request)
    {
        $validator = Validator::make(
            [
                'campaign_name' => $request->input('campaign_name'),
                'status' => $request->input('status'),
                'dispatch_date' => $request->input('dispatch_date'),
                'delivery_date' => $request->input('delivery_date')
            ],
            [
                'campaign_name' => 'required|min:3|max:40',
                'status' => 'required',
                'dispatch_date' => 'required',
                'delivery_date' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            Campaign::Create([
                'campaign_name' => $request->input('campaign_name'),
                'status' => $request->input('status'),
                'dispatch_date' => $request->input('dispatch_date'),
                'delivery_date' => $request->input('delivery_date')
            ]);
        }
        return Redirect::route('campaigns')->with('success', 'Campaign was created');
    }
    public function createCampaign()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('addCampaign', compact('user'));
    }
}
