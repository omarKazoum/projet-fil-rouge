<?php
//auto load implementation
if (!defined('AUTO_LOAD_CALLED')) {
    spl_autoload_register('load_class');

    require_once 'app/utils/Constants.php';
    require_once 'app/configs/config.php';
    require_once 'vendor/autoload.php';
    require_once 'core/functions.php';
    require_once 'app/routes/web.php';
    require_once 'app/routes/api.php';

    define('AUTO_LOAD_CALLED', true);
}
function load_class($className){
    $classPath=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.str_replace('\\',DIRECTORY_SEPARATOR,$className).'.php';
        if(is_readable($classPath)){
        require_once $classPath;
    }

}
//custom exceptions handler

/*register_shutdown_function(function(){
    $error = error_get_last();
    if($error['type'] === E_ERROR) {
        $message = $error['message'];
        $file = $error['file'];
        $line = $error['line'];
        $logger = new Logger();
        $logger->error("$message in $file on line $line");
    }});*/

//init eloquent
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => DB_DRIVER,
    "host" =>DB_HOST_NAME,
    "database" => DB_NAME,
    "username" => DB_USER_NAME,
    "password" => DB_PASSWORD
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

