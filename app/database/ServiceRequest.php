<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('service_requests',function ($table){
    $table->increments('id');
    $table->string('service_id');
    $table->date('date');
    $table->time('time');
    $table->string('status');
    $table->string('client_id');
    //$table->rememberToken();
    $table->timestamps();


});