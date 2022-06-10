<?php

use core\Route;

Route::get('/reserve/{service_id}',[new app\controllers\ServicesController(),'reserve']);