<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $table='situation';
    protected $primaryKey ='id';
    protected $fillable = ['id','description'];

    public function order()
    {
        return $this->hasMany('App\Order','situation_id','id');
    }
}
