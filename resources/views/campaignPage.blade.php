@extends('layouts.app')
@section('content')
<div class="mainMeniuBTN btn" style="background-color: rgb(187, 35, 14)">
    <a class="seemlessLink" href="{{ route('deleteCampaign', ['index' => $campaign->id]) }}">Delete campaign</a>
</div>
<h5 style="margin:auto; width:50%; text-align: center">Campaign "{{ $campaign->campaign_name }}" information:</h5>
<div class="container">
    <div class="card col-6" style="margin: auto; margin-top: 15px">
        <form role="form" method="POST" action="{{ route('confirmEditCampaign', ['index' => $campaign->id]) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="campaign_name" class="col-7">Campaign name: </label>
                <input type="text"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="campaign_name" required name="campaign_name" value="{{$campaign->campaign_name}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="status" class="col-7">Status:</label>
                <select class="col-4"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    id="status" required name="status">
                    <option value="{{$campaign->status}}">{{$campaign->status}}</option>
                    <option value="preparing">preparing</option>
                    <option value="ready">ready</option>
                    <option value="dispatched">dispatched</option>
                    <option value="completed">completed</option>
                </select>
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="dispatch_date" class="col-7">Dispatch date:</label>
                <input type="date"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="dispatch_date" name="dispatch_date" required value="{{$campaign->dispatch_date}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="delivery_date" class="col-7">Delivery date:</label>
                <input type="date"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="delivery_date" name="delivery_date" required value="{{$campaign->delivery_date}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="status" class="col-7">Items:</label>

                <a class="seemlessLink col-1" style=" text-align:center; margin 5px 5px 5px 5px; "
                    href="{{ route('addItem', ['index' => $campaign->id]) }}">
                    <div class="mainMeniuBTN btn"
                        style="background-color: rgb(29, 151, 39); font-weight: bold; width: 30px; height: 30px">
                        +</div>
                </a>
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                @foreach ($campaign_items as $citem)
                @foreach ($items as $it)
                @if ($it->id == $citem->gift_id)
                <div class="row">
                    <a class="seemlessLink col-2" style=" text-align:center; margin: -10px 5px 5px 5px; "
                        href="{{ route('removeItem', $it->id) }}">
                        <div class="mainMeniuBTN btn"
                            style="background-color: rgb(187, 35, 14); float: left; font-weight: bold; width: 30px; height: 30px; margin: 10px 0 0 10px">
                            -</div>
                    </a>
                    <div class="col-8">
                        <p>{{ $it->name }} {{ $citem->gift_item_count }};</p>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
            </div>
            <button type="submit" class="btn editButton">Save</button>
        </form>
    </div>
</div>
@endsection
