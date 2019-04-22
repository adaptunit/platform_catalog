@extends('layouts.app')

@section('content')
@if($platforms)
<div class="container front">
    <div class="card-deck">

    @foreach($platforms as $platform)
        <a href="{{$platform->link}}" class="custom-card" target="_blank" rel="nofollow">
            <div class="card mb-2">
                <div class="badge-heart round round-sm yellow">
                    <i class="fa fa-heart"></i>
                </div>
                @if(!empty($platform->logo))
                    <img class="card-img-top img-fluid" src="{{$platform->logo}}" alt="{{$platform->name}}">
                @else
                    <img class="card-img-top img-fluid" src="/img/500x300.png" alt="{{$platform->name}}">
                @endif
                <div class="card-body">
                    <h4 class="card-title">{{$platform->name}}</h4>
                    <p class="card-text">{{$platform->description}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                        {{$platform->updated_at}}
                    </small>
                </div>
                @if (!empty($platform->is_discount_enable) && $platform->is_discount_enable)
                    <div class="badge-percent round round-sm orange">
                        <i class="fa fa-percent"></i>
                    </div>
                @endif
            </div>
        </a>
    @endforeach

    </div>
</div>
@endif

@endsection
