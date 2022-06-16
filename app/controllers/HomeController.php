<?php

namespace app\controllers;

use app\models\Adress;
use app\models\Coiffeur;
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
        if(SessionManager::getInstance()->isLoggedIn()) {
            redirect('/services');
        }else {
            viewNoSidebar('sign_up');
        }
    }
    function signupSubmit(){
        $erors=InputValidator::getErrors();
        if(SessionManager::getInstance()->isLoggedIn()) {
            redirect('/services');
        }else {
              if (InputValidator::validateRole($_POST[ROLE_KEY], ROLE_KEY)
                and InputValidator::validateName($_POST[FIRST_NAME_KEY], FIRST_NAME_KEY, 'Votre prénom')
                and InputValidator::validateName($_POST[LAST_NAME_KEY], LAST_NAME_KEY, 'Votre nom')
                and InputValidator::validateName($_POST[USER_NAME_KEY], USER_NAME_KEY, 'Votre nom d\'utilisateur')
                and InputValidator::validateEmailNotTaken($_POST[EMAIL_KEY], EMAIL_KEY)
                and InputValidator::validateEmail($_POST[EMAIL_KEY], EMAIL_KEY)
                and InputValidator::validatePassword($_POST[PASSWORD_KEY], PASSWORD_KEY)
                and InputValidator::validatePasswordsMatch($_POST[PASSWORD_KEY], $_POST[PASSWORD_REPEAT_KEY], PASSWORD_REPEAT_KEY)
                and InputValidator::validateImageType(PROFILE_IMG_KEY, PROFILE_IMG_KEY)
                and (
                        (
                            $_POST[ROLE_KEY] == ROLE_TYPE_COIFFEUR
                            && InputValidator::validatePhone($_POST[PHONE_KEY], PHONE_KEY)
                            && InputValidator::validateCity($_POST[CITY_KEY], CITY_KEY)
                            && InputValidator::validateQuartier($_POST[QUARTIER_KEY], QUARTIER_KEY)
                            && InputValidator::validateName($_POST[STORE_NAME_KEY], STORE_NAME_KEY, 'Votre nom de salon')
                            && InputValidator::validateWorkingDays($_POST[WORKING_DAYS_KEY], WORKING_DAYS_KEY)
                            && InputValidator::validateWorkingHours($_POST[WORKING_HOURS_KEY], WORKING_HOURS_KEY)
                        )
                        or
                        (
                            $_POST[ROLE_KEY] == ROLE_TYPE_CUSTOMER
                            && InputValidator::validatePhone($_POST[PHONE_KEY], PHONE_KEY)
                        )
                )
            ) {
                //if the data is valid
                //we create a new record in the users table
                $user = new User();
                $user->first_name = $_POST[FIRST_NAME_KEY];
                $user->last_name = $_POST[LAST_NAME_KEY];
                $user->user_name = $_POST[USER_NAME_KEY];
                $user->email = $_POST[EMAIL_KEY];
                $user->password = $_POST[PASSWORD_KEY];
                $user->role = $_POST[ROLE_KEY];
                $user->save();
                //the image is optional so there is a default value
                $img_path = upload_image(PROFILE_IMG_KEY,false);
                $img_path = $img_path ? $img_path : IMG_NOT_UPLOADED_KEY;
                if ($user->role == ROLE_TYPE_CUSTOMER) {
                    //if the user is a customer we create a new record in the customers table
                    $user->img = $img_path;
                    $c = new Customer();
                    $c->user_id = $user->id;
                    $c->phone = $_POST[PHONE_KEY];
                    $c->img = $img_path;
                    $c->save();
                } elseif ($user->role == ROLE_TYPE_COIFFEUR) {
                    //if the user is a coiffeur we create a new record in the coiffeurs table
                    $coiffeur = new Coiffeur();
                    $coiffeur->user_id = $user->id;
                    $coiffeur->phone = $_POST[PHONE_KEY];
                    $coiffeur->city = $_POST[CITY_KEY];
                    $coiffeur->quartier = $_POST[QUARTIER_KEY];
                    $coiffeur->store_title = $_POST[STORE_NAME_KEY];
                    $coiffeur->work_days = $_POST[WORKING_DAYS_KEY];
                    $coiffeur->work_hours = $_POST[WORKING_HOURS_KEY];
                    $coiffeur->img = $img_path;
                    $coiffeur->save();
                }
                //TODO redirect to index page
                SessionManager::getInstance()->login($user);
                redirect(getBaseUrlWithMessage('services', 'Vous êtes bien inscrit', 'success'));
            } else
                viewNoSidebar('sign_up');
        }
    }
    function login(){if(SessionManager::getInstance()->isLoggedIn()) {
        redirect('/services');
    }else
        viewNoSidebar('login');
    }
    function loginSubmit(){
        //TODO login the user and redirect to the dashboard
        if(!InputValidator::areAllFieldsSet([EMAIL_KEY,PASSWORD_KEY],'POST')){
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
    //TODO remove this function
    function components(){
        view('components',true);
    }
    function logout(){
        SessionManager::getInstance()->logout();
        redirect('/');
    }
    function profile()
    {
        //TODO finish this function
        if (SessionManager::getInstance()->isLoggedIn()) {
            $user = SessionManager::getInstance()->getLoggedInUser();
            echo 'profile ';
            //view('profile', true, ['user' => $user]);
        } else {
            redirect('/');
        }
    }
}