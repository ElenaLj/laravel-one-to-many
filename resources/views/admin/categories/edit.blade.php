@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{route("categories.update", $category->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        {{-- New Select Category --}}
                        <div class="form-group">
                            <label for="name">Edit Category Name</label>
                            <input name="name" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Insert new category name here" value="{{old('name'), $category->name}}">
                        </div>
                        {{-- Select Category Error --}}
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                
                        {{-- Submit Button --}}
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