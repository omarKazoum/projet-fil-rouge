<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps=false;
    protected $fillable = [
        'first_name', 'last_name','user_name','email','role'
    ];
    protected $hidden = [
        'password_hash','id'
    ];
    protected $primaryKey= 'id';
    public function __set($key, $value)
    {
        if($key == 'password')
        {
            $this->attributes['password_hash'] = password_hash($value, PASSWORD_DEFAULT);
        }
        else
        {
            $this->attributes[$key] = $value;
        }
    }
    public function customer(){
        return $this->hasOne('app\models\Customer');
    }
    public function coiffeur(){
        return $this->hasOne('app\models\Coiffeur');
    }

}