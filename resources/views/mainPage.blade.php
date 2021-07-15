@extends('layouts.app')
@section('content')
@if($user->role == 1)
<div>
    <a href="{{route('items')}}" class="btn btn-primary allButton">All items</a>
    <a href="{{route('campaigns')}}" class="btn btn-primary allButton">All campaigns</a>
</div>
<h5 style="margin: 20px 0 20px 20px">Campaigns you're participating in:</h5>
<div class="row">
    @foreach ($pCampaigns as $pcam)
    @foreach ($usersC as $uc)
    @if($pcam->id == $uc->campaign_id)
    <div class="card" style="position: relative; max-width: 300px; min-height: 250px; margin-left: 20px">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">{{ $pcam->campaign_name }}</h5>
            <p class="card-text status">Status: {{ $pcam->status }}</p>
            <p class="card-text status">Dispatch date: {{ $pcam->dispatch_date }}</p>
            <p class="card-text status">Approx. delivery date: {{ $pcam->delivery_date }}</p>
            @if ($pcam->delivery_date <= $todayDate) <p class="card-text" style="font-weight: bold">Items (quantity in
                gift box):
                <div class="row" style="margin-left: 0">
                    @foreach ($citems as $citem)
                    @foreach ($items as $item)
                    @if($citem->campaign_id == $pcam->id && $item->id == $citem->gift_id)
                    {{ $item->name }} {{ $citem->gift_item_count }};
                    @endif
                    @endforeach
                    @endforeach
                </div>
                </p>
                @endif
                <div class="row">
                    @if ($pcam->dispatch_date > $todayDate) <a href="{{route('unsubscribe', $pcam->id)}}"
                        class="btn btn-primary unsubscribeButton">Unsubscribe</a>
                    @endif
                    <?php $rate=0; ?>
                    @foreach ($ratings as $rating)
                    @if($rating->campaign_id == $pcam->id)
                    <?php $rate = $rate + 1; ?>
                    @endif
                    @endforeach
                    @if ($pcam->delivery_date <= $todayDate && $pcam->status != 'completed' && $rate == 0)
                        <a href="{{route('rate', $pcam->id)}}" class="btn btn-primary subscribeButton">Rate</a>
                        @endif
                        <a href="{{route('information', $pcam->id)}}"
                            class="btn btn-primary informationButton">Information</a>
                </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
</div>
<h5 style="margin: 20px 0 20px 20px">Active campaigns:</h5>
@if ($aCp == 0)
<p>There is no active campaigns.</p>
@endif
<div class="row">
    @foreach ($aCampaigns as $cam)
    <?php
$c = 0;
?>
    @foreach ($usersC as $uc)
    @if($cam->id == $uc->campaign_id)
    <?php
    $c = $c + 1;
    ?>
    @endif
    @endforeach
    @if ($c == 0)
    <div class="card" style="position: relative; max-width: 300px; min-height: 200px; margin-left: 20px">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">{{ $cam->campaign_name }}</h5>
            <p class="card-text status">Status: {{ $cam->status }}</p>
            <p class="card-text status">Dispatch date: {{ $cam->dispatch_date }}</p>
            <p class="card-text status">Approx. delivery date: {{ $cam->delivery_date }}</p>
            <div class="row">
                @if($cam->dispatch_date > $todayDate)
                <a href="{{route('subscribe', $cam->id)}}" class="btn btn-primary subscribeButton">Subscribe</a>
                @endif
                <a href="{{route('information', $cam->id)}}" class="btn btn-primary informationButton">Information</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<h5 style="margin: 20px 0 20px 20px">Inactive Campaigns:</h5>
@if ($iCp == 0)
<p>There is no inactive campaigns.</p>
@endif
<div class="row">
    @foreach ($iCampaigns as $icam)
    @foreach ($usersC as $uc)
    <?php
    $c = 0;
    ?>
    @if($icam->id == $uc->campaign_id)
    <?php
    $c = $c + 1;
    ?>
    @endif
    @endforeach
    @if ($c == 0)
    <div class="card" style="position: relative; max-width: 300px; min-height: 250px; margin-left: 20px">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">{{ $icam->campaign_name }}</h5>
            {{-- maybe show rating instead of dates --}}
            <p class="card-text status">Status: {{ $icam->status }}</p>
            <p class="card-text status">Dispatch date: {{ $icam->dispatch_date }}</p>
            <p class="card-text status">Approx. delivery date: {{ $icam->delivery_date }}</p>
            <p class="card-text" style="font-weight: bold">Items (quantity in
                gift box):
                <div class="row" style="margin-left: 0;">
                    @foreach ($citems as $citem)
                    @foreach ($items as $item)
                    @if($citem->campaign_id == $icam->id && $item->id == $citem->gift_id)
                    {{ $item->name }} {{ $citem->gift_item_count }};
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </p>
            <div class="row">
                <a href="{{route('information', $icam->id)}}" class="btn btn-primary informationButton">Information</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@else
<h5 style="margin: 20px 0 20px 20px">Campaigns you're participating in:</h5>
<div class="row">
    @foreach ($pCampaigns as $pcam)
    @foreach ($usersC as $uc)
    @if($pcam->id == $uc->campaign_id)
    <div class="card" style="position: relative; max-width: 300px; min-height: 250px; margin-left: 20px">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">{{ $pcam->campaign_name }}</h5>
            <p class="card-text status">Status: {{ $pcam->status }}</p>
            <p class="card-text status">Dispatch date: {{ $pcam->dispatch_date }}</p>
            <p class="card-text status">Approx. delivery date: {{ $pcam->delivery_date }}</p>
            @if ($pcam->delivery_date <= $todayDate) <p class="card-text" style="font-weight: bold">Items (quantity in
                gift box):
                <div class="row" style="margin-left: 0">
                    @foreach ($citems as $citem)
                    @foreach ($items as $item)
                    @if($citem->campaign_id == $pcam->id && $item->id == $citem->gift_id)
                    {{ $item->name }} {{ $citem->gift_item_count }};
                    @endif
                    @endforeach
                    @endforeach
                </div>
                </p>
                @endif
                <div class="row">
                    @if ($pcam->dispatch_date > $todayDate) <a href="{{route('unsubscribe', $pcam->id)}}"
                        class="btn btn-primary unsubscribeButton">Unsubscribe</a>
                    @endif
                    <?php $rate=0; ?>
                    @foreach ($ratings as $rating)
                    @if($rating->campaign_id == $pcam->id)
                    <?php $rate = $rate + 1; ?>
                    @endif
                    @endforeach
                    @if ($pcam->delivery_date <= $todayDate && $pcam->status != 'completed' && $rate == 0)
                        <a href="{{route('rate', $pcam->id)}}" class="btn btn-primary subscribeButton">Rate</a>
                        <a href="{{route('information', $pcam->id)}}"
                            class="btn btn-primary informationButton">Information</a>
                        @endif
                </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
</div>
<h5 style="margin: 20px 0 20px 20px">Active campaigns:</h5>
@if ($aCp == 0)
<p>There is no active campaigns.</p>
@endif
<div class="row">
    @foreach ($aCampaigns as $cam)
    <?php
        $c = 0;
    ?>
    @foreach ($usersC as $uc)
    @if($cam->id == $uc->campaign_id)
    <?php
    $c = $c + 1;
    ?>
    @endif
    @endforeach
    @if ($c == 0)
    <div class="card" style="position: relative; max-width: 300px; min-height: 200px; margin-left: 20px">
        <div class="card-body">
            <h5 class="card-title" style="text-align: center">{{ $cam->campaign_name }}</h5>
            <p class="card-text status">Status: {{ $cam->status }}</p>
            <p class="card-text status">Dispatch date: {{ $cam->dispatch_date }}</p>
            <p class="card-text status">Approx. delivery date: {{ $cam->delivery_date }}</p>
            <div class="row">
                @if($cam->dispatch_date > $todayDate)
                <a href="{{route('subscribe', $cam->id)}}" class="btn btn-primary subscribeButton">Subscribe</a>
                @endif
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endif
@endsection
