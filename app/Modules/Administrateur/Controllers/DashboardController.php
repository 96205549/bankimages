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
class DashboardController extends Controller {

     public function initialize() {
        $this->tag->setTitle('Bienvenue');
         // parent::initialize();
        $this->view->setMainView('board');
        //parent::initialize();
    }
    //put your code here
    
    public function indexAction(){
        
          $this->view->pick("pages/dashboard");
    }
    
    public function dashboardAction(){
        
          $this->view->pick("pages/dashboard");
    }
}
