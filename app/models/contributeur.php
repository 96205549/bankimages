<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of abonnee
 *
 * @author karth solution
 */

use Phalcon\Mvc\Model;

class abonne extends Model
{
    private  $id;
    private  $idClient;
    private  $idAbonnement;
    private  $Datedeb;
    private  $Datefin;
    
    function getId() {
        return $this->id;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getIdAbonnement() {
        return $this->idAbonnement;
    }

    function getDatedeb() {
        return $this->Datedeb;
    }

    function getDatefin() {
        return $this->Datefin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    function setIdAbonnement($idAbonnement) {
        $this->idAbonnement = $idAbonnement;
    }

    function setDatedeb($Datedeb) {
        $this->Datedeb = $Datedeb;
    }

    function setDatefin($Datefin) {
        $this->Datefin = $Datefin;
    }

     public function initialize()
    {
        $this->setSource("abonne");
        $this->belongsTo("client_id", "client","id");
        $this->belongsTo("abonnement_id","abonnement","id");

    }
}
