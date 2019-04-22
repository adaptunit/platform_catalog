@extends('layouts.app')

@section('title', 'Platform...')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            @include('partials.flash')
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Platforms</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row" >
                            <div class="col">
                                <a href="" class="btn btn-info btn-sm btn-rounded mb-4 float-right" data-toggle="modal" data-target="#modalAddPlatform">
                                    Add Platform
                                </a>
                            </div>
                        </div>

                        <div class="" >
                            <div class="platform-table">
                                <div class="platform-thead tall">
                                    <div class="row">
                                        <div class="col id">
                                            <div>&nbsp;</div>
                                            <div class="large">id</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        <div class="col name">
                                            <div>&nbsp;</div>
                                            <div class="large">name</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        <div class="col rate">
                                            <div>&nbsp;</div>
                                            <div class="large">rate</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        <div class="col discount">
                                            <div>&nbsp;</div>
                                            <div class="large">discount</div>
                                            <div>&nbsp;</div>
                                        </div>
                                        <div class="col actions">
                                            <div>&nbsp;</div>
                                            <div class="large">actions</div>
                                            <div>&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="platform-tbody scroll">

                                        @if($platforms)
                                        @foreach($platforms as $platform)
                                            <div class="row">
                                                <div class="col id">{{$platform->id}}</div>
                                                <div class="col name">{{$platform->name}}</div>
                                                <div class="col rate">{{$platform->rate}}</div>
                                                <div class="col discount">
                                                    @if(!empty($platform->is_discount_enable) &&
                                                        $platform->is_discount_enable)
                                                        {!! '<i class="fa fa-check-square true"></i>' !!}
                                                    @else
                                                        {!! '<i class="fa fa-minus-square false"></i>' !!}
                                                    @endif
                                                </div>
                                                <div class="col actions col-actions float-right">
                                                    <div class="pull-right">
                                                        <a href="/platform/{{$platform->id}}" class="btn btn-sm btn-outline-success">
                                                            edit
                                                        </a>
                                                        <a href="/platform/delete/{{$platform->id}}" class="btn btn-sm btn-outline-danger">
                                                            delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</div>



<div class="modal fade" id="modalAddPlatform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add new platform</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('admin.platform._form', ['subClass' => 'modal'])
        </div>
    </div>
</div>

@endsection

