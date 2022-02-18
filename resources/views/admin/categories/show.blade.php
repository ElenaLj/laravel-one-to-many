@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{$category->name}}</h4>
                </div>

                <div class="card-body">
                    <p>Slug: {{$category->slug}}</p>
                    <a href="{{route("categories.index")}}" class="mt-2">
                        <button type="button" class="btn btn-dark">Go back</button>
                    </a>
                </div>
                @if (count($category->posts) > 0)
                <div class="card-body">
                    <h3>Category linked posts</h3>
                    <ul>
                        {{-- @dd($category->posts); --}}
                        @foreach ($category->posts as $post)
                            <li>{{$post->title}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection