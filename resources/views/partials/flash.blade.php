@if(session()->has('alert'))
<div class="alert alert-{{session('alert')}}">
    <button type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">&times;</button>
    <em> {!! session('message') !!}</em>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-{{session('alert')}}">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}
                    <button type="button" class="close pull-right" data-dismiss="alert" aria-hidden="true">&times;</button>
                </li>
            @endforeach
        </ul>
    </div>
@endif
