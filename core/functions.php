<?php
/**
 * requires a view by its name <b color="red">please do not use the file extension</b>
 * @param $viewName
 * @param ...$args the params to pass to the view in form of ['key'=>'value']
 * @return void
 */
function view($viewName,bool $wrapInTemplate=true,...$args){
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
    if($url_relative_to_root==='')
        $url_relative_to_root='/';
    if ($url_relative_to_root[0] == "/")
        return "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$url_relative_to_root;
    else
        return "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/'.$url_relative_to_root;
}
function getBaseUrlWithMessage($url_relative_to_root,$message,$type):string{
    return $url_relative_to_root.'?message='.$message.'&type='.$type;
}
function printMessage($message,$type){
    echo '<div class="alert alert-'.$type.'">'.$message.'</div>';
}
function printMessageIfSet(){
    if(isset($_GET['message'])){
        printMessage($_GET['message'],$_GET['type']);
    }
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
function uploaded($fileName){
    return getUrlFor('assets/'.CONFIG_UPLOADS_FOLDER_NAME.'/'.$fileName);
}
function jsonResponse($status, $responseMessage, $responseData=null){
    header('Content-Type: application/json');
    $response=[
        'status'=>$status,
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
function upload_image($img_old_name=false, $imageInputName):string{
    $uploadDir=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.CONFIG_UPLOADS_FOLDER_NAME.DIRECTORY_SEPARATOR;
    if(isset($_FILES[ $imageInputName ]) && $_FILES[ $imageInputName ]['error']==0){
        $temp_path = $_FILES[$imageInputName]['tmp_name'];
        $img_data = getimagesize($temp_path);
        $img_type=basename($img_data['mime']);
        print_r($img_data);
        if ($img_data and in_array($img_type, CONFIG_ALLOWED_IMAGE_EXTENSIONS)) {
            if(!$img_old_name) {
                $upload_name = $imageInputName.'_' . time() . rand(0, 100000) . '_img.' . $img_type;
                while (file_exists($uploadDir.$upload_name)) {
                    $upload_name = $imageInputName.'_' . time() . rand(0, 100000) . '_img.' . $img_type;
                }
            }else{
                $upload_name=$img_old_name;
            }
            $upload_path=$uploadDir.$upload_name;
            if (!move_uploaded_file($temp_path,$upload_path ))
                \core\InputValidator::appendError($imageInputName, 'Error uploading image');
        } else {
            \core\InputValidator::appendError($imageInputName, 'Only images of types '.implode(',',CONFIG_ALLOWED_IMAGE_EXTENSIONS).' are allowed');
            return false;
        }
    }
    return $upload_name??false;
}

