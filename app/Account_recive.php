<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_recive extends Model
{
    protected $table ="account_recive";
    protected $primaryKey ="id";
    protected $fillable = ['id','birth_pay','amount','date_lan','date_ven','limitmax','account_status_id','client_id','salesman_id','order_id','type_payment_id','account_source_id','amount_pay'];
}
