@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Post {{$post->title}}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route("posts.update", $post->id)}}" method="POST">
                        @csrf
                        @method("PUT")

                        {{-- Post Title --}}
                        <div class="form-group">
                            <label for="title">Post title</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Insert title here" value="{{$post->title}}">
                        </div>
                        {{-- Post Title Error --}}
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Post Content --}}
                        <div class="form-group">
                            <label for="content">Post content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="10" placeholder="Insert text here">{{$post->content}}</textarea>
                        </div>
                        {{-- Post Content Error --}}
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Select Category --}}
                        <div class="form-group">
                            <label for="category_id">Categories</label>
                            <select class="custom-select mb-3 @error('content') is-invalid @enderror" name="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        {{-- Select Category Error --}}
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Checkbox --}}
                        <div class="form-group form-check">
                            @php
                                $published = old("published") ? old("published") : $post->published;
                            @endphp
                            <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" {{$published ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Publish</label>
                        </div>
                        {{-- Checkbox Error --}}
                        @error('published')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Edit Button --}}
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>

                    <div class="mt-3">
                        <a href="{{route("posts.index")}}">
                            <button type="button" class="btn btn-dark">Go back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection