@extends('layouts.app')
@section('content')
<div class="mainMeniuBTN btn" style="background-color: rgb(187, 35, 14)">
    <a class="seemlessLink" href="{{ route('deleteItem', $item->id) }}">Delete item</a>
</div>
<h5 style="margin:auto; width:50%; text-align: center">Item "{{ $item->name }}" information:</h5>
<div class="container">
    <div class="card col-6" style="margin: auto; margin-top: 15px">
        <form role="form" method="POST" action="{{ route('confirmEditItem', ['index' => $item->id]) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="name" class="col-7">Item name: </label>
                <input type="text"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="name" required name="name" value="{{$item->name}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="units_owned" class="col-7">Add units: (Units owned now:
                    {{ $item->units_owned }})</label>

                <input type="number"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); height: 60px; border-radius: 20px"
                    class="col-4" id="units_owned" name="units_owned" value="{{old('units_owned')}}">
            </div>
            <div class="row" style="margin: 10px 0 5px 0">
                <label style="font-weight: bold" for="unit_price" class="col-7">One unit price:</label>
                <input type="text"
                    style="background-color: rgb(206, 205, 205); border: solid 1px rgb(182, 181, 181); border-radius: 20px"
                    class="col-4" id="unit_price" name="unit_price" value="{{$item->unit_price}}">
            </div>
            <button type="submit" class="btn editButton">Save</button>
        </form>
    </div>
</div>
@endsection
