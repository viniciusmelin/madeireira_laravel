<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'people';

    protected $fillable = ['name','cpfcnpj','active','user_id'];


    public function client()
    {
        return $this->hasOne('App\Client', 'people_id', 'id');
    }

    public function salesman()
    {
        return $this->hasOne('App\Salesman', 'people_id', 'id');
    }
}
