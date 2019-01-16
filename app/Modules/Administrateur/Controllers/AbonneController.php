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
class AbonneController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    public function indexAction()
    {
        $this->view->pick("pages/inscrit");
    }

    public function nouveauAction()
    {
        
    }

    public function listeAction()
    {
        
    }

    public function inscritAction()
    {
        $abonne = abonne::find(["contributeur=:val:","bind"=>["val"=>"0"]]);
        $this->view->abonnes = $abonne;
        $this->view->pick("pages/inscrit");
    }
    
    public function contributeurAction()
    {
        $abonne = abonne::find(["contributeur=:val:","bind"=>["val"=>"1"]]);
        $this->view->abonnes = $abonne;
        $this->view->pick("pages/contributeur");
    }
}
