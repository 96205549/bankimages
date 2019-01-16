<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of panier
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class panier extends Model {

    private $idpanier;
    private $datecreation;
    private $totalcommande;
    private $identiteclient;
    private $adresseclient;
    private $telclient;
    private $adressefacture;
    private $dateupdate;

    function getIdpanier() {
        return $this->idpanier;
    }

    function getDatecreation() {
        return $this->datecreation;
    }

    function getTotalcommande() {
        return $this->totalcommande;
    }

    function getIdentiteclient() {
        return $this->identiteclient;
    }

    function getAdresseclient() {
        return $this->adresseclient;
    }

    function getTelclient() {
        return $this->telclient;
    }

    function getAdressefacture() {
        return $this->adressefacture;
    }

    function getDateupdate() {
        return $this->dateupdate;
    }

    function setIdpanier($idpanier) {
        $this->idpanier = $idpanier;
    }

    function setDatecreation($datecreation) {
        $this->datecreation = $datecreation;
    }

    function setTotalcommande($totalcommande) {
        $this->totalcommande = $totalcommande;
    }

    function setIdentiteclient($identiteclient) {
        $this->identiteclient = $identiteclient;
    }

    function setAdresseclient($adresseclient) {
        $this->adresseclient = $adresseclient;
    }

    function setTelclient($telclient) {
        $this->telclient = $telclient;
    }

    function setAdressefacture($adressefacture) {
        $this->adressefacture = $adressefacture;
    }

    function setDateupdate($dateupdate) {
        $this->dateupdate = $dateupdate;
    }

    public function initialize() {
        $this->setSource("panier");

//        $this->belongsTo("identite", "pays", "id");
//        $this->hasMany("id", "abonnement", "abonnement_id");
    
    }

}
