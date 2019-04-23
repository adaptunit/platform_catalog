@extends('layouts.app')

@section('content')

<div class="container front">
    @if($categories)
        <div class="categories">
            <a href="{{ route('home') }}" class="category" >
                <button type="button" class="btn btn-xs btn-outline-primary btn-rounded">
                    all
                </button>
            </a>

            @foreach($categories as $category)
                <a href="{{ route('category.platform', [$category->id], false) }}" class="category" >
                    <button type="button" class="btn btn-xs btn-outline-primary btn-rounded">
                        {{$category->name}}
                    </button>
                </a>
            @endforeach
        </div>
    @endif
    <div class="card-deck">

            @forelse($platforms as $platform)

                    <div class="card mb-2">

                        <div class="badge-heart round round-sm yellow">
                            <a href="#" class="vote insetshadow" onClick="return false">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>

                        @if (!empty($platform->is_discount_enable) && $platform->is_discount_enable)
                            <div class="badge-percent round round-sm orange">
                                <i class="fa fa-percent"></i>
                            </div>
                        @endif

                        <a href="{{$platform->link}}" class="custom-card" target="_blank" rel="nofollow">
                            @if(!empty($platform->logo))
                                <img class="card-img-top img-fluid" src="{{$platform->logo}}" alt="{{$platform->name}}">
                            @else
                                <img class="card-img-top img-fluid" src="/img/500x300.png" alt="{{$platform->name}}">
                            @endif
                        </a>
                        <div class="card-body card-clickable" link="{{$platform->link}}">
                            <h4 class="card-title">{{$platform->name}}</h4>
                            <p class="card-text">{{$platform->description}}</p>
                        </div>
                        <div class="card-footer card-clickable" link="{{$platform->link}}">
                            <small class="text-muted">
                                {{$platform->updated_at}}
                            </small>
                        </div>
                    </div>
            @empty
                <div class="card empty mb-2">
                    &nbsp;
                </div>
            @endforelse


    </div>
</div>

<script>
    var cardClickable = document.getElementsByClassName('card-clickable');
    if (cardClickable) {
        for (i = 0; i < cardClickable.length; i++) {
            cardClickable[i].onclick = function(e) {
                var attrLink = this.getAttribute('link');
                // console.log('e:|', e, '| attrLink:|', attrLink, '|', (typeof attrLink !== 'undefined') );
                if (typeof attrLink !== 'undefined') {
                    window.open(attrLink, '_blank');
                }
            }
        }
    }
</script>
@endsection
