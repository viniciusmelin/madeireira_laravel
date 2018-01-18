<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable =['people_id','ie','date_register'];


    public function people()
    {
        return $this->hasOne('App\People','people_id','people_id');
    }
}
