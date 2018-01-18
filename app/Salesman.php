<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    protected $table = 'salesman';

    protected $primaryKey = 'people_id';
    protected $hidden =['people_id'];
    protected $fillable = ['people_id','date_register'];

    public function people()
    {
        return $this->hasOne('App\People','id','people_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Order','people_id','people_id');
    }
    
}
