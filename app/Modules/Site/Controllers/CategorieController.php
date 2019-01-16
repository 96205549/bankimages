<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategorieController
 *
 * @author karth solution
 */

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;



class CategorieController extends controller
{
     public function initialize() {

         if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        }else{
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-categorie");
    }

//@todo  how to check if a session is already opened

    public function indexAction() {
//     die(print_r("yes"));
        
        
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
            "limit" => 100,
            "page" => $currentPage,
            ]
        );

// Get the paginated results
        $page = $paginator->getPaginate();
        /*
         * fin du code
         */

        $this->view->page = $page;
//        $this->view->pick("pages/allcategorie");
        
        
        $this->view->pick("pages/categorie-images");
    }
}
