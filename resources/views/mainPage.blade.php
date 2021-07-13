@extends('layouts.app')
@section('content')
@if($user->role == 1)
<h5 style="margin: 20px 0 20px 20px">Campaigns you're participating:</h5>
<pcamapign-list-hr></pcamapign-list-hr>
<h5 style="margin: 20px 0 20px 20px">Active campaigns</h5>
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
<div class="card" style="position: relative; max-width: 325px; min-height: 280px;">
    <div class="card-title" style="text-align: center">
        <p> {{ $cam->campaign_name }} </p>
    </div>
    <div class="card-body">
        <form action="/subscribe" method="POST">
            @csrf
            <input name="_token" type="hidden" />
            <input name="campaign_id" type="hidden" />
            <button class="subscribeButton" type="submit">Subscribe</button>
        </form>
        <form action="/information" method="POST">
            @csrf
            <input name="_token" type="hidden" />
            <input name="campaign_id" type="hidden" />
            <button class="informationButton" type="submit">Information</button>
        </form>
    </div>
</div>
@endif
@endforeach
<h5 style="margin: 20px 0 20px 20px">Inactive Campaigns</h5>

@else
<h5 style="margin: 20px 0 20px 20px">Campaigns you're participating:</h5>
<pcamapign-list></pcamapign-list>
<h5 style="margin: 20px 0 20px 20px">Active campaigns</h5>

<h5 style="margin: 20px 0 20px 20px">Inactive Campaigns</h5>

@endif
@endsection
