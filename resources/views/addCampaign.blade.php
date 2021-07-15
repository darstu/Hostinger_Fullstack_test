@extends('layouts.app')
@section('content')

<h5 style="margin:auto; width:50%; text-align: center">Add Campaign:</h5>
<div class="container">
    <div class="card col-6" style="margin: auto; margin-top: 15px">
        <form role="form" method="POST" action="{{ route('addCampaign') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="campaign_name" class="col-7">Campaign name: </label>
                <input type="text"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="campaign_name" required name="campaign_name" value="{{old('campaign_name')}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="status" class="col-7">Status:</label>
                <select class="col-4"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    id="status" required name="status" value="{{old('status')}}">
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
                    class="col-4" id="dispatch_date" name="dispatch_date" required value="{{old('dispatch_date')}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="delivery_date" class="col-7">Delivery date:</label>
                <input type="date"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="delivery_date" name="delivery_date" required value="{{old('delivery_date')}}">
            </div>
            <button type="submit" class="btn editButton">Add</button>
        </form>
    </div>
</div>
@endsection
