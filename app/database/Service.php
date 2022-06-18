<?php
use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('services',function ($table){
    $table->increments('id');
    $table->string('title');
    $table->string('img');
    $table->string('description');
    $table->string('price');
    $table->integer('category_id');
    $table->foreign('category_id')->references('id')->on('categories');
    $table->integer('coiffeur_id');
    $table->foreign('coiffeur_id')->references('user_id')->on('coiffeurs');
});