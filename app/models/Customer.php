<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id','phone','adress','img'];
    public $timestamps=false;
    function user()
    {
        return $this->belongsTo('App\User');
    }

}