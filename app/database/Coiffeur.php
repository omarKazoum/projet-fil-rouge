<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('coiffeurs',function ($table){
    $table->integer('user_id');
    $table->string('city');
    $table->string('quartier');
    $table->string('phone');
    $table->string('store_title');
    $table->string('img');
    $table->string('work_hours');
    $table->string('work_days');
});