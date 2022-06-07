<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('users',function ($table){
    $table->increments('id');
    $table->string('first_name');
    $table->string('last_name');
    $table->string('user_name');
    $table->string('img');
    $table->string('password_hash');
    $table->string('email');
    $table->string('role');
    $table->string('genre');
    /*$table->rememberToken();
    $table->timestamps();*/


});