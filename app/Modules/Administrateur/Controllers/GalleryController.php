<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;

/**
 * Description of GalleryController
 *
 * @author karth solution
 */
class GalleryController extends controller
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

    public function imageAction()
    {
        
        $this->view->pick("pages/gallery");
        //$this->assets->addCss("public/ncss/lightbox.css");
    }
}
