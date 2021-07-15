@extends('layouts.app')
@section('content')
<div class="center">
    <table class="table table-bordered mb-5">
        <thead style="background-color: #9653bd; color:white;">
            <tr>
                <th scope="col-8">{{ $campaign->campaign_name }} feedback</th>
                <th class="col-1" scope="col">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $feed)
            <tr>
                <td>{{ $feed->feedback }}</td>
                <td>{{ $feed->rating }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
