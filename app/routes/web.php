<?php

use core\Route;
use app\controllers\HomeController;

//declare here your endpoints and their corresponding controller methods
Route::get('error', function () {
    view('404', false);
});

Route::get('/',[new app\controllers\HomeController(),'index']);
//services
Route::get('/services',[new app\controllers\ServicesController(),'list']);
Route::get('/services/add',[new app\controllers\ServicesController(),'addForm']);
Route::post('/services/add',[new app\controllers\ServicesController(),'addSubmit']);
Route::get('services/update/{id}',[new app\controllers\ServicesController(),'updateForm']);
Route::post('services/update',[new app\controllers\ServicesController(),'updateSubmit']);
//authentication and user
Route::get('signup',[new app\controllers\HomeController(),'sign_up']);
Route::get('login',[new app\controllers\HomeController(),'login']);
Route::post('login',[new app\controllers\HomeController(),'loginSubmit']);
Route::post('signup',[new app\controllers\HomeController(),'signupSubmit']);
Route::get('logout',[new app\controllers\HomeController(),'logout']);
Route::get('profile',[new app\controllers\HomeController(),'profile']);
//this is for testing
Route::get('components',[new app\controllers\HomeController(),'components']);
Route::get('test',[new app\controllers\TestController(), 'testGet']);
Route::post('test',[new app\controllers\TestController(),'testPost']);

