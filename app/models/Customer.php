<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id','phone','img'];
    protected $primaryKey= 'user_id';
    public $timestamps=false;
    function user()
    {
        return $this->belongsTo('app\models\User');
    }

}