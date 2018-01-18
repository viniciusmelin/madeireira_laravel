<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use Telefone;
Use Address;
Use Phone_type;

class Client extends Model
{

    public $timestamps = false;
    protected $table = 'client';
    protected $primaryKey = 'people_id';
    protected $fillable = ['people_id','birth_register','birth_date','limitmin','limitmax'];


    public function address()
    {
        return $this->hasMany('App\Address','people_id','people_id');
    }

    public function email()
    {
        return $this->hasMany('App\Email','people_id','people_id');
    }

    public function phone()
    {
        return $this->hasMany('App\Phone','people_id','people_id');
    }

    public function people()
    {
        return $this->hasOne('App\People','id','people_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order','people_id','people_id');
    }

 //Adicionar Phone e Remover
    public function addPhone(Telefone $telefone)
    {
        return $this->phone()->save($telefone);
    }

    public function remPhone($codigo)
    {
        foreach($this->phone as $ph)
        {
            
        }
    }

//

    public function addAddress(Address $address)
    {
        return $this->address()->save($address);
    }

}
