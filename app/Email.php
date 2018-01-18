<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['people_id','email','main'];
    protected $table ='email';
    protected $primaryKey ='id';

    public function client()
    {
        return $this->belongsTo('App\Client','people_id','people_id');
    }
}
