<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adresse
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class adresse extends Model {

    private $id;
    private $idpays;
    private $ville;
    private $region;
    private $boitePostal;
    private $idclient;

    function getId() {
        return $this->id;
    }

    function getIdpays() {
        return $this->idpays;
    }

    function getVille() {
        return $this->ville;
    }

    function getRegion() {
        return $this->region;
    }

    function getBoitePostal() {
        return $this->boitePostal;
    }

    function getIdclient() {
        return $this->idclient;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdpays($idpays) {
        $this->idpays = $idpays;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setRegion($region) {
        $this->region = $region;
    }

    function setBoitePostal($boitePostal) {
        $this->boitePostal = $boitePostal;
    }

    function setIdclient($idclient) {
        $this->idclient = $idclient;
    }

    public function initialize() {
        $this->setSource("adresse");

//        $this->belongsTo("id", "abonnement", "abonnement_id");
        $this->belongsTo("idclient", "client", "id");
    }

}
