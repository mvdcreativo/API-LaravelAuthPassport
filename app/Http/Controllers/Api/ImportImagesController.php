<?php

namespace App\Http\Controllers\Api;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImportImagesController extends Controller
{
    public function import(){

        
        $url = "https://apiv2.jh.nuevaerauruguay.com/Upload/Article/a0GnPFyMXNbf.jpg";

// return $url;
            
            $img = $url;
            $product = Product::find(2);
            $path = Storage::disk('public')->put('images/productos',  $img);
            // $product->fill(['file' => asset($path)])->save();
            // return $path;
            $product->fill(['image' => $path])->save();
            
            return $product;
        
    }
}
