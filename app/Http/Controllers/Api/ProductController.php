<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('category','brand')->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('picture');
        $this->validate($request, [
            'name' => ['required'],
            'price' => ['required'],
            'name_concat' => ['required'],
            'stock' => ['required'],
        ]);

        $name = $request->name;
        $slug = str_slug($name);


        $validateProduct = Product::where('slug', $slug)->get();

                if(count($validateProduct)>=1){
                    return response()->json(["message" => "Producto ".$name." ya existe!!!"], 400);
                }else{
                    
            $product = new Product;
            $product->name = $name;
            $product->slug = $slug;
            $product->name_concat = $request->name_concat;
            $product->price = $request->price;
            $product->price_mayorista = $request->price_mayorista;
            $product->discount = $request->discount;
            $product->stock = $request->stock;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->save();

            if($request->file('picture')){
                $img = $request->file('picture');

                $path = Storage::disk('public')->put('images/productos',  $img);
                // $product->fill(['file' => asset($path)])->save();
                // return $path;
                $product->fill(['picture' => $path])->save();
                
                // return $product;
            }

            return response()->json($product, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        return Product::find($id);
    }

    public function bySlug($slug)
    {
        

        return Product::where('slug', $slug)->first();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
       // return $request->file('picture');
       $this->validate($request, [
        'name' => ['required'],
        'price' => ['required'],
        'name_concat' => ['required'],
        'stock' => ['required'],
    ]);

    $name = $request->name;
    $slug = str_slug($name);


    $validateProduct = Product::where('slug', $slug)->where('id', '!=', $id)->get();

            if(count($validateProduct)>=1){
                return response()->json(["message" => "Producto ".$name." ya existe!!!"], 400);
            }else{
                
        $product = Product::find($id);
        $product->name = $name;
        $product->slug = $slug;
        $product->name_concat = $request->name_concat;
        $product->price = $request->price;
        $product->price_mayorista = $request->price_mayorista;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->save();

        if($request->file('picture')){
            $img = $request->file('picture');

            $path = Storage::disk('public')->put('images/productos',  $img);
            // $product->fill(['file' => asset($path)])->save();
            // return $path;
            $product->fill(['picture' => $path])->save();
            
            // return $product;
        }

        return response()->json($product, 200);
    }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json($product, 200);
    }
}
