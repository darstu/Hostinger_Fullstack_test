@extends('layouts.app')
@section('content')
@if($user->role == 1)
<a class="btn btn-secondary pdfButton" href="{{ route('PDF', ['index' => $campaign->id]) }}">Export to
    PDF</a>
@endif
<div class="center">
    <table class="table table-bordered mb-5">
        <thead style="background-color: #9653bd; color:white;">
            <tr>
                <th class="col-1" scope="col">Name</th>
                <th class="col-2" scope="col">Items with quantitys</th>
                <th class="col-1" scope="col">Status</th>
                <th class="col-1" scope="col">Dispatch date</th>
                <th class="col-2" scope="col">Approximate delivery date (+week from dispath)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $campaign->campaign_name }}</td>
                <td>
                    @foreach ($items as $item)
                    @foreach ($campaign_items as $citem)
                    @if ($citem->gift_id == $item->id)
                    {{ $item->name }} {{ $citem->gift_item_count }};
                    @endif
                    @endforeach
                    @endforeach
                </td>
                <td>{{ $campaign->status }}</td>
                <td>{{ $campaign->dispatch_date }}</td>
                <td>{{ $campaign->delivery_date }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="participantsTable col-3">
        <table class="table table-bordered">
            <thead class="tableHead">
                <tr>
                    <td scope="col" class="col-1">No.</td>
                    <td scope="col" class="col-md">Participants:</td>
                </tr>
                <?php
                $c = 0; ?>
            </thead>
            <tbody>
                @foreach ($campaign_users as $cuser)
                @foreach ($users as $user)
                @if ($cuser->user_id == $user->id)
                <?php $c = $c + 1; ?>
                <div class="participantsLine">
                    <tr>
                        <td>{{ $c }}</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                </div>
                @endif
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @if($user->role == 1)
    <div class="itemsTable col-4" style="float: right">
        <table class="table table-bordered">
            <thead class="tableHead">
                <tr>
                    <td scope="col">Item cost per box:</td>
                    <td scope="col">Item cost for campaign:</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                @foreach ($campaign_items as $citem)
                @if ($citem->gift_id == $item->id)
                <tr>
                    <?php
                    $price = $item->unit_price * $citem->gift_item_count;
                    $cprice = $price * $c;
                    ?>
                    <td>
                        {{ $item->name }}: {{ $price }} eur
                    </td>
                    <td>
                        {{ $cprice }} eur
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="itemsTable col-4" style="float: right">
        <h5>Campaign rating: {{ $rating }}</h5>
        <a class="btn btn-secondary pdfButton"
            href="{{ route('lookFeedback', ['index' => $campaign->id]) }}">Feedback</a>
    </div>
    @endif
</div>

@endsection
