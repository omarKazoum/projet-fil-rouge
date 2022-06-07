<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('adresses',function ($table){
    $table->increments('id');
    $table->integer('region_id');
    $table->integer('city_id');
    $table->string('quartier');
});