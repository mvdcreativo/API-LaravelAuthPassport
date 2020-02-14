<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id', 
        'name',
        'slug',
        'price',
        'name_concat',
        'price_mayorista',
        'discount',
        'picture',
        'description',
        'stock',
        'picture',
        'state'
    ];



    //relations


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }



    ///SCOPES///

    public function scopeSearcher($query, $searcher){
        if($searcher)
        
            return $query->where('name', 'LIKE', "%$searcher%")
                ->orWhere('description', 'LIKE', "%$searcher%");

    }


}
