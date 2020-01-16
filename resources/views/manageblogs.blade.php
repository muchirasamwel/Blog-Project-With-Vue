@extends('layouts.app')
@section('title')
    <title>Advanced Databases Blogs</title>
@endsection
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div>
        <addblog :logged_user="{{Illuminate\Support\Facades\Auth::user()}}" >
        </addblog>
    </div>
@endsection
