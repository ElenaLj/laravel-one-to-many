<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // dd($posts);
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check incoming datas
        //dd($request->all());

        //data validation
        $request->validate(
            [
            "title" => "required|string|max:150",
            "content" => "required",
            "published" => "sometimes|accepted",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|image|mimes:jpeg,bmp,png|max:2048"
            ]
        );

        $data = $request->all();

        //insert a new record in db table
        $newPost = new Post();
        $newPost->title = $data["title"];
        $newPost->content = $data["content"];

        // if (isset($data["published"]) ) {
        //     $newPost->published = true;
        // }
        $newPost->published = isset($data["published"]);
        $newPost->category_id=$data["category_id"];

        $slug = Str::of($newPost->title)->slug('-');
        $count = 1;

        while(Post::where("slug", $slug)->first() ) {
            $slug = Str::of($newPost->title)->slug('-') . "-{$count}";
            $count++;
        }
        $newPost->slug = $slug;

        // save image if present
        if(isset($data["image"])) {
            $path_image = Storage::put("uploads", $data["image"]);
            $newPost->image = $path_image;
        }

        $newPost->save();

        //redirect
        return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view("admin.posts.edit", compact("post", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //data validation
        $request->validate(
            [
            "title" => "required|string|max:150",
            "content" => "required",
            "published" => "sometimes|accepted",
            "category_id" => "nullable|exists:categories,id",
            ]
        );

        $data = $request->all();

        //update record
        if( $post->title != $data["title"]) {
            $post->title = $data["title"];
            //generate new slug
            $slug = Str::of($post->title)->slug('-');
            if($slug != $post->slug){
                $count = 1;
                
                while(Post::where("slug", $slug)->first() ) {
                    $slug = Str::of($post->title)->slug('-') . "-{$count}";
                    $count++;
                }
        
                $post->slug = $slug;
            }
        }

        $post->content = $data["content"];
        $post->category_id=$data["category_id"];

        // if (isset($data["published"]) ) {
        //     $post->published = true;
        // } else {
        //     $post->published = false;
        // }

        $post->published = isset($data["published"]);
        
        $post->save();

        //redirect
        return redirect()->route("posts.show", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route("posts.index");
    }
}
