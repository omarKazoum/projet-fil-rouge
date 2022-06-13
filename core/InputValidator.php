<?php
namespace core;
use app\models\Category;
use app\models\Service;

require_once $_SERVER['DOCUMENT_ROOT']."/../autoloader.php";
class InputValidator
{

    public const ERRORS_KEY = 'errors';
    public const SERVICE_TITLE_PATTERN = "/^([\w ]{3,})$/";
    private const WORKING_HOURS_PATTERN='/^\[\[(\"[0-2][0-9]:[0-5][0-9]\")\,(\"[0-2][0-9]:[0-5][0-9]\")\](\,\[(\"[0-2][0-9]:[0-5][0-9]\")\,(\"[0-2][0-9]:[0-5][0-9]\")\])*\]$/';
    private const WORKING_DAYS_PATTERN="/^(\[[0-6](\,[0-6]){0,6}\])?$/";
    const DESCRIPTION_PATTERN = "/^[a-zA-Z0-9\s]{0,255}$/";
    const PRICE_PATTERN = "/^[0-9]{2,4}$/";
    const CATEGORY_TITLE_PATTERN = "/^([\w ]{3,})$/";
    public static $errors_array=[];
    //public  const INPUT_VALIDATOR_ERRORS='errors';
    private  const PASSWORD_PATTERN='/^.{6,100}$/';
    private  const EMAIL_PATTERN='/^\w+@\w+(\.\w+)+$/';
    private  const PHONE_PATTERN='/^\+{0,1}(212)|0[658]\d{8}$/';
    private  const NAME_PATTERN='/^([a-zA-Z0-9]{3,}\s?)+$/';
    private const ADRESS_PATTERN='/^([a-zA-Z0-9]{3,}\s?)+$/';

    public static function flushErrors(){
            self::$errors_array=null;
    }
    /**
     * validates the password against this criteria:
     * <ul>
     *  contain at least 6 characters 
     * </ul>
     * @param  $password
     * @return bool
     */
    public static function validatePassword( $password,$key):bool{
        $res=preg_match(self::PASSWORD_PATTERN,$password);
        if(!$res){
            self::appendError($key,"Password must be  at least 8 characters long");
        }
        return $res;
    }
    /**
     * validates the password against this criteria:
     * <ul>
     *  must be a valide email adress
     * </ul>
     * <b>Regex used <code>^([\w]{1,30})@([\w]{1,20})\.([\w]{1,20})$</code></b>
     * @param  $email
     * @return bool
     */
    public static function validateEmail($email,$key):bool{
        $res=preg_match(self::EMAIL_PATTERN,$email);
        if(!$res){
            self::appendError($key,'Invalid email address');
        }
        return $res;
    }
    public static function validateAdress($adress,$key):bool{
        $res=preg_match(self::ADRESS_PATTERN,$adress);
        if(!$res){
            self::appendError($key,'Invalid address');
        }
        return $res;
    }
    public static function validatePasswordsMatch( $password1, $password2,$key):bool{
        $isPasswordValid=self::validatePassword($password1,$key);
        $isPasswordsMatch=$password1==$password2 ;
        if(!$isPasswordsMatch){
           self::appendError($key,"Passwords must match");
        }
        return $isPasswordsMatch AND $isPasswordValid;
    }
    public static function validatePhone($phoneNbr,$key):bool{
        $isPhoneValid=preg_match(self::PHONE_PATTERN,$phoneNbr);;
        if(!$isPhoneValid)
            self::appendError($key,"Invalid phone number:must start with 212 or 0 and then 6,5 or 8 followed by 8 numbers");
        return $isPhoneValid;
    }
    public static function validateRole($role,$key){
        $isRoleValid=in_array($role,array(ROLE_TYPE_COIFFEUR,ROLE_TYPE_CUSTOMER));
        if(!$isRoleValid)
            self::appendError($key,"Invalid role value");
        return $isRoleValid;
    }
    public static function validateWorkingDays($workingDays,$key): bool
    {
        $isWorkingDaysValid=$workingDays==null || preg_match(self::WORKING_DAYS_PATTERN,$workingDays);
        if(!$isWorkingDaysValid)
            self::appendError($key,"Invalid working days value");
        return $isWorkingDaysValid;
    }
    public static function validateWorkingHours($workingHours,$key): bool
    {
        $isWorkingHoursValid=preg_match(self::WORKING_HOURS_PATTERN,$workingHours);
        if(!$isWorkingHoursValid)
            self::appendError($key,"Invalid working hours value");
        return $isWorkingHoursValid;
    }
    public static function validateUserNameDoesNotExist( $userName,$key)
    {
        $exists=User::getByName($userName);
        if($exists)
            self::appendError($key,"User name already taken");
        return !$exists;
    }

    static function areAllFieldsSet(array $fields, $method,array $fieldsCustomNames=[]) :bool{
        $isAllSet=true;
        $methodArrayName="_$method";
        foreach ($fields as $key=> $field){
            if(($method =='GET' and !isset($_GET[$field])) or ($method =='POST' and !isset($_POST[$field]) ) ){
                $isAllSet = false;
                self::appendError($field, ($fieldsCustomNames[$key] ?? $field) . ' is required');
            }
        }
        return $isAllSet;
    }
    public static function validateUserName($userName, $key)
    {
        $valid=preg_match(self::NAME_PATTERN,$userName);
        if(!$valid)
            self::$errors_array[$key]="User name must be 3 letters long and contain only alphanumeric characters";
        return $valid;
    }

    static function appendError($key,$message){
        if(!isset(self::$errors_array[$key]))
            self::$errors_array[$key]="<li>$message</li>";
        else
            self::$errors_array[$key].="<li>$message</li>";
    }

    /**
     * checks if there is an error corresponding to the given key and returns it or false otherwise
     * @param $key
     * @return false|mixed
     */
    static function error($key){
        if(isset(self::$errors_array[$key])){
            return self::$errors_array[$key];
        }else
            return false;
    }
    static function hasErrors():bool{
        return isset(self::$errors_array) && count(self::$errors_array) > 0;
    }

    public static function getErrors()
    {
        return self::$errors_array??[];
    }

    public static function validateCity(mixed $cityName, string $CITY_KEY)
    {
        $isCityValid=$cityName!=null && $cityName!='' && $cityName!=0;
        if(!$isCityValid)
            self::appendError($CITY_KEY,'Invalid city name');
        return $isCityValid;
    }
    /**
     *  validate service name
     */
    public static function validateServiceTitle(mixed $serviceName, string $key){
        $isServiceNameValid=$serviceName!=null && preg_match(self::SERVICE_TITLE_PATTERN,$serviceName);
        if(!$isServiceNameValid)
            self::appendError($key,'Nom de service invalid: doit contenir au moins 3 caractères');
        return $isServiceNameValid;
    }
    /**
     * validate description
     */
    public static function validateDescription(mixed $description, string $key)
    {
        $isDescriptionValid = $description != null && preg_match(self::DESCRIPTION_PATTERN,$description);
        if (!$isDescriptionValid)
            self::appendError($key, 'Description invalide : doit contenir au moins 3 caractères');
        return $isDescriptionValid;
    }

    public static function validatePrice(string $price, string $key)
    {
        $isPriceValid = preg_match(self::PRICE_PATTERN,$price) && $price >= 10 && $price <= 1000;
        if (!$isPriceValid)
            self::appendError($price, 'Prix invalide : doit étre entre 10 et 1000 dh');
        return $isPriceValid;
    }

    public static function validateCategoryId(mixed $categoryId, string $key): bool
    {
        $isCategoryIdValid = $categoryId != null && Category::find($categoryId);
        if (!$isCategoryIdValid)
            self::appendError($categoryId, 'Catégorie invalide');
        return $isCategoryIdValid;
    }

    public static function validateServiceId(mixed $serviceId,$key)
    {
        $service=Service::find($serviceId);
        $isServiceIdValide=$service!=null;
        if(!$isServiceIdValide)
            InputValidator::appendError($key,'service avec id '.$serviceId." n'existe pas!");
        return $isServiceIdValide;
    }

    public static function validateImageType(mixed $imageInputId, string $key):bool{
        $temp_name=$_FILES[$imageInputId]['tmp_name'];
        if($temp_name!='')
        $type=explode('/',getimagesize($temp_name)['mime'])[1];
        $isImageTypeValide=$temp_name!=''&&isset($_FILES[$imageInputId])&&in_array($type,CONFIG_ALLOWED_IMAGE_EXTENSIONS);
        if(!$isImageTypeValide)
            self::appendError($key,"L'image doit être au format jpg, jpeg, png ou gif");
        return $isImageTypeValide;
    }

    public static function validateCategoryTitle(mixed $title, string $key)
    {
        $isCategoryTitleValid = $title != null && preg_match(self::CATEGORY_TITLE_PATTERN,$title);
        if (!$isCategoryTitleValid)
            self::appendError($key, 'Nom de catégorie invalide : doit contenir au moins 3 caractères');
        return $isCategoryTitleValid;
    }
}