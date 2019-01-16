<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of becomeContributor
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class BecomeController extends controller{
    
    
    public function initialize() {
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-become");
    }
    //put your code here

     public function indexAction(){
        
        $this->view->pick("pages/become-contributor");
    }
}
