<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payer
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class payer extends Model{
    private $id;
    private $codetransaction;
    private $montant;
    private $datepaiement;
    private $idclient;
    
    function getId() {
        return $this->id;
    }

    function getCodetransaction() {
        return $this->codetransaction;
    }

    function getMontant() {
        return $this->montant;
    }

    function getDatepaiement() {
        return $this->datepaiement;
    }

    function getIdclient() {
        return $this->idclient;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodetransaction($codetransaction) {
        $this->codetransaction = $codetransaction;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setDatepaiement($datepaiement) {
        $this->datepaiement = $datepaiement;
    }

    function setIdclient($idclient) {
        $this->idclient = $idclient;
    }
    
    
     public function initialize() {
        $this->setSource("payer");

        $this->belongsTo("idclient", "client", "id");

    
    }


}
