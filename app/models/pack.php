<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of users
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class pack extends Model
{
    /*
     * declaration des variables
     */

    private $id;
    private $libelle;
    private $prix;
    private $idtype;
    private $idperiode;
    private $idformule;
    private $nbreimage;
    
    
    function getNbreimage() {
        return $this->nbreimage;
    }

    function setNbreimage($nbreimage) {
        $this->nbreimage = $nbreimage;
    }

       
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getPrix() {
        return $this->prix;
    }

    function getIdtype() {
        return $this->idtype;
    }

    function getIdperiode() {
        return $this->idperiode;
    }

    function getIdformule() {
        return $this->idformule;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setIdtype($idtype) {
        $this->idtype = $idtype;
    }

    function setIdperiode($idperiode) {
        $this->idperiode = $idperiode;
    }

    function setIdformule($idformule) {
        $this->idformule = $idformule;
    }

        
    public function initialize()
    {
        $this->setSource("pack");
        $this->belongsTo("idtype","type","id");
        $this->belongsTo("idperiode","periode","id");
        $this->belongsTo("idformule","formule","id");

    }
}
