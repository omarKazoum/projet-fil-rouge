<?php

use core\Route;

Route::post('services/reserve',[new app\controllers\ServicesController(),'reserve']);