<?php

namespace app\controllers;

use app\models\Service;
use app\models\ServiceRequest;
use core\InputValidator;
use core\SessionManager;

class ServicesController
{
    public function list()
    {

        view('services/services_list',true,[
            'services'=>Service::all()
        ]);
    }
    public function addForm(){
        view("services/service_form",true,[
            'service_action'=>'add'
        ]);
    }
    public function addSubmit(){

    }
    public function updateForm(){
        view("services/service_form",true,[
            'service_action'=>'update']);
    }
    public function updateSubmit(){
        echo "form submitted";
    }
    public function delete(){
        echo "delete";
    }
    public function reserve(){
        $user =SessionManager::getInstance()->getLoggedInUser();
        $status=0;
        $message="";
        $data=[];
        if($user->role==ROLE_TYPE_CUSTOMER){
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
                $message='Votre réservation a été enregistrée avec succès';
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
        $data[InputValidator::$ERRORS_ARRAY_KEY]=InputValidator::getErrors();
        jsonResponse($status,$message,$data);
    }



}