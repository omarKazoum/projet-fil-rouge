<?php
/**
 * requires a view by its name <b color="red">please do not use the file extension</b>
 * @param $viewName
 * @param ...$args the params to pas to the view in form of ['key'=>'value']
 * @return void
 */function view($viewName,bool $wrapInTemplate=true,...$args){
    foreach ($args as $arg){
        foreach ($arg as $key =>$value)
            $$key=$value;
   }
    if($wrapInTemplate) {
        ob_start();
        require_once '..' . DIRECTORY_SEPARATOR ."app".DIRECTORY_SEPARATOR. "views" . DIRECTORY_SEPARATOR . $viewName . '.php';
        $page_content = ob_get_clean();
        require_once '..' . DIRECTORY_SEPARATOR ."app".DIRECTORY_SEPARATOR. "views" . DIRECTORY_SEPARATOR . 'templates/template.php';

    }else{
        require_once '..' . DIRECTORY_SEPARATOR . "app".DIRECTORY_SEPARATOR."views" . DIRECTORY_SEPARATOR . $viewName . '.php';
    }
 }

/**
 * @param $viewName
 * @param ...$args
 */
function viewNoSidebar($viewName,...$args){
    foreach ($args as $arg){
        foreach ($arg as $key =>$value)
            $$key=$value;
    }
        ob_start();
        require_once '..' . DIRECTORY_SEPARATOR ."app".DIRECTORY_SEPARATOR. "views" . DIRECTORY_SEPARATOR . $viewName . '.php';
        $page_content = ob_get_clean();
        require_once '..' . DIRECTORY_SEPARATOR ."app".DIRECTORY_SEPARATOR. "views" . DIRECTORY_SEPARATOR . 'templates/template_navbar_only.php';
}
function redirect($endpoint = "/"){
    header('location:'.getUrlFor($endpoint));
    exit();
 }

function getUrlFor($url_relative_to_root):string{
    if ($url_relative_to_root[0] == "/")
        return "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url_relative_to_root;
    else
        return "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'.$url_relative_to_root;
}
function css($filename){
     return getUrlFor('assets/css/'.$filename);
}
function js($fileName){
    return getUrlFor('assets/js/'.$fileName);
}
function img($imgName){
    return getUrlFor('assets/img/'.$imgName);
}
function jsonResponse($responseCode,$responseMessage,$responseData=null){
    header('Content-Type: application/json');
    $response=[
        'code'=>$responseCode,
        'message'=>$responseMessage,
        'data'=>$responseData
    ];
    echo json_encode($response);
    exit();
}
function requestUrlMatches(...$uris):bool{
    $requestUrl=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    $requestUrl=stripAllSlashes($requestUrl);
    foreach ($uris as $uri){
        if(preg_match(core\Route::createRegexFromUriIndecation(stripAllSlashes($uri)),$requestUrl))
            return true;
    }
    return false;
}
function stripAllSlashes($text){
    $text=preg_replace('#^/#','',$text);
    $text=preg_replace('#/$#','',$text);
    return $text;
}
//TODO:: implement this function
function uploadImage($imageInputName,$uploadDir,array $allowedExtensions=null,$maxSize=null):bool{
    if(isset($_FILES[PROFILE_IMG_KEY])) {
        $target_dir = "../../assets/img/uploads/";
        $target_file = $target_dir . basename($_FILES[PROFILE_IMG_KEY]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[PROFILE_IMG_KEY]["tmp_name"]);
        echo 'check:</br>';
        print_r($check);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
}
