<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;
    protected $fillable = [
        'title'
    ];
    protected $hidden = [
        'id'
    ];
    protected $primaryKey= 'id';
    function services(){
        return $this->hasMany('app\models\Service');
    }

}