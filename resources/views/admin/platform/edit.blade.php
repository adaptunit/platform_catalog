@extends('layouts.app')

@section('title', 'Edit exist platform...')

@section('content')
    @include('admin.platform._form', ['subClass' => 'standalone'])
@endsection

