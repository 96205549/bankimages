<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagesController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ImagesController extends controller {

    public function initialize() {

        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-images");
    }

//@todo  how to check if a session is already opened

    public function indexAction() {
        $this->view->pick("pages/freepicture");
    }

    public function detailsAction() {

        $id = $this->request->get('id');

//        $idclient= 
//        die(print_r($id));
        $details = images::findFirstByIdimage($id);
        // die(print_r($id));
        $conditionsP = ['idimg' => $id, "1" => "petite"];
        $image = afriquestock_image::findFirst(paramquery::arrayConditions($conditionsP));
        /*$image = afriquestock_image::findFirst(["idimg=?0 and taille=?1",
                    "bind" => ["0" => $id, "1" => "petite"]]);*/

        $conditionsG = ['idimg' => $id, "1" => "grande"];
        $imageG = images::findFirst(paramquery::arrayConditions($conditionsG));
        $conditionsM = ['idimg' => $id, "1" => "moyenne"];
        $imageM = images::findFirst(paramquery::arrayConditions($conditionsM));


        /* $imageG = afriquestock_image::findFirst(["idimg=?0 and taille=?1",
          "bind" => ["0" => $id, "1" => "grande"]]); */
        /*$imageM = afriquestock_image::findFirst(["idimg=?0 and taille=?1",
                    "bind" => ["0" => $id, "1" => "moyenne"]]);*/
//      die(var_dump($imageG));
        
        $imageInfos = images::findFirstByIdimage($id);
        
        /*$imageInfos = images::findFirstByIdimage(["idimage=?0 ",
                    "bind" => ["0" => $id]]);*/


        $images = afriquestock_image::find(["taille=:val:", "bind" => ["val" => "petite"]]);
        //#6f42c1

        if ($this->session->get("id")) {
            $idclient = $this->session->get("id");
            $date = date("Y-m-d H:i:s");
            $abonnement = abonnement::find(["idclient=:cli: and datefin >:dat:  and actif=1", "bind" => ["cli" => $idclient, "dat" => $date]]);

            $abonnementG = abonnement::findFirst(["idclient=:cli: and datefin >:dat: and type=1 and actif=1", "bind" => ["cli" => $idclient, "dat" => $date]]);
            $abonnementM = abonnement::findFirst(["idclient=:cli: and datefin >:dat: and type=2 and actif=1", "bind" => ["cli" => $idclient, "dat" => $date]]);
            $abonnementP = abonnement::findFirst(["idclient=:cli: and datefin >:dat: and type=3 and actif=1", "bind" => ["cli" => $idclient, "dat" => $date]]);
            $this->view->abonnementG = $abonnementG;
            $this->view->abonnementM = $abonnementM;
            $this->view->abonnementP = $abonnementP;
            $this->view->abonnement = $abonnement;
        } else {
            $this->view->abonnementG = false;
            $this->view->abonnementM = false;
            $this->view->abonnementP = false;
        }


        if ($this->request->isPost()) {

            $produit = $this->request->getPost("produitId");
//            die(print_r($produit));
            $taille = $this->request->getPost("taille");
            $infos = images::findFirstByIdimage($produit);
//            $infos = images::findFirst(["idimage=?0", "bind" => ['0' => $produit]]);
            if (empty($this->session->get('panier'))) {
                $panier = new panier();
                $panier->datecreation = time();
                $data = $panier->save();
                if ($data == true) {
//                    die(var_dump($panier));
                    $this->session->set('panier', $panier->idpanier);
                    $achat = new acheter();
                    $achat->idpanier = $panier->idpanier;
                    $achat->idproduit = $produit;
                    $achat->taille = $taille;
                    $achat->totalvente = $imageInfos->prix;
                    $achat->save();
                }
                $this->response->redirect("images/details?id=" . $produit);
            } else {
                $achat = new acheter();
                $achat->idpanier = $this->session->get('panier');
                $achat->idproduit = $produit;
                $achat->taille = $taille;
                $achat->totalvente = $infos->prix;
//                 die(var_dump($achat));
                $achat->save();
            }
            $this->response->redirect("images/details?id=" . $produit);
        }

        $this->view->categorieId = $id;
        $this->view->images = $images;
        $this->view->image = $image;
        $this->view->imageG = $imageG;
        $this->view->imageM = $imageM;
        $this->view->imageInfos = $imageInfos;
        $this->view->detail = $details;


        $this->view->pick("pages/details-image");
    }

    public function freepictureAction() {
        $categories = categorie::find([
                    "type" => "Gratuit",
                    "order" => "nomCategorie DESC",
                    "limit" => 18,
        ]);

        if ($_GET["page"]) {
            $currentPage = (int) $_GET["page"];
        } else {
            $currentPage = 1;
        }

        $images = images::find();

// Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
                [
            "data" => $images,
            "limit" => 36,
            "page" => $currentPage,
                ]
        );

// Get the paginated results
        $page = $paginator->getPaginate();
        /*
         * fin du code
         */

        $this->view->page = $page;
        $this->view->categories = $categories;
        //$this->view->images = $images;

        $this->view->pick("pages/freepicture");
    }

    public function searchAction() {

        if ($_GET["page"]) {
            $currentPage = (int) $_GET["page"];
        } else {
            $currentPage = 1;
        }

        $keyword = $this->request->get("s");

        $images = images::find(["motcle like :val:", "bind" => ["val" => '%' . $keyword . '%']]);

// Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
                [
            "data" => $images,
            "limit" => 36,
            "page" => $currentPage,
                ]
        );

//        die(var_dump($images));
// Get the paginated results
        $page = $paginator->getPaginate();
        /*
         * fin du code
         */

        $this->view->keyword = ($keyword) ? $keyword : "";
        $this->view->page = $page;

        $this->view->pick("pages/search-results");
    }

    public function allcategorieAction() {

        if ($_GET["page"]) {
            $currentPage = (int) $_GET["page"];
        } else {
            $currentPage = 1;
        }
        $categories = categorie::find([

                    "order" => "nomCategorie DESC",
        ]);


// Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
                [
            "data" => $categories,
            "limit" => 40,
            "page" => $currentPage,
                ]
        );

// Get the paginated results
        $page = $paginator->getPaginate();
        /*
         * fin du code
         */

        $this->view->page = $page;
        $this->view->pick("pages/allcategorie");
    }

    public function categorieAction() {
        $id = $this->request->get('id');

        if ($_GET["page"]) {
            $currentPage = (int) $_GET["page"];
        } else {
            $currentPage = 1;
        }


        $images = images::findByIdcategorie($id);

        $categories = categorie::find([
                    "order" => "nomCategorie DESC",
        ]);



// Create a Model paginator, show 10 rows by page starting from $currentPage
        $paginator = new PaginatorModel(
                [
            "data" => $images,
            "limit" => 36,
            "page" => $currentPage,
                ]
        );

// Get the paginated results
        $page = $paginator->getPaginate();
//        die(var_dump($page));




        $this->view->categories = $categories;
        $this->view->page = $page;
//        $this->view->detail = $detail;
        $this->view->pick("pages/all-categories");
    }

}
