@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Category</h4>
                </div>

                <div class="card-body">
                    <form action="{{route("categories.store")}}" method="POST">
                        @csrf
                        
                        {{-- New Select Category --}}
                        <div class="form-group">
                            <label for="category_id">Categories</label>
                            <input type="text">
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