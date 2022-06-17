<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    public $timestamps=false;
    protected $fillable = [
        'service_id','client_id','status','date','time'
    ];
    protected $hidden = ['id'];
    protected $primaryKey= 'id';
    public function service(){
        return $this->belongsTo('app\models\Service');
    }
    public function customer()
    {
        return $this->belongsTo('app\models\User', 'client_id');
    }
}