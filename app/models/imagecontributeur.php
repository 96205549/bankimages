<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of imagecontributeur
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class imagecontributeur extends Model {

    private $id;
    private $image;
    private $idClient;
    private $description;
    private $motcle;
    private $categorie;
    private $date;
    private $validite;
    private $archiver;

    function getCategorie() {
        return $this->categorie;
    }

    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    function getArchiver() {
        return $this->archiver;
    }

    function setArchiver($archiver) {
        $this->archiver = $archiver;
    }

    function getDescription() {
        return $this->description;
    }

    function getMotcle() {
        return $this->motcle;
    }

    function getDate() {
        return $this->date;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setMotcle($motcle) {
        $this->motcle = $motcle;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function getId() {
        return $this->id;
    }

    function getImage() {
        return $this->image;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getValidite() {
        return $this->validite;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    function setValidite($validite) {
        $this->validite = $validite;
    }

    public function initialize() {
        $this->setSource("imagecontributeur");

        $this->belongsTo("idClient", "client", "id");
        $this->belongsTo("categorie", "categorie", "idCat");
//        $this->hasMany("id", "abonnement", "abonnement_id");
//        $this->hasMany("id", "adresse", "idclient");
    }

}
