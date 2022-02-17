@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category {{$category->name}}</h4>
                </div>

                <div class="card-body">
                    <form action="{{route("categories.update", $category->id)}}" method="POST">
                        @csrf
                        @method("PUT")


                        {{-- Edit Select Category --}}
                        <div class="form-group">
                            <label for="category_id">Categories</label>
                            <select class="custom-select mb-3 @error('content') is-invalid @enderror" name="category_id">
                            <option value="">Change the category</option>
                            {{-- @foreach ($category->id)
                                <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach --}}
                                @php
                                    $cat = old("category_id") ? old("category_id") : $category->id;
                                @endphp

                            @foreach ($categories as $category)
                                <option value="{{$cat}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        {{-- Select Category Error --}}
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        {{-- Edit Button --}}
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>

                    <div class="mt-3">
                        <a href="{{route("categories.index")}}">
                            <button type="button" class="btn btn-dark">Go back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection