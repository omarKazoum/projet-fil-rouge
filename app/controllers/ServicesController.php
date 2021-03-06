<?php
namespace app\controllers;

use app\models\Service;
use app\models\ServiceRequest;
use \core\InputValidator;
use \core\SessionManager;
class ServicesController
{
    public function list()
    {
        $services=null;
        $resultsCount=0;
        switch (\core\SessionManager::getInstance()->getLoggedInUser()->role) {
            case ROLE_TYPE_CUSTOMER:
            case ROLE_TYPE_ADMIN:
                if(isset($_GET['search'])) {
                    $sw=$_GET['search'];
                    $services = Service::query()->where('title','LIKE' ,"%$sw%")->orWhere( 'description','LIKE', "%$sw%")->get();
                }else
                    $services = Service::all();
                break;
            case ROLE_TYPE_COIFFEUR:
                if(isset($_GET['search'])) {
                    $sw=$_GET['search'];
                    $services = Service::all()->where('coiffeur_id', \core\SessionManager::getInstance()->getLoggedInUser()->id)->where('title','LIKE' ,"%$sw%")->orWhere( 'description','LIKE', "%$sw%")->get();
                }else
                    $services = Service::all()->where('coiffeur_id', \core\SessionManager::getInstance()->getLoggedInUser()->id);
        }
        $resultsCount=count($services);
        view('services/services_list',true,['services'=>$services,'resultsCount'=>$resultsCount]);
    }
    public function addForm(){
        view("services/service_form",true,[
            'service_action'=>'add'
        ]);
    }
    public function addSubmit(){
        if(InputValidator::areAllFieldsSet([SERVICE_TITLE_KEY,
            SERVICE_DESCRIPTION_KEY,
            SERVICE_PRICE_KEY,
            SERVICE_CATEGORY_ID_KEY],'POST')
            AND InputValidator::validateServiceTitle($_POST[SERVICE_TITLE_KEY],SERVICE_TITLE_KEY)
            AND InputValidator::validateDescription($_POST[SERVICE_DESCRIPTION_KEY],SERVICE_DESCRIPTION_KEY)
            AND InputValidator::validatePrice($_POST[SERVICE_PRICE_KEY],SERVICE_PRICE_KEY)
            AND InputValidator::validateCategoryId($_POST[SERVICE_CATEGORY_ID_KEY],SERVICE_CATEGORY_ID_KEY)
        ) {
            //everything is ok
                $service = new Service();
                $service->title = $_POST[SERVICE_TITLE_KEY];
                $service->description = $_POST[SERVICE_DESCRIPTION_KEY];
                $service->price = $_POST[SERVICE_PRICE_KEY];
                $service->category_id = $_POST[SERVICE_CATEGORY_ID_KEY];
                $service->coiffeur_id = SessionManager::getInstance()->getLoggedInUser()->id;
                $img_path = upload_image( SERVICE_IMG_KEY,false);
                $service->img = $img_path ? $img_path : PROFILE_IMG_NOT_UPLOADED_KEY;
                $service->save();
                redirect(getBaseUrlWithMessage('/services','Service ajout?? avec Succ??s!','success'));
        }else{
            //something is wrong with the inputs
             view("services/service_form",true,[
                'service_action'=>'add'
            ]);
        }

    }

    /**
     * this function is used to update a service
     * @param $id
     * @return void
     */
    public function updateForm($id){
        $service = Service::find($id);
        $authorized=(SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_COIFFEUR or SessionManager::getInstance()->getLoggedInUser()->role==ROLE_TYPE_ADMIN );
        if(!$service OR !$authorized ){
            redirect(getBaseUrlWithMessage('/services','You are not allowed to update this service','danger'));
        }else view("services/service_form",true,[
            'service_action'=>'update'],['serviceToEdit'=>Service::find($id)]);
    }
    public function updateSubmit(){
        // check that the service id is valid and that the user has permission to do this action
        // check that data is valid then update otherwise redirect to form with some error message
        if(!InputValidator::validateServiceId($_POST[SERVICE_ID_KEY],SERVICE_ID_KEY)) {
            redirect('/services');
        }else if(InputValidator::areAllFieldsSet([SERVICE_TITLE_KEY,
                SERVICE_DESCRIPTION_KEY,
                SERVICE_PRICE_KEY,
                SERVICE_CATEGORY_ID_KEY,
                SERVICE_ID_KEY],'POST')
            AND InputValidator::validateServiceTitle($_POST[SERVICE_TITLE_KEY],SERVICE_TITLE_KEY)
            AND InputValidator::validateDescription($_POST[SERVICE_DESCRIPTION_KEY],SERVICE_DESCRIPTION_KEY)
            AND InputValidator::validatePrice($_POST[SERVICE_PRICE_KEY],SERVICE_PRICE_KEY)
            AND InputValidator::validateCategoryId($_POST[SERVICE_CATEGORY_ID_KEY],SERVICE_CATEGORY_ID_KEY)
            AND ($_FILES[SERVICE_IMG_KEY]['tmp_name']=='' OR InputValidator::validateImageType(SERVICE_IMG_KEY,SERVICE_IMG_KEY)
            )) {
                //everything is ok
                $service=Service::find($_POST[SERVICE_ID_KEY]);
                $service->title = $_POST[SERVICE_TITLE_KEY];
                $service->description = $_POST[SERVICE_DESCRIPTION_KEY];
                $service->price =  $_POST[SERVICE_PRICE_KEY];
                $service->category_id = $_POST[SERVICE_CATEGORY_ID_KEY];
                $service->coiffeur_id = SessionManager::getInstance()->getLoggedInUser()->id;
                $img_path = upload_image( SERVICE_IMG_KEY,$service->img!=PROFILE_IMG_NOT_UPLOADED_KEY?$service->img:false);
                $service->img = $img_path ? $img_path : $service->img;
                $service->save();
                redirect(getBaseUrlWithMessage('/services','Changement bien enregistr??!','success'));
        }else{
            //something is wrong with the inputs
            view("services/service_form",true,[
                'service_action'=>'update'
            ],['serviceToEdit'=>Service::find($_POST[SERVICE_ID_KEY])]);
        }
    }
    public function delete($serviceId){
        // validate that the setvice with that id actually exists
        // and that the user is the owner of the service
        // or is an admin
        $service = Service::find($serviceId);
        $sm= SessionManager::getInstance();
        if(
            $service
            && $sm->isLoggedIn()
            &&( $sm->getLoggedInUser()->role==ROLE_TYPE_ADMIN
            OR $sm->getLoggedInUser()->id==$service->coiffeur_id)
        ){
            $service->delete();
            redirect(getBaseUrlWithMessage('/services','service bien supprim??','success'));
        }else{
            redirect(getBaseUrlWithMessage('/services','action non autoris??','danger'));
        }
    }
    public function reserve(){
        $user =SessionManager::getInstance()->getLoggedInUser();
        $status=0;
        $message="";
        $data=[];
        if($user && $user->role==ROLE_TYPE_CUSTOMER){
            //if connected user is a customer
            if(InputValidator::areAllFieldsSet(['service_id',SERVICE_REQUEST_DATE_KEY,SERVICE_REQUEST_TIME_KEY],'POST') && $service=Service::find($_POST['service_id'])) {
                //if service id is valid;
                $serviceRequest = new ServiceRequest();
                //TODO::check if the time is valid for this barber
                //TODO:: check that this user does not already have a pending request for this service
                $serviceRequest->date = $_POST[SERVICE_REQUEST_DATE_KEY];
                $serviceRequest->time =$_POST[SERVICE_REQUEST_TIME_KEY]; ;
                $serviceRequest->service_id = $service->id;
                $serviceRequest->client_id = $user->id;
                $serviceRequest->status = SERVICE_REQUEST_STATUS_PENDING;
                $serviceRequest->created_at = date('Y-m-d H:i:s');
                $serviceRequest->updated_at = date('Y-m-d H:i:s');
                $serviceRequest->save();
                $status=1;
                $message='Votre r??servation a ??t?? enregistr??e avec succ??s';
                $data['service'] = $service->toArray(true);
            }else{
                $status=0;
                $message= 'service not found';
            }
        }else{
            //if connected user is not a customer
            $status=0;
            $message='unauthorized';
        }
        $data[InputValidator::ERRORS_KEY]=InputValidator::getErrors();
        jsonResponse($status,$message,$data);
    }



}