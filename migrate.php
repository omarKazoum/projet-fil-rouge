<?php

if (!defined('AUTO_LOAD_CALLED')) {
    spl_autoload_register('load_class');
    require_once 'app/configs/config.php';
    require_once 'core/functions.php';
    require_once 'vendor/autoload.php';


    define('AUTO_LOAD_CALLED', true);
}
function load_class($className)
{
    echo "looking for $className</br>";
    $classPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    echo "classPath: $classPath</br>";
    if (is_readable($classPath)) {
        echo "found: classPath=$classPath</br>";
        require_once $classPath;
    }

}

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => DB_DRIVER,
    "host" => DB_HOST_NAME,
    "database" => DB_NAME,
    "username" => DB_USER_NAME,
    "password" => DB_PASSWORD
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$files = glob("app/database" . '/*.php');

foreach ($files as $file) {
    //echo "found file: " . $file . "\n";
    require_once($file);
}
//echo password_hash('123456', PASSWORD_DEFAULT);

