@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Posts</div>

                <div class="card-body">
                    {{-- <ul>
                        @foreach ($posts as $post)
                            <li class="d-flex justify-content-between mb-3">
                                {{$post->title}}
                                <a href="{{route("posts.show", $post->id)}}">
                                    <button type="button" class="btn btn-light">Show</button>
                                </a>
                            </li>
                               
                        @endforeach
                    </ul> --}}
                    <div class="mb-3">
                        <a href="{{route("posts.create")}}">
                            <button type="button" class="btn btn-dark">Add Post</button>
                        </a>
                    </div>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->slug}}</td>
                                <td>
                                    @if ($post->published)
                                        <span class="badge badge-success w-100">Published</span>
                                    @else
                                        <span class="badge badge-warning w-100">Draft</span>
                                    @endif 
                                </td>
                                {{-- OPEN RECORD --}}
                                <td>
                                    <a href="{{route("posts.show", $post->id)}}">
                                        <button type="button" class="btn btn-light">Show</button>
                                    </a>
                                </td>
                                {{-- EDIT RECORD --}}
                                <td>
                                    <a href="{{route("posts.edit", $post->id)}}">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                </td>
                                {{-- DELETE RECORD --}}
                                <td>
                                    <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection