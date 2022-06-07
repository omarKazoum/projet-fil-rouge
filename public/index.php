<?php
require_once "../autoloader.php";
use core\Route;
//configuring eloquent
Route::processIncomingRequest();
\core\InputValidator::flushErrors();

?>