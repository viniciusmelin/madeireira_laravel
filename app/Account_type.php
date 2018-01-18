<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account_type extends Model
{
    protected $table = 'account_type';
    protected $primaryKey ='id';
    protected $fillable =['description,type'];
}
