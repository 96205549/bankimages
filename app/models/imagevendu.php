<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imagevendu
 * 62482122 judite
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class imagevendu extends Model {

    private $id;
    private $idproduit;
    private $idphotographe;
    private $taille;
    private $prix;
    private $date;
    
    
    function getTaille() {
        return $this->taille;
    }

    function setTaille($taille) {
        $this->taille = $taille;
    }

        function getId() {
        return $this->id;
    }

    function getIdproduit() {
        return $this->idproduit;
    }

    function getIdphotographe() {
        return $this->idphotographe;
    }

    function getPrix() {
        return $this->prix;
    }

    function getDate() {
        return $this->date;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdproduit($idproduit) {
        $this->idproduit = $idproduit;
    }

    function setIdphotographe($idphotographe) {
        $this->idphotographe = $idphotographe;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setDate($date) {
        $this->date = $date;
    }

    
    
    public function initialize()
    {
        $this->setSource("imagevendu");

       /*
        * relation avec la table image
        */
        $this->belongsTo("idproduit", "images", "idimage");
        /*
         * relation avec la table photographe
         */
        $this->belongsTo("idphotographe", "client", "id");
    }
}
