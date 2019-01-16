<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of abonnement
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class abonnement extends Model {

    private $id;
    private $datedeb;
    private $datefin;
    private $idclient;
    private $idpack;
    private $type;
    private $idtransaction;
    private $actif;
    
    
    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    
    function getIdtransaction() {
        return $this->idtransaction;
    }

    function getActif() {
        return $this->actif;
    }

    function setIdtransaction($idtransaction) {
        $this->idtransaction = $idtransaction;
    }

    function setActif($actif) {
        $this->actif = $actif;
    }

    function getId() {
        return $this->id;
    }

    function getDatedeb() {
        return $this->datedeb;
    }

    function getDatefin() {
        return $this->datefin;
    }

    function getIdclient() {
        return $this->idclient;
    }

    function getIdpack() {
        return $this->idpack;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDatedeb($datedeb) {
        $this->datedeb = $datedeb;
    }

    function setDatefin($datefin) {
        $this->datefin = $datefin;
    }

    function setIdclient($idclient) {
        $this->idclient = $idclient;
    }

    function setIdpack($idpack) {
        $this->idpack = $idpack;
    }

    public function initialize() {
        $this->setSource("abonnement");

        $this->belongsTo("idclient", "client", "id");
        $this->belongsTo("idpack", "pack", "id");
        $this->belongsTo("type", "type", "id");
    }

}
