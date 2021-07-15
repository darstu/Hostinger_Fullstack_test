<?php

namespace App\Http\Controllers;

use App\Models\Campaign_Item;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();

        return view('items', compact('user'));
    }
    public function edit(Request $request)
    {
        $query = $request->get('q');
        $user = User::where('id', '=', Auth::user()->id)->first();
        $item = Item::where('id', '=', $query)->first();
        return view('itemPage', compact('item', 'user'));
    }

    public function confirmEditItem(Request $request, $index)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'unit_price' => $request->input('unit_price')
            ],
            [
                'name' => 'required|min:3|max:40',
                'unit_price' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            if ($request->input('units_owned') != null) {
                $un = Item::where('id', '=', $index)->first();
                $units = $un->units_owned + $request->input('units_owned');
                $data = Item::where('id', '=', $index)->update(
                    [
                        'name' => $request->input('name'),
                        'units_owned' => $units,
                        'unit_price' => $request->input('unit_price')
                    ]
                );
            } else {
                $data = Item::where('id', '=', $index)->update(
                    [
                        'name' => $request->input('name'),
                        'unit_price' => $request->input('unit_price')
                    ]
                );
            }
        }
        return Redirect::route('items')->with('success', 'Item information was edited');
    }

    public function deleteItem($index)
    {
        $count = Campaign_Item::where('gift_id', '=', $index)->get();
        $c = count($count);
        if ($c == 0) {
            $data = Item::where('id', '=', $index)->delete();
            return Redirect::route('items')->with('success', 'Item deleted');
        } else {
            return Redirect::route('items')->with('error', 'Item belongs to gift campaign');
        }
    }
    public function addItems(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->input('name'),
                'units_owned' => $request->input('units_owned'),
                'unit_price' => $request->input('unit_price')
            ],
            [
                'name' => 'required|min:3|max:40',
                'units_owned' => 'required',
                'unit_price' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            Item::Create([
                'name' => $request->input('name'),
                'units_owned' => $request->input('units_owned'),
                'unit_price' => $request->input('unit_price')
            ]);
        }
        return Redirect::route('items')->with('success', 'Item was created');
    }
    public function createItems()
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('addItems', compact('user'));
    }
}
