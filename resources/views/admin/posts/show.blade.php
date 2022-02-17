@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{$post->title}}</h4>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        @if ($post->published)
                            <span class="badge badge-success">Status: Published</span>
                        @else
                            <span class="badge badge-warning">Status: Draft</span>
                        @endif 
                    </div>
                    <p>{{$post->content}}</p>
                    <a href="{{route("posts.index")}}" class="mt-2">
                        <button type="button" class="btn btn-dark">Go back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection