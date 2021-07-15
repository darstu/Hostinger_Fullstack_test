@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h4>Give feedback: {{$campaign->campaign_name }}</h4>
    </div>

    <form method="POST" action="{{route('rateSave', $campaign->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div style="margin-top: 10px" class="row">
                <h4>Rating<span style="color: red">*</span></h4>
            </div>
            <div class="row rating">
                <label>
                    <input type="radio" name="stars" value="1" />
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </div>
            <div class="row ">
                <h4>Feedback<span style="color: red">*</span></h4>
            </div>
            <div class="row col-sm-6">
                <textarea onclick="handler(event)" rows="5" placeholder="" name="Feedback"
                    class="form-control">{{old('Feedback')}}</textarea>
            </div>
            <div>
                <button class="allButton" style="margin-top: 10px" onclick="handler(event)" type="submit">Save
                    feedback</button>
            </div>
        </div>
    </form>
</div>
@endsection
<style>
    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked~.icon,
    .rating:hover label:hover input~.icon {
        color: rgb(153, 0, 255);
    }

    .rating label input:focus:not(:checked)~.icon:last-child {
        color: #000;
        text-shadow: 0 0 5px rgb(153, 0, 255);
    }

</style>
