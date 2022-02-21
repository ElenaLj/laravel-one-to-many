@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Post</h4>
                </div>

                <div class="card-body">
                    <form action="{{route("posts.store")}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Post Title --}}
                        <div class="form-group">
                            <label for="title">Post title</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Insert title here" value="{{old('title')}}">
                        </div>
                        {{-- Post Title Error --}}
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Post Content --}}
                        <div class="form-group">
                            <label for="content">Post content</label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="10" placeholder="Insert text here">{{old('content')}}</textarea>
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

                        {{-- Tags Section--}}
                        <div class="form-group">
                            <p>Choose tags</p>
                            
                            @foreach ($tags as $tag)
                            {{-- @dd($tags) --}}
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input @error('tags') is-invalid @enderror" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old("tags", [])) ? "checked" : ""}}>
                                <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                            </div>
                            @endforeach
                        </div>
                        {{-- Tags Error --}}
                        @error('tags')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Checkbox --}}
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" {{old('published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="published">Publish</label>
                        </div>
                        {{-- Checkbox Error --}}
                        @error('published')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Insert Image file --}}
                        <div class="form-group custom-file mb-3">
                            <input type="file" class="custom-file-input @error('title') is-invalid @enderror" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>

                        {{-- Image Error --}}
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-success">Submit</button>
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