<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [ 'user_id', 'total', 'set_state', 'name' , 'lastname' , 'company','address','city','state','mail', 'phone' ];




    public function productos()
    {
        return $this->belongsToMany('App\Producto');
    }
}
