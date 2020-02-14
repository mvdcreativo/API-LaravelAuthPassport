<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Category::with('categories')->where('category_id', null)->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $name = $request->name;
        $slug = str_slug($name);
        $validateCategory = Category::where('slug', $slug)->get();


        if(count($validateCategory)>=1){
            return response()->json(["message" => "La categoría ".$name." ya existe!!!"], 400);
        }else{

            $category = new Category;
            $category->name = $name;
            $category->slug = $slug;
            $category->save();

            return response()->json($category, 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        return Category::with('products')->find($id);   
     }



     ////CATEGORY BY SLUG

     public function bySlug($slug){
         $category = Category::with('products')->where('slug', $slug)->first();

         return response()->json($category, 200);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $name = $request->name;
        $slug = str_slug($name);
        $validateCategory = Category::where('slug', $slug)->where('id', '!=', $id)->get();


        if(count($validateCategory)>=1){
            return response()->json(["message" => "La categoría ".$name." ya existe!!!"], 400);
        }else{

            $category = Category::find($id);
            $category->name = $name;
            $category->slug = $slug;
            $category->save();

            return response()->json($category, 200);
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json($category, 200);    
    }
}
