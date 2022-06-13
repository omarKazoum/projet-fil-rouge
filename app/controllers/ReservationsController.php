<?php

namespace app\controllers;

use app\models\ServiceRequest;
use core\InputValidator;
use core\SessionManager;

class ReservationsController
{
    public function list()
    {
        view('reservations/list',true,['reservations'=>ServiceRequest::all()]);
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