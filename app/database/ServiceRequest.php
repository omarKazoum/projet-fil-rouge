<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('service_requests',function ($table){
    $table->increments('id');
    $table->integer('service_id');
    $table->foreign('service_id')->references('id')->on('services');
    $table->date('date');
    $table->time('time');
    $table->string('status');
    $table->string('client_id');
    $table->foreign('client_id')->references('user_id')->on('Customers');
    $table->timestamps();
});