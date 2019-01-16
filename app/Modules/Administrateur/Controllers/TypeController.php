<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller;
use  Phalcon\Mvc\Model;

/**
 * Description of DashboardController
 *
 * @author karth solution
 */
class TypeController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //vartype::initialize();
    }

    //put your code here
    public function newTypeAction() {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        $this->view->pick("pages/newType");


                $types = type::find(["vartype=:val:", "bind" => ["val" => 0]]);
                $this->view->types = $types;       
                
                if ($this->request->isPost()) {
                   $libelletype = $this->request->getPost("libelletype");
                   $description = $this->request->getPost("description");
                   $vartype = $this->request->getPost("vartype");
                   
                   
                   $type= new type();
                   $type->libelletype=$libelletype;
                   $type->description=$description;
                   $type->vartype=$vartype;
                   
                   $sav=$type->save();

                   if ($sav == TRUE) {
                    $this->flashSession->success("Type enregistré avec succes");
                    }
                    return $this->response->redirect("admin/type/allType");
                }
    }

     public function allTypeAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        $types = type::find();

        $this->view->types = $types;
        $this->view->pick("pages/allType");
    }
}
