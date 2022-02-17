@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Categories</div>

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
                        <a href="{{route("categories.create")}}">
                            <button type="button" class="btn btn-dark">Add Category</button>
                        </a>
                    </div>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Actions</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>

                                {{-- OPEN RECORD --}}
                                <td>
                                    <a href="{{route("categories.show", $category->id)}}">
                                        <button type="button" class="btn btn-light">Show category</button>
                                    </a>
                                </td>
                                {{-- EDIT RECORD --}}
                                <td>
                                    <a href="{{route("categories.edit", $category->id)}}">
                                        <button type="button" class="btn btn-warning">Edit category</button>
                                    </a>
                                </td>
                                {{-- DELETE RECORD --}}
                                <td>
                                    <form action="{{route("categories.destroy", $category->id)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete category</button>
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