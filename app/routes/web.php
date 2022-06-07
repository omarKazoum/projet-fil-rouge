<?php
//require_once '../../autoloader.php';

use core\Route;
use app\controllers\Home;

//declare here your endpoints and their corresponding controller methods
Route::get('error', function () {
    view('404', false);
});

Route::get('/',[new app\controllers\Home(),'index']);
Route::get('/about',function () {
    //view('about', false);
    echo "this is about page";
});
Route::get('signup',[new app\controllers\Home(),'sign_up']);
Route::get('login',[new app\controllers\Home(),'login']);
Route::post('login',[new app\controllers\Home(),'loginSubmit']);
Route::post('signup',[new app\controllers\Home(),'signupSubmit']);
//TODO:: implement this
Route::get('logout',[new app\controllers\Home(),'logout']);
Route::get('components',[new app\controllers\Home(),'components']);