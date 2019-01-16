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
class PeriodeController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //varperiode::initialize();
    }

    //put your code here
    public function newPeriodeAction() {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
                
                
                $periodes = periode::find(["varperiode=:val:", "bind" => ["val" => 0]]);
                $this->view->periodes = $periodes;       
                
                if ($this->request->isPost()) {
                   $libellePeriode = $this->request->getPost("libellePeriode");
                   $varperiode = $this->request->getPost("varperiode");
                   
                   
                   $periode= new periode();
                   $periode->libellePeriode=$libellePeriode;
                   $periode->varperiode=$varperiode;
                   
                   $save=$periode->save();

                   if ($save == TRUE) {
                    $this->flashSession->success("Periode enegistrée avec succes");
                    }
                    return $this->response->redirect("admin/periode/allPeriode");
                }
                $this->view->pick("pages/newPeriode");
    }

     public function allPeriodeAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");
        $periodes = periode::find();

        $this->view->periodes = $periodes;
        $this->view->pick("pages/allPeriode");
    }
}
