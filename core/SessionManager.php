<?php
namespace core;
use app\models\User;

class SessionManager
{
    private const  CONNECTED_USER_KEY='connected_user_id';
    private const LAST_LOGGED_IN_TIME_TIME='last_logged_in';
    private  ?User $connectedUser=null;
    private  bool $isLoggedIn=false;
    private static ?SessionManager $instance=null;
    private function __construct()
    {
        global $session_time_out_minutes;
        //this line has no effect as it's not taken into account by the server
        $str=strval(60*$session_time_out_minutes);
        ini_set('session.gc_maxlifetime', $str);
        // each client should remember their session id for for a certain number of seconds
        session_set_cookie_params($str);
        session_start();
        InputValidator::flushErrors();
        $this->isLoggedIn=isset($_SESSION[self::CONNECTED_USER_KEY]) AND !empty($_SESSION[self::CONNECTED_USER_KEY]);
        if($this->isLoggedIn){
            $this->connectedUser=$_SESSION[self::CONNECTED_USER_KEY];
        }
    }
    /**
     * helps you log in
     * @param string $userId
     * @return void
     *
     */
    public function login(User $user){
        $_SESSION[self::CONNECTED_USER_KEY]=$user;
        $_SESSION[self::LAST_LOGGED_IN_TIME_TIME]=date("l,d \of M Y , H:i:s");
    }
    public function logOut(){
        session_unset();
        session_destroy();
    }
    public function isLoggedIn():bool{
        return $this->isLoggedIn;
    }

    /**
     * returns the id of the current logged in user
     * @return mixed|string
     */
    public function getLoggedInUser(){
        return $this->connectedUser;
    }  /**
     * creates a new instance and stores it in the $instance static variable
     * @return SessionManager
     */
    public static function getInstance():SessionManager{
        if(!SessionManager::$instance)
            SessionManager::$instance=new SessionManager();
        return SessionManager::$instance;
    }
    public function getLastLogin()
    {
        return $_SESSION[self::LAST_LOGGED_IN_TIME_TIME];
    }

}