<?php
if (!defined('AUTO_LOAD_CALLED')) {
    spl_autoload_register('load_class');

    require_once 'app/utils/Constants.php';
    require_once 'app/configs/config.php';
    require_once 'core/functions.php';
    require_once 'app/routes/web.php';
    require_once 'app/routes/api.php';
    require_once 'vendor/autoload.php';

    define('AUTO_LOAD_CALLED', true);
}
function load_class($className){
    $classPath=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.str_replace('\\',DIRECTORY_SEPARATOR,$className).'.php';
        if(is_readable($classPath)){
        require_once $classPath;
    }

}
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

