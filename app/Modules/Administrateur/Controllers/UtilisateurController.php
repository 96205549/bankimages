<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;
/**
 * Description of UserController
 *
 * @author karth solution
 */
class UtilisateurController extends Controller
{
    public function initialize() {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }
    
    public function indexAction(){
        
    }
    public function nouveauAction(){
        
    }
    public function listeAction(){
        
    }
    public function profileAction(){
        
        $this->assets->addCss("public/css/avatar.css");
        
        
        
        
        $this->assets->addJs("public/js/off-canvas.js");
        $this->assets->addJs("public/js/misc.js");
        $this->assets->addJs("public/js/jquery-3.2.1.min.js");
        $this->assets->addJs("public/js/fileinput.js");
        $this->assets->addJs("public/js/popper.min.js");
        $this->assets->addJs("public/js/avatar.js");
    }
}
