<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone_type extends Model
{
    protected $fillable = ['description'];
    protected $table ='phone_type';
    protected $primaryKey ='id';
    public function phone()
    {
        return $this->hasMany('App\Phone','phone_type_id','id');
    }

}
