<?php

namespace app\controllers;

use app\models\Adress;
use app\models\Customer;
use app\models\User;

class Home
{
    public function index()
    {
        view('landing',false);
    }
    function sign_up(){
        viewNoSidebar('sign_up');
    }
    function signupSubmit(){
        //TODO:: add validation do not forget the role
        $user=new User();
        $user->first_name=$_POST[FIRST_NAME_KEY];
        $user->last_name=$_POST[LAST_NAME_KEY];
        $user->user_name=$_POST[USER_NAME_KEY];
        $user->email=$_POST[EMAIL_KEY];
        $user->password=$_POST[PASSWORD_KEY];
        //todo:: change the role
        $user->role=$_POST[ROLE_KEY];
        //TODO::handle image upload here
        $user->img=$_POST['img'];
        if($user->role==ROLE_TYPE_CUSTOMER){
            $user->customer()->create([PHONE_KEY=>$_POST[PHONE_KEY],CITY_KEY=>$_POST[CITY_KEY],REGION_KEY=>$_POST[REGION_KEY],QUARTER_KEY=>$_POST[QUARTER_KEY],QUARTER_KEY=>$_POST[QUARTER_KEY]]);
        }elseif ($user->role==ROLE_TYPE_COIFFEUR){
            $user->coiffeur()->create([PHONE_KEY=>$_POST[PHONE_KEY],CITY_KEY=>$_POST[CITY_KEY],REGION_KEY=>$_POST[REGION_KEY],QUARTER_KEY=>$_POST[QUARTER_KEY],QUARTER_KEY=>$_POST[QUARTER_KEY],STORE_NAME_KEY=>$_POST[STORE_NAME_KEY],WORKING_HOURS_KEY=>$_POST[WORKING_HOURS_KEY],WORKING_DAYS_KEY=>$_POST[WORKING_DAYS_KEY]]);
        }
        $user->save();
        redirect('login');
    }
    function login(){
        viewNoSidebar('login');
    }
    function loginSubmit(){
        //TODO login the user and redirect to the dashboard
        print_r($_POST);
    }
    function components(){
        view('components',false);
    }

}