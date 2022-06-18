<?php

namespace app\controllers;

use app\models\Category;
use app\models\ServiceRequest;
use core\InputValidator;
use core\SessionManager;

class CategoriesController
{

    public function index()
    {
        $resultsCount=0;
        $categories=null;
        if(isset($_GET['search'])) {
            $sw=$_GET['search'];
            $categories = Category::query()->where('title','LIKE' ,"%$sw%")->get();
        }else
            $categories = Category::all();
        $resultsCount=count($categories);
        view('categories/list',true,['categories'=>$categories]);
    }
    function save()
    {
        $sm =SessionManager::getInstance();
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        if($sm->isLoggedIn() && $role==ROLE_TYPE_ADMIN && InputValidator::validateCategoryTitle($_POST[CATEGORY_TITLE_KEY],CATEGORY_TITLE_KEY)){
            $category = new Category();
            $category->title = $_POST[CATEGORY_TITLE_KEY];
            $category->save();
           redirect('categories');
        }else{
            redirect(getBaseUrlWithMessage('categories',implode('',InputValidator::getErrors()),'danger'));
        }

    }
    function update()
    {

       $sm =SessionManager::getInstance();
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        $category= Category::find($_POST[CATEGORY_ID_KEY]);
        if($category && $sm->isLoggedIn() && $role==ROLE_TYPE_ADMIN && InputValidator::validateCategoryTitle($_POST[CATEGORY_TITLE_KEY],CATEGORY_TITLE_KEY)){
            $category->title = $_POST[CATEGORY_TITLE_KEY];
            $category->save();
            redirect(getBaseUrlWithMessage('categories',"categorie changé avec Succès",'success'));
        }else{
            redirect(getBaseUrlWithMessage('categories',implode('',InputValidator::getErrors()),'danger'));
        }
    }
    function delete($categoryId)
    {
        $sm =SessionManager::getInstance();
        $role=$sm->isLoggedIn() ?$sm->getLoggedInUser()->role:0;
        $category=Category::find($categoryId);
        if($sm->isLoggedIn() && $category &&
            ($role==ROLE_TYPE_ADMIN
                AND $category->services->count()<1)
        ){
            $category->delete();
            $status=1;
            $message='catégorie supprimée avec succès';
            jsonResponse($status,$message);
        }else{
            $message='Impossible de supprimer la catégorie';
            $status=0;
            jsonResponse($status,$message);
        }
    }

    /**
     * ajouter une categorie
     */
    function add(){

    }

}