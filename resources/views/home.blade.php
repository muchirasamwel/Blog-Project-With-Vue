@extends('layouts.app')
@section('title')
    <title>Advanced Databases</title>
@endsection
@section('content')
    <div>
        <h1 class="text-center">All Blogs</h1>

        <div class="container">
            <div class="d-flex justify-content-around">
                <form method="POST" action="/search" class="row" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @method('post')
                    <div class="row ">
                        <label class="btn">Title</label>
                        <input type="text" name="title" class="form-control col">
                        <button type="submit" class="btn small btn-outline-success col mx-1">Search</button>
                    </div>
                </form>
            </div>
            <Blog>

            </Blog>
            @if($blogs)
                @foreach($blogs as $blog)

                @endforeach
            @endif
        </div>
    </div>
@endsection
