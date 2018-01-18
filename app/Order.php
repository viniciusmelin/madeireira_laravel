<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="order";
    protected $primaryKey ='id';
    protected $fillable = ['client_id','operation_id','situation_id','salesman_id','observation','amount'];

    public function order_item()
    {
        return $this->hasMany('App\Order_item','order_id','id');
    }

    public function client()
    {
        return $this->hasMany('App\Client','people_id','client_id');
    }

    public function salesman()
    {
        return $this->hasMany('App\Salesman','people_id','salesman_id');
    }

    public function situation()
    {
        return $this->belongsTo('App\Situation','situation_id','id');
    }
}
