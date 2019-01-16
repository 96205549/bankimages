<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbonnementController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class AbonnementController extends Controller {

    public function initialize() {
        $this->tag->setTitle("banque d'image");

        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-account");
    }

    public function indexAction() {

        $formules = formule::find();

        $packs = pack::find();

        $this->view->packs = $packs;
        $this->view->formules = $formules;



        $this->view->pick("pages/tarif");
    }

    public function souscrireAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");
        if ($this->request->isPost()) {
//            $formule = $this->request->getPost("formule");
            $pack = $this->request->getPost("pack");

            $checkAbonnement = abonnement::findFirst(["idclient=?0 and datefin >?1 and idpack=?2 and actif=1",
                "bind" => ["0" => $idclient, "1" => date("Y-m-d"), "2" => $pack]]);
//            die(var_dump($checkAbonnement));
            if ($checkAbonnement == true) {
                $this->flashSession->warning("Oups! vous etes souscrit a cet abonnement deja, et l abonnement est toujours en cour... ");
                return $this->response->redirect("abonnement/");
            } else {

                $dataPack = pack::findFirst($pack);


                $this->view->pack= $dataPack;
            }
        }
        $this->view->pick("pages/souscrire");
    }

    public function abonneAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");
        if ($this->request->isPost()) {
            $formule = $this->request->getPost("formule");
            $pack = $this->request->getPost("pack");
            $ID = $this->request->getPost("transaction-id");
            $statut = $this->request->getPost("transaction-status");

//            $checkAbonnement = abonnement::findFirst(["idclient=?0 and datefin >?1 order by id desc", "bind" => ["0" => $idclient, "1" => date("Y-m-d")]]);
////            die(var_dump($checkAbonnement));
//            if ($checkAbonnement == true) {
//                $this->flashSession->warning("Oups! vous avez un abonnement en cour... ");
//            } else {
            if ($statut == "approved") {
            
            
                $dataPack = pack::findFirst($pack);

                $periode = $dataPack->periode->taux;
                if ($periode == "Mensuel") {
                    $timo = strtotime("+ 1 month", strtotime(date("Y-m-d")));
                    $datefin = date("Y-m-d H:i:s", $timo);
                }
//                die(print_r($datefin));
                $abonnement = new abonnement();

                $abonnement->datedeb = date("Y-m-d H:i:s");
                $abonnement->datefin = $datefin;
                $abonnement->idclient = $idclient;
                $abonnement->idpack = $pack;
                $abonnement->transaction = $ID;
                $abonnement->actif = "1";
                $abonne = $abonnement->save();

                if ($abonne == true) {
                    $this->flashSession->success("Bravo! vous etes abonne au pack ");
                } else {
                    $this->flashSession->success("Desolez! vous ne pouvez vous abonnez a ce pack ");
                }
            }elseif($statut == "canceled"){
                $this->flashSession->error("Echec de la transaction  veuillez ressayer");
            }
        }
                $this->response->redirect("abonnement/");

    }

}
