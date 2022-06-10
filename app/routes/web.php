<?php
//require_once '../../autoloader.php';

use core\Route;
use app\controllers\HomeController;

//declare here your endpoints and their corresponding controller methods
Route::get('error', function () {
    view('404', false);
});

Route::get('/',[new app\controllers\HomeController(),'index']);
Route::get('/about',function () {
    //view('about', false);
    echo "this is about page";
});
//services
Route::get('/services',[new app\controllers\ServicesController(),'list']);
Route::get('/services/add',[new app\controllers\ServicesController(),'addForm']);
Route::post('/services/add',[new app\controllers\ServicesController(),'addSubmit']);
Route::get('services/update',[new app\controllers\ServicesController(),'updateForm']);
Route::post('services/update',[new app\controllers\ServicesController(),'updateSubmit']);

//authentication
Route::get('signup',[new app\controllers\HomeController(),'sign_up']);
Route::get('login',[new app\controllers\HomeController(),'login']);
Route::post('login',[new app\controllers\HomeController(),'loginSubmit']);
Route::post('signup',[new app\controllers\HomeController(),'signupSubmit']);
//TODO:: implement this
Route::get('logout',[new app\controllers\HomeController(),'logout']);
Route::get('components',[new app\controllers\HomeController(),'components']);
Route::get('services',[new app\controllers\ServicesController(), 'list']);