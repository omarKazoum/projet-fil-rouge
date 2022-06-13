<?php

use core\Route;
//for resreve service request
Route::post('services/reserve',[new app\controllers\ServicesController(),'reserve'],SERVICE_REQUESTS_ENDPOINT_LABEL);
Route::get('reservations/cancel/{id}',[new app\controllers\ReservationsController(),'cancel'],SERVICE_REQUESTS_ENDPOINT_LABEL);
Route::get('reservations/confirm/{id}',[new app\controllers\ReservationsController(),'confirm'],SERVICE_REQUESTS_ENDPOINT_LABEL);
Route::get('reservations/reject/{id}',[new app\controllers\ReservationsController(),'reject'],SERVICE_REQUESTS_ENDPOINT_LABEL);
Route::get('reservations/pend/{id}',[new app\controllers\ReservationsController(),'pend'],SERVICE_REQUESTS_ENDPOINT_LABEL);
//for categories
Route::get('categories/delete/{id}',[new app\controllers\CategoriesController(),'delete'],CATEGORIES_ENDPOINT_LABEL);
Route::post('categories/save',[new app\controllers\CategoriesController(),'save'],CATEGORIES_ENDPOINT_LABEL);
Route::post('categories/update',[new app\controllers\CategoriesController(),'update'],CATEGORIES_ENDPOINT_LABEL);