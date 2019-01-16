<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acheter
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class acheter extends Model {
    private  $idpanier;
    private  $idproduit;
    private  $taille;
    private  $qtecommandee;
    private  $totalvente;
    
    function getIdpanier() {
        return $this->idpanier;
    }

    function getIdproduit() {
        return $this->idproduit;
    }

    function getTaille() {
        return $this->taille;
    }

    function getQtecommandee() {
        return $this->qtecommandee;
    }

    function getTotalvente() {
        return $this->totalvente;
    }

    function setIdpanier($idpanier) {
        $this->idpanier = $idpanier;
    }

    function setIdproduit($idproduit) {
        $this->idproduit = $idproduit;
    }

    function setTaille($taille) {
        $this->taille = $taille;
    }

    function setQtecommandee($qtecommandee) {
        $this->qtecommandee = $qtecommandee;
    }

    function setTotalvente($totalvente) {
        $this->totalvente = $totalvente;
    }

     public function initialize() {
        $this->setSource("acheter");

        $this->belongsTo("idpanier", "panier", "idpanier");
        $this->belongsTo("idproduit", "images", "idimage");
//        $this->hasMany("id", "abonnement", "abonnement_id");
    
    }
}
