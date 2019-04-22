@extends('layouts.app')

@section('title', 'Categories...')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit category</div>
                <div class="card-body">
                    <form action="" method="post" class="category-edit">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="col-sm-12 form-group form-group-input">
                            <i class="fa fa-folder-open"></i>
                            <label for="name" class="control-label">Name</label>
                            <input value="{{$category->name}}" type="text" class="input form-control" id="name" name="name" placeholder="category name" required >
                        </div>
                        <div class="col-sm-12 form-group form-group-input">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="history.back()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

