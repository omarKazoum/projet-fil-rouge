<?php

namespace app\controllers;

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