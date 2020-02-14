<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json= File::get('database/data/categories.json');
        $data= json_decode($json);

        foreach ($data as $campo) {
            if($campo->category_id === null){
                $name = $campo->name;
                $category = new App\Category([
                    'id' => $campo->id,
                    'name'=> $name,
                    'slug'=> str_slug($name),
                    'category_id' => $campo->category_id
                ]);
                $category->save();
            }
            // $category->vehicle_categories()->sync(1);
        }
    }
}
