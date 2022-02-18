<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            "name" => "required|string|max:255|unique:categories,name" // unique needs a parameter: insert table and eventually the column
        ]);

        //save datas
        $data = $request->all();

        //create the category
        $newCategory = new Category();
        $newCategory->name = $data["name"];
        $newCategory->slug = Str::of($newCategory->name)->slug('-');
        $newCategory->save();

        //redirect to created category
        return redirect()->route("categories.show", $newCategory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // $categories = Category::all();
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validation
        $request->validate([
            "name" => "required|string|max:255|unique:categories,name, {$category->id}" // unique needs a parameter: insert table and eventually the column
        ]);

        //save datas
        $data = $request->all();

        //create the category
        $category->name = $data["name"];
        $category->slug = Str::of($category->name)->slug('-');
        $category->save();

        //redirect to created category
        return redirect()->route("categories.show", $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("categories.index");
    }
}
