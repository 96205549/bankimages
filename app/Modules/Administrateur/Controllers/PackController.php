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
class PackController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //varperiode::initialize();
    }

    //put your code here
    public function newPackAction() {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
                     
                $packs = pack::find(["varpack=:val:", "bind" => ["val" => 0]]);
                $this->view->packs = $packs;       
                
                if ($this->request->isPost()) {
                   $libelle = $this->request->getPost("libelle");
                   $varpack = $this->request->getPost("varpack");
                   
                   
                   $pack= new pack();
                   $pack->libelle=$libelle;
                   $pack->varpack=$varpack;
                   
                   $save=$pack->save();

                   if ($save == TRUE) {
                    $this->flashSession->success("Pack enregistré avec succes");
                    }
                    return $this->response->redirect("admin/pack/allPack");
                }
                $this->view->pick("pages/newPack");
    }

     public function allPackAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        $packs = pack::find();

        $this->view->packs = $packs;
        $this->view->pick("pages/allPack");
    }
}
