<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','description','active','width','height','deep','amount_min','cubing','amount','price','price_sale'];
    protected $table ='product';
    protected $primaryKey ="id";


    public function order_item()
    {
        return $this->hasMany('App\Product','product_id','id');
    }
}
