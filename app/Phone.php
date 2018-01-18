<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Phone_type;

class Phone extends Model
{


    protected $fillable = ['number','main','phone_type_id','people_id'];
    protected $table = 'phone';
    protected $primaryKey = 'id';
    //protected $hidden =['id'];
    

    public function people()
    {
        return $this->hasMany('App\People','people_id','id');
    }
    public function phone_type()
    {
        return $this->belongsTo('App\Phone_type','phone_type_id','id');

    }
    // public function phoneTypeString()
    // {
    //     $desc = Phone_type::select('description')->where('id',$this->phone_type_id)->first();
        
    //     return $desc['description'];
    // }
}
