@extends('layouts.app')

@section('title', 'Add new platform...')

@section('content')
    @include('admin.platform._form', ['subClass' => 'standalone'])
@endsection

