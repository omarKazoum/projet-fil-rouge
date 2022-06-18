<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Coiffeur extends Model
{
    public $timestamps=false;
    protected $fillable = [
        'city',
        'quartier',
        'phone',
        'store_title',
        'img',
        'working_hours',
        'working_days'
    ];
    protected $hidden = [
        'user_id'
    ];
    protected $primaryKey= 'user_id';
    function user()
    {
        return $this->belongsTo("app\models\User");
    }
    function services(){
        return $this->hasMany("app\models\Service");
    }
}