<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    protected $fillable = ['people_id','street','number','complement','neighborhood','zip_code','city'];

    public function client()
    {
        return $this->belongsTo('App\Client','people_id','people_id');
    }
}
