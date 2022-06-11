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
        echo upload_image("profile_165490532545225_img.png",'image',);
        view('test', false);

    }
}