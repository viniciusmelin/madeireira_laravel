<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{

    protected $table = "order_item";
    protected $primaryKey = "id";
    protected $fillable = ['order_id','product_id','amount','price'];

    public function order()
    {
        return $this->belongsTo('App\Order','order_id','order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

}