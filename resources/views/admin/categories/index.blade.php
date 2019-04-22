@extends('layouts.app')

@section('title', 'Categories...')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            @include('partials.flash')
        </div>

        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Categories</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row" >
                                <div class="col">
                                    <a href="" class="btn btn-info btn-sm btn-rounded mb-4 float-right" data-toggle="modal" data-target="#modalAddCategory">
                                        Add Category
                                    </a>
                                </div>
                            </div>

                            <div class="row" >
                                <table class="table table-striped category">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>name</th>
                                            <th class="col-actions float-right">
                                                actions
                                            </th>
                                        </tr>
                                    </thead>
                                    @if($categories)
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td class="col-actions float-right">
                                                    <div class="pull-right">
                                                        <a href="/category/{{$category->id}}" class="btn btn-sm btn-outline-success">
                                                            edit
                                                        </a>
                                                        <a href="/category/delete/{{$category->id}}" class="btn btn-sm btn-outline-danger">
                                                            delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Add new category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('admin.categories._form', ['subClass' => 'modal'])
        </div>
    </div>
</div>


@endsection

