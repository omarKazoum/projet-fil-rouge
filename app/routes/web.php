<?php

use core\Route;
use app\controllers\UserController;

//declare here your endpoints and their corresponding controller methods

Route::get('/',[new app\controllers\UserController(),'index']);
//services
Route::get('/services',[new app\controllers\ServicesController(),'list'],SERVICES_ENDPOINT_LABEL);
Route::get('/services/add',[new app\controllers\ServicesController(),'addForm'],SERVICES_ENDPOINT_LABEL);
Route::post('/services/add',[new app\controllers\ServicesController(),'addSubmit'],SERVICES_ENDPOINT_LABEL);
Route::get('services/update/{id}',[new app\controllers\ServicesController(),'updateForm'],SERVICES_ENDPOINT_LABEL);
Route::post('services/update',[new app\controllers\ServicesController(),'updateSubmit'],SERVICES_ENDPOINT_LABEL);
Route::get('services/delete/{id}',[new app\controllers\ServicesController(),'delete'],SERVICES_ENDPOINT_LABEL);
Route::setAuthenticationRequired(SERVICES_ENDPOINT_LABEL);
//reservations
Route::get('/reservations',[new app\controllers\ReservationsController(),'list'],SERVICE_REQUESTS_ENDPOINT_LABEL);
Route::setAuthenticationRequired(SERVICE_REQUESTS_ENDPOINT_LABEL);
//authentication and user
Route::get('signup',[new app\controllers\UserController(), 'signUp'],AUTHENTICATION_ENDPOINT_LABEL);
Route::get('login',[new app\controllers\UserController(),'login'],AUTHENTICATION_ENDPOINT_LABEL);
Route::post('login',[new app\controllers\UserController(),'loginSubmit'],AUTHENTICATION_ENDPOINT_LABEL);
Route::post('signup',[new app\controllers\UserController(),'signupSubmit'],AUTHENTICATION_ENDPOINT_LABEL);
Route::get('logout',[new app\controllers\UserController(),'logout'],USERS_ENDPOINT_LABEL);
Route::get('profile',[new app\controllers\UserController(),'profile'],USERS_ENDPOINT_LABEL);
Route::post('profile',[new app\controllers\UserController(),'profileUpdateSubmit'],USERS_ENDPOINT_LABEL);
Route::setAuthenticationRequired(USERS_ENDPOINT_LABEL);
//categories
Route::get('/categories',[new app\controllers\CategoriesController(),'index'],CATEGORIES_ENDPOINT_LABEL);
Route::setAuthenticationRequired(CATEGORIES_ENDPOINT_LABEL);

