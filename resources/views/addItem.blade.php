@extends('layouts.app')
@section('content')

<h5 style="margin:auto; width:50%; text-align: center">Add item to {{ $campaign->campaign_name }}:</h5>
<div class="container">
    <div class="card col-5" style="margin: auto; margin-top: 15px">
        <form role="form" method="POST" action="{{ route('addItemToCampaign') }}">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="id" class="col-6">Item:</label>
                <div class="col-6">
                    <select
                        style="background-color: rgb(206, 205, 205); padding: 0 10px 0 10px;  width: 200px; border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                        id="id" required name="id">
                        @foreach($items as $it)
                        <option value="{{$it->id}}"> {{$it->name}} {{ $it->unit_price }} eur.</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
            <div class="row">
                <label for="gift_item_count" class="col-6">Quantity:</label>
                <div class="col-6">
                    <input id="gift_item_count"
                        style="background-color: rgb(206, 205, 205); padding: 0 10px 0 10px; width: 200px;  border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                        type="number" name="gift_item_count">
                </div>
            </div>
            <div class="mainMeniuBTN btn">
                <button type="submit" class="btn editButton">Add</button>
            </div>
        </form>
    </div>
</div>

@endsection
