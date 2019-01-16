<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;

/**
 * Description of DashboardController
 *
 * @author karth solution
 */
class AbonnementController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    //put your code here
    
     public function indexAction()
    {
        
    }

    public function formuleAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        
      
        $formules = formule::find();
        $this->view->formules = $formules;
        $packs = pack::find();
        $this->view->packs = $packs;
        $types = type::find();
        $this->view->types = $types;
        $periodes = periode::find();
        $this->view->periodes = $periodes;
       
        
        
        if ($this->request->isPost()) {
            $libelle = $this->request->getPost("libelle");
            $description = $this->request->getPost("description");
           
         
                $formule = new formule();
                $formule->libelle = $libelle;
                $formule->description = $description;
              
//                die(var_dump($formule));
                $save = $formule->save();
               // die(var_dump($newCategorie));
                if ($save == TRUE) {
                   // die(print_r($nomCat));
                    $this->flashSession->success("Abonnement enregistre avec succes");
                }
            return $this->response->redirect("admin/abonnement/formule");
        }
                $this->view->pick("pages/formule");
    }
        
    public function packAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        
      
        
        
        
        if ($this->request->isPost()) {
            $libelle = $this->request->getPost("libelle");
            $prix = $this->request->getPost("prix");
            $idtype = $this->request->getPost("idtype");
            $idperiode = $this->request->getPost("idperiode");
            $idformule = $this->request->getPost("idformule");
            
            

              
                $pack = new pack();
                $pack->libelle = $libelle;
                $pack->prix = $prix;
                $pack->idtype = $idtype;
                $pack->idperiode = $idperiode;
                $pack->idformule = $idformule;
                
//                                die(var_dump($pack));

                $save = $pack->save();
                if ($save == TRUE) {
                   // die(print_r($nomCat));
                    $this->flashSession->success("Abonnement enregistre avec succes");
                }
            return $this->response->redirect("admin/abonnement/formule");
        }
                $this->view->pick("pages/formule");
    }
   
}
