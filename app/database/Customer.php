<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('customers',function (\Illuminate\Database\Schema\Blueprint $table){
    $table->integer('user_id')->primary();
    $table->string('phone');
    $table->string('img');
});