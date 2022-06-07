<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = 'adresses';
    protected $fillable = ['id', 'city', 'region','quartier'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('app\models\User', 'user_id');
    }
}
