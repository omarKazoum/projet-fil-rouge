<?php

namespace app\controllers;

use app\models\Adress;
use app\models\Coiffeur;
use app\models\Customer;
use app\models\User;
use core\InputValidator;
use core\SessionManager;
use Symfony\Component\Console\Input\Input;

class UserController
{
    function index()
    {
        if(SessionManager::getInstance()->isLoggedIn()) {
            redirect('/services');
        }else{
            view('landing', false);
        }
    }
    function signUp(){
        if(SessionManager::getInstance()->isLoggedIn()) {
            redirect('/services');
        }else {
            viewNoSidebar('sign_up');
        }
    }
    function signupSubmit(){
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
                $img_path = $img_path ? $img_path : PROFILE_IMG_NOT_UPLOADED_KEY;
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
        if(!InputValidator::areAllFieldsSet([EMAIL_KEY,PASSWORD_KEY],'POST')){
            viewNoSidebar('login');
            exit();
        }else{
            $user=User::query()->where('email',$_POST[EMAIL_KEY])->orWhere('user_name',$_POST[EMAIL_KEY])->first();
            if($user!=null AND password_verify($_POST[PASSWORD_KEY],$user->password_hash)){
                    SessionManager::getInstance()->login($user);
                    redirect('/');
            }else{
                InputValidator::appendError(LOGIN_ERROR_KEY,'Invalid email or password');
                viewNoSidebar('login');
            }
        }
    }
    function logout(){
        SessionManager::getInstance()->logout();
        redirect('/');
    }

    /**
     * show profile page
     * @return void
     */
    function profile()
    {
            view('profile', true,['user'=>SessionManager::getInstance()->getLoggedInUser()]);
    }

    /**
     * update the profile of the connected user
     * @return void
     */
    function profileUpdateSubmit()
    {
        if(!SessionManager::getInstance()->isLoggedIn()){
            redirect('/');
            exit;
        }
        $user = SessionManager::getInstance()->getLoggedInUser();
        //ignore password if updated is not set
        if (InputValidator::validateName($_POST[FIRST_NAME_KEY], FIRST_NAME_KEY, 'Votre prénom')
            and InputValidator::validateName($_POST[LAST_NAME_KEY], LAST_NAME_KEY, 'Votre nom')
            and InputValidator::validateName($_POST[USER_NAME_KEY], USER_NAME_KEY, 'Votre nom d\'utilisateur')
            and InputValidator::validateEmail($_POST[EMAIL_KEY], EMAIL_KEY)
            AND (
                !isset($_POST[PASSWORD_UPDATE_KEY])
                OR (
                    InputValidator::validatePassword($_POST[PASSWORD_KEY], PASSWORD_KEY)
                    && InputValidator::validatePasswordsMatch($_POST[PASSWORD_KEY], $_POST[PASSWORD_REPEAT_KEY], PASSWORD_REPEAT_KEY)
                    )
                )
            AND (!isset($_FILES[PROFILE_IMG_KEY]) || InputValidator::validateImageType(PROFILE_IMG_KEY, PROFILE_IMG_KEY))
            AND (
                    (
                        $user->role == ROLE_TYPE_COIFFEUR
                        && InputValidator::validatePhone($_POST[PHONE_KEY], PHONE_KEY)
                        && InputValidator::validateCity($_POST[CITY_KEY], CITY_KEY)
                        && InputValidator::validateQuartier($_POST[QUARTIER_KEY], QUARTIER_KEY)
                        && InputValidator::validateName($_POST[STORE_NAME_KEY], STORE_NAME_KEY, 'Votre nom de salon')
                        && InputValidator::validateWorkingDays($_POST[WORKING_DAYS_KEY], WORKING_DAYS_KEY)
                        && InputValidator::validateWorkingHours($_POST[WORKING_HOURS_KEY], WORKING_HOURS_KEY)
                    )
                    or
                    (
                        $user->role == ROLE_TYPE_CUSTOMER
                        && InputValidator::validatePhone($_POST[PHONE_KEY], PHONE_KEY)
                    )
                or
                    $user->role == ROLE_TYPE_ADMIN

            )
        ) {
            //if the data is valid
            $user = User::find(SessionManager::getInstance()->getLoggedInUser()->id);
            $user->first_name = $_POST[FIRST_NAME_KEY];
            $user->last_name = $_POST[LAST_NAME_KEY];
            $user->user_name = $_POST[USER_NAME_KEY];
            $user->email = $_POST[EMAIL_KEY];
            if(isset($_POST[PASSWORD_UPDATE_KEY])){
                $user->password = $_POST[PASSWORD_KEY];
            }
            $user->save();
            //the image is optional so there is a default value
            if ($user->role == ROLE_TYPE_CUSTOMER) {
                $customer= Customer::query()->where('user_id',$user->id)->first();
                $img_path = upload_image(PROFILE_IMG_KEY,($customer->img!=PROFILE_IMG_NOT_UPLOADED_KEY?$customer->img:false));
                $img_path = $img_path ?: PROFILE_IMG_NOT_UPLOADED_KEY;
                $customer->img = $img_path;
                $customer->phone = $_POST[PHONE_KEY];
                $customer->save();
            } elseif ($user->role == ROLE_TYPE_COIFFEUR) {
                $coiffeur =Coiffeur::query()->where('user_id',$user->id)->first(); ;
                $img_path = upload_image(PROFILE_IMG_KEY,($coiffeur->img!=PROFILE_IMG_NOT_UPLOADED_KEY?$coiffeur->img:false));
                $img_path = $img_path ?: PROFILE_IMG_NOT_UPLOADED_KEY;
                $coiffeur->img = $img_path;
                $coiffeur->phone = $_POST[PHONE_KEY];
                $coiffeur->city = $_POST[CITY_KEY];
                $coiffeur->quartier = $_POST[QUARTIER_KEY];
                $coiffeur->store_title = $_POST[STORE_NAME_KEY];
                $coiffeur->work_days = $_POST[WORKING_DAYS_KEY];
                $coiffeur->work_hours = $_POST[WORKING_HOURS_KEY];
                $coiffeur->save();
            }
            SessionManager::getInstance()->login($user);
            redirect(getBaseUrlWithMessage('profile', 'Votre profil a été mis à jour avec succès', 'success'));
        }
        view('profile', true,['user'=>SessionManager::getInstance()->getLoggedInUser()]);

    }
}