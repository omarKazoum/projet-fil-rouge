<?php

namespace app\controllers;

use app\models\Service;
use app\models\ServiceRequest;
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
    public function reserve($service_id){
        $user =SessionManager::getInstance()->getLoggedInUser();

        if($user->role==ROLE_TYPE_CUSTOMER){
            //if connected user is a customer
            $service=Service::find($service_id);
            if($service){
                $serviceRequest=new ServiceRequest();
                //TODO:: take date and tiemr from the request
                $serviceRequest->date=date('Y-m-d');
                $serviceRequest->time="12:00";
                $serviceRequest->service_id=$service->id;
                $serviceRequest->customer_id=$user->id;
                $serviceRequest->status=SERVICE_REQUEST_STATUS_PENDING;
                jsonResponse(1,'success',['service'=>$service]);
            }else{
                jsonResponse(0,'service not found');
            }
        }else{
            //if connected user is not a customer
            jsonResponse(0,'unauthorized');
        }
    }



}