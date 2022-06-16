<?php

namespace app\controllers;

use app\models\Service;
use app\models\User;

class TestController
{
    function testGet(){
        view('test', false);
    }
    function testPost(){

        view('test', false);

    }
}