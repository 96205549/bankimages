<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ville
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class ville extends Model {

    private $id;
    private $nomVille;
    private $idPays;

    function getId() {
        return $this->id;
    }

    function getNomVille() {
        return $this->nomVille;
    }

    function getIdPays() {
        return $this->idPays;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomVille($nomVille) {
        $this->nomVille = $nomVille;
    }

    function setIdPays($idPays) {
        $this->idPays = $idPays;
    }

    public function initialize() {
        $this->setSource("ville");
        $this->belongsTo("idPays", "pays", "id");
    }

}
