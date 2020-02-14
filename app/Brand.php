<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image_url','state'
    ];



    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
