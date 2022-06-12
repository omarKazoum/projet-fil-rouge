<?php

namespace app\controllers;

use app\models\Adress;
use app\models\Customer;
use app\models\User;
use core\InputValidator;
use core\SessionManager;
use Symfony\Component\Console\Input\Input;

class HomeController
{
    public function index()
    {
        if(SessionManager::getInstance()->isLoggedIn()) {
            redirect('/services');
        }else{
            view('landing', false);
        }
    }
    function sign_up(){
        viewNoSidebar('sign_up');
    }
    function signupSubmit(){
        //TODO:: add validation do not forget the role
        //let's validate user input
        if(
            InputValidator::validateUserName($_POST[FIRST_NAME_KEY],FIRST_NAME_KEY)
            AND InputValidator::validateUserName($_POST[LAST_NAME_KEY],LAST_NAME_KEY)
            AND InputValidator::validateUserName($_POST[USER_NAME_KEY],USER_NAME_KEY)
            AND InputValidator::validateEmail($_POST[EMAIL_KEY],EMAIL_KEY)
            AND InputValidator::validatePassword($_POST[PASSWORD_KEY],PASSWORD_KEY)
            AND InputValidator::validatePasswordsMatch($_POST[PASSWORD_KEY],$_POST[PASSWORD_REPEAT_KEY],PASSWORD_REPEAT_KEY)
            AND InputValidator::validatePhone($_POST[PHONE_KEY],PHONE_KEY)
            AND InputValidator::validateCity($_POST[CITY_KEY],CITY_KEY)
            AND InputValidator::validateAdress($_POST[ADRESS_KEY],ADRESS_KEY)
            AND InputValidator::validateRole($_POST[ROLE_KEY],ROLE_KEY)
            AND ($_POST[ROLE_KEY]==ROLE_TYPE_CUSTOMER OR InputValidator::validateWorkingDays($_POST[WORKING_DAYS_KEY],WORKING_DAYS_KEY)
                AND InputValidator::validateWorkingHours($_POST[WORKING_HOURS_KEY],WORKING_HOURS_KEY))){
            uploadImage();
            // if the data is valid
            $user=new User();
            $user->first_name=$_POST[FIRST_NAME_KEY];
            $user->last_name=$_POST[LAST_NAME_KEY];
            $user->user_name=$_POST[USER_NAME_KEY];
            $user->email=$_POST[EMAIL_KEY];
            $user->password=$_POST[PASSWORD_KEY];
            $user->role=$_POST[ROLE_KEY];
            $user->phone=$_POST[PHONE_KEY];
            //TODO::handle image upload here
            $user->img=$_POST['img'];
            if($user->role==ROLE_TYPE_CUSTOMER){
                $user->customer()->create([PHONE_KEY=>$_POST[PHONE_KEY],CITY_KEY=>$_POST[CITY_KEY],ADRESS_KEY=>$_POST[ADRESS_KEY],ADRESS_KEY=>$_POST[ADRESS_KEY]]);
            }elseif ($user->role==ROLE_TYPE_COIFFEUR){
                $user->coiffeur()->create([PHONE_KEY=>$_POST[PHONE_KEY],CITY_KEY=>$_POST[CITY_KEY],ADRESS_KEY=>$_POST[ADRESS_KEY],ADRESS_KEY=>$_POST[ADRESS_KEY],STORE_NAME_KEY=>$_POST[STORE_NAME_KEY],WORKING_HOURS_KEY=>$_POST[WORKING_HOURS_KEY],WORKING_DAYS_KEY=>$_POST[WORKING_DAYS_KEY]]);
            }
            $user->save();
            //TODO redirect to login page
            SessionManager::getInstance()->login($user->id);
            redirect('/');
        }
        else
            viewNoSidebar('sign_up');
    }
    function login(){
        viewNoSidebar('login');
    }
    function loginSubmit(){
        //TODO login the user and redirect to the dashboard
        if(!isset($_POST[EMAIL_KEY])){
            viewNoSidebar('login');
            exit();
        }else{
            $user=User::where('email',$_POST[EMAIL_KEY])->first();
            if($user!=null AND password_verify($_POST[PASSWORD_KEY],$user->password_hash)){
                    SessionManager::getInstance()->login($user);
                    redirect('/');
            }else{
                InputValidator::appendError(LOGIN_ERROR_KEY,'Invalid email or password');
                viewNoSidebar('login');
            }
        }
    }
    function components(){
        view('components',true);
    }
    function logout(){
        SessionManager::getInstance()->logout();
        redirect('/');
    }
    function profile()
    {
        if (SessionManager::getInstance()->isLoggedIn()) {
            $user = SessionManager::getInstance()->getLoggedInUser();
            echo 'profile ';
            //view('profile', true, ['user' => $user]);
        } else {
            redirect('/');
        }
    }
}