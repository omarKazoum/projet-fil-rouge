<?php

namespace app\controllers;

use app\models\Service;
use app\models\ServiceRequest;
use core\InputValidator;
use core\SessionManager;
use Illuminate\Support\Facades\DB;

class ReservationsController
{
    public function list()
    {
        $reservations=ServiceRequest::all();
        $user=SessionManager::getInstance()->getLoggedInUser();
        switch($user->role){
            case ROLE_TYPE_ADMIN:
                $reservations=ServiceRequest::all();
                break;
            case ROLE_TYPE_COIFFEUR:
                $services=Service::where('coiffeur_id',$user->id)->get();
                $serviceIds=[];
                foreach($services as $service){
                    $serviceIds[]=$service->id;
                }
                $reservations=ServiceRequest::query()->whereIn('service_id',$serviceIds)->get();
                break;
            case ROLE_TYPE_CUSTOMER:
                $reservations=ServiceRequest::all()->where('client_id',$user->id);
                break;
        }
        view('reservations/list',true,['reservations'=>$reservations]);
    }
    public function cancel($service_request_id)
    {
        $sm =SessionManager::getInstance();
        $status=0;
        $message='';
        //TODO::cancel reservation
        $service_request = ServiceRequest::find($service_request_id);
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        if($sm->isLoggedIn() && $service_request &&
            (
                ($role==ROLE_TYPE_ADMIN
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_CANCELED
                ) OR
                ($role ==ROLE_TYPE_CUSTOMER
                    AND $service_request->client_id==$sm->getLoggedInUser()->id
                    AND $service_request->status==SERVICE_REQUEST_STATUS_PENDING
                )
            )
            ){
            $service_request->status=SERVICE_REQUEST_STATUS_CANCELED;
            $service_request->save();
            $status=1;
            $message='Réservation annulée avec succès';
            jsonResponse($status,$message,$service_request);
        }else{
            $message='Impossible d\'annuler la réservation';
            $status=0;
            jsonResponse($status,$message);
        }
    }
    public function confirm($service_request_id)
    {
        $sm =SessionManager::getInstance();
        $service_request = ServiceRequest::find($service_request_id);
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        if($sm->isLoggedIn() && $service_request &&
            (
                ($role==ROLE_TYPE_ADMIN
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_ACCEPTED
                ) OR
                ($role ==ROLE_TYPE_COIFFEUR
                    AND $service_request->service->coiffeur_id==$sm->getLoggedInUser()->id
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_ACCEPTED
                )
            )
        ){
            $service_request->status=SERVICE_REQUEST_STATUS_ACCEPTED;
            $service_request->save();
            $status=1;
            $message='Réservation accepté avec succès';
            jsonResponse($status,$message,$service_request);
        }else{
            $message='Impossible d\'accepter la réservation';
            $status=0;
            jsonResponse($status,$message);
        }
    }
    public function reject($service_request_id)
    {
        $sm =SessionManager::getInstance();
        $service_request = ServiceRequest::find($service_request_id);
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        if($sm->isLoggedIn() && $service_request &&
            (
                ($role==ROLE_TYPE_ADMIN
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_REJECTED
                ) OR
                ($role ==ROLE_TYPE_COIFFEUR
                    AND $service_request->service->coiffeur_id==$sm->getLoggedInUser()->id
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_PENDING
                )
            )
        ){
            $service_request->status=SERVICE_REQUEST_STATUS_REJECTED;
            $service_request->save();
            $status=1;
            $message='Réservation refusé avec succès';
            jsonResponse($status,$message,$service_request);
        }else{
            $message='Impossible de refuser la réservation';
            $status=0;
            jsonResponse($status,$message);
        }
    }
    public function pend($service_request_id)
    {
        $sm =SessionManager::getInstance();
        $service_request = ServiceRequest::find($service_request_id);
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        if($sm->isLoggedIn() && $service_request &&
            ($role==ROLE_TYPE_ADMIN
                    AND $service_request->status!=SERVICE_REQUEST_STATUS_PENDING
            )
        ){
            $service_request->status=SERVICE_REQUEST_STATUS_PENDING;
            $service_request->save();
            $status=1;
            $message='Réservation est désormais en attente';
            jsonResponse($status,$message,$service_request);
        }else{
            $message='Impossible de mettre cette réservation en attente la réservation';
            $status=0;
            jsonResponse($status,$message);
        }
    }
}