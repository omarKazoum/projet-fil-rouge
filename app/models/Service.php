<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps=false;
    protected $fillable = [
        'title', 'description', 'price', 'img', 'category_id', 'coiffeur_id','id'
    ];

    protected $primaryKey= 'id';
    public function user(){
        return $this->belongsTo('app\models\User','coiffeur_id','id');
    }
    public function coiffeur(){
        return $this->belongsTo('app\models\Coiffeur','coiffeur_id');
    }
    public function category(){
        return $this->belongsTo('app\models\Category','category_id');
    }
    public function serviceRequests(){
        return $this->hasMany('app\models\ServiceRequest');
    }
}