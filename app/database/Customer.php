<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('customers',function ($table){
    //TODO:: add primary key
    $table->integer('user_id');
    $table->string('phone');
    $table->integer('adress');
    $table->string('img');
});