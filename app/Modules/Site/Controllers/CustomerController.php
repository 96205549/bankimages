<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customerController
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CustomerController extends controller {

    public function initialize() {
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-contributor");
    }

    public function indexAction() {

        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }

        $idclient = $this->session->get("id");

        /*
         * donnée du client connecté
         */
        $client = client::findFirst($idclient);

//        die(var_dump($client));

//        /*
//         * images envoyé
//         */
//        $images = imagecontributeur::find(["idClient=:val: and validite=:validi:",
//                    "bind" => ["val" => $idclient, "validi" => 0]]);
//        /*
//         * images validé
//         */
//        $attentes = imagecontributeur::find(["idClient=:val: and validite=:validi:",
//                    "bind" => ["val" => $idclient, "validi" => 1]]);
//        /*
//         * images validé
//         */
//        $valides = imagecontributeur::find(["idClient=:val: and validite=:validi:",
//                    "bind" => ["val" => $idclient, "validi" => 2]]);
//        /*
//         * images rejeté
//         */
//        $rejetes = imagecontributeur::find(["idClient=:val: and validite=:validi:",
//                    "bind" => ["val" => $idclient, "validi" => -1]]);
        /*
         * image vendu
         */
        $ventes = imagevendu::find(["idphotographe=:photo:",
                    "bind" => ["photo" => $idclient]]);

        $abonnements= abonnement::find(["idclient=:cli:", "bind"=>["cli"=>$idclient]]);
                
        $categories = categorie::find();

        $this->view->client = $client;
        $this->view->abonnements = $abonnements;

        $this->view->ventes = $ventes;
        $this->view->categories = $categories;

        $this->view->pick("pages/space-customer");
    }

    public function profileAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");
        if ($this->request->isPost()) {

            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $email = $this->request->getPost("email");

            $client = client::findFirst($idclient);
            $client->nom = $nom;
            $client->prenom = $prenom;
            $client->email = $email;
            $client->update();

            $this->response->redirect("customer/");
        }
    }

    public function changpassAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");

        if ($this->request->isPost()) {

//            $oldPass= $this->request->getPost("oldpass");
            $newpass = $this->request->getPost("newpass");
            $confirm = $this->request->getPost("confirm");

            if ($confirm == $newpass) {

                $client = client::findFirst($idclient);

//            if($client->password == sha1($oldPass)){
                $client->password = sha1($newpass);
                $up = $client->update();

                if ($up == true) {
                    $this->flashSession->success("modification du mot de passe effectuer avec succes");
                } else {
                    $this->flashSession->error("Echec, veuillez ressayer");
                }
            }
            $this->response->redirect("customer/");
        }
    }

}
