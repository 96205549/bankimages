<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShoppingController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use FedaPay\FedaPay;

class ShoppingController extends controller {

    public function initialize() {
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-panier");
    }

//@todo  how to check if a session is already opened

    public function indexAction() {
//     die(print_r("yes"));
        $this->view->pick("pages/cart");
    }

    public function cartAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
//        $imageID = $this->request->get("imageID");

        if (empty($this->session->get("idpanier"))) {
            $panier = new panier();
            $panier->datecreation = time();
            $data = $panier->save();
            if ($data == true) {
                $this->session->set("idpanier", $panier->idpanier);
            }
        } else {
//            die(print_r($this->session->get("idpanier")));
            if ($this->request->isPost()) {
//                die(print_r("yes"));
                $produit = $this->request->getPost("produitId");
                $taille = $this->request->getPost("taille");
//                die(print_r($produit));
                $image = images::findFirstByIdimage($produit);
//                die(var_dump($image));
                if ($taille == "grande") {
                    $prix = $image->prixG;
                } elseif ($taille == "moyenne") {
                    $prix = $image->prixM;
                } elseif ($taille == "petite") {
                    $prix = $image->prixP;
                }
//            die(var_dump($image));

                $acheter = new acheter();
                $acheter->idpanier = $this->session->get("idpanier");
                $acheter->idproduit = $image->idimage;
                $acheter->taille = $taille;
                $acheter->qtecommandee = "1";
                $acheter->totalvente = $prix;
//                die(var_dump($acheter));
                $result = $acheter->save();

                if ($result == true) {
                    $this->response->redirect("images/details?id=" . $image->idimage);
                }
            }
        }
        $this->view->pick("pages/cart");
    }

    public function dropAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
//        if ($this->request->isPost()) {
        $code = $this->request->get("code");
        $result = explode("_", $code);

        $idpanier = $result[0];
        $idproduit = $result[1];

        $achat = acheter::findFirst(["idpanier=?0 and idproduit=?1",
                    "bind" => ["0" => $idpanier, "1" => $idproduit]]);
        if ($achat == true) {
            $achat->delete();
            $this->response->redirect("shopping/cart");
        }
        $this->response->redirect("shopping/cart");
        $this->view->pick("pages/cart");
    }

    public function checkoutAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        if ($this->request->isPost()) {

//            die(print_r($_POST, true));
//            $montant= $this->request->getPost("amount");
//      $fedapay = new FedaPay();
//            $key= FedaPay::setApiKey("pk_live_wEykyHglqqVjpcy7NeeFZpgG");

            /* Précisez si vous souhaitez exécuter votre requête en mode test ou live */
//           $environnement= FedaPay::setEnvironment('sandbox'); //ou setEnvironment('live');
//  \FedaPay\FedaPay::setEnvironment('sandbox'); //ou setEnvironment('live');

            /* Créer la transaction */
//            \FedaPay\Transaction::create(array(
//                "description" => "Transaction for john.doe@example.com",
//                "amount" => 2000,
//                "currency" => ["iso" => "XOF"],
//                "callback_url" => "https://maplateforme.com/callback",
//                "customer" => [
//                    "firstname" => "John",
//                    "lastname" => "Doe",
//                    "email" => "john.doe@example.com",
//                    "phone_number" => [
//                        "number" => "+22997808080",
//                        "country" => "bj"
//                    ]
//                ]
//            ));
        }
        $this->view->pick("pages/checkout");
    }

    public function transactionAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        if ($this->request->isPost()) {
            $ID = $this->request->getPost("transaction-id");
            $statut = $this->request->getPost("transaction-status");
            $montant = $this->request->getPost("montant");
            $produits = $this->request->getPost("produit");
            $prix = $this->request->getPost("prix");
             $idpanier = $this->session->get("idpanier");
            $tailles = $this->request->getPost("taille");
//            die(var_dump($_POST));

          
            if ($statut == "approved") {

                $idclient = $this->session->get("id");
                $payer = new payer();
                $payer->codetransaction = $ID;
                $payer->montant = $montant;
                $payer->datepaiement = date("d-m-Y H:i:s");
                $payer->idclient = $idclient;
                $payer->save();
                
                /*
                 * mise à jour du panier
                 */
                $panier= panier::findFirst($idpanier);
                $panier->totalcommande=$montant;
                $panier->identiteclient=$idclient;
                $panier->dateupdate=date("d-m-Y H:i:s");
                $panier->update();
                
                

                foreach ($produits as $key => $idproduit):
                    /*
                     * ajouter la vente chez le contributeur
                     */
                    $vente = new imagevendu();
                    $vente->idproduit = $idproduit;
                    $vente->idphotographe = $idclient;
                    $vente->taille = $tailles[$key];
                    $vente->prix = ($prix[$key] * 0.15);
                    $vente->date = date("d-m-Y H:i:s");
                    $vente->save();
                    
                    /*
                     * supprimer le panier en cour
                     */
                   

                    $achat = acheter::findFirst(["idpanier=?0 and idproduit=?1", "bind" => ["0" => $idpanier, "1" => $idproduit]]);
                    if($achat == TRUE) {
                        $achat->delete();
                    }

                endforeach;

                $this->flashSession->success("Transaction effectue avec success, vous pouvez telecharger a present l image");
                $this->session->set('produits',$produits) ;
                $this->session->set('tailles',$tailles);
//                
                return $this->response->redirect("shopping/download");
//                $this->view->tailles = $tailles;
//                $this->view->produits = $produits;
//                $this->view->tailles = $tailles;
            } elseif ($statut == "canceled") {
                $this->flashSession->error("Echec de la transaction  veuillez ressayer");
                return $this->response->redirect("shopping/checkout");
            }
//            $this->view->pick("pages/payement");
            
        }
    }
    
    public function downloadAction(){
         if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        
        $produits= $this->session->get('produits');
        $tailles= $this->session->get('tailles');
        
        $this->view->produits = $produits;
        $this->view->tailles = $tailles;
        
        $this->view->pick("pages/payement");
        
    }

}
