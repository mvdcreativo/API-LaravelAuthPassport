<?php

use Illuminate\Database\Seeder;

class Products_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json= File::get('database/data/products.json');
        $data= json_decode($json);

        
        foreach ($data as $campo) {

        $marca = App\Brand::find($campo->marca);
        if($marca){
            $brand = $campo->marca;
        }else{
            $brand = null;
        };

        $name = $campo->name_article;
        $product = new App\Product([
            
                'id' => $campo->id,
                'name'=> $name,
                'slug'=> str_slug($name),
                'name_concat'=> $name,
                'brand_id'=> $brand,
                'category_id' => $campo->category,
                'description' => $campo->description,
                'picture' => $campo->image,
                'price' => intval($campo->price),
                'stock' => 100,
                                
            ]);
            $product->save();

            
           }
    }
}
