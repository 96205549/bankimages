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

class abonner extends Model
{
    private  $id;
    private  $idpays;
    private  $idclient;
    private  $ville;
    private  $region;
    private  $boitePostale;
   
    function getId() {
        return $this->id;
    }

    function getIdpays() {
        return $this->idpays;
    }

    function getIdclient() {
        return $this->idclient;
    }

    function getVille() {
        return $this->ville;
    }

    function getRegion() {
        return $this->region;
    }

    function getBoitePostale() {
        return $this->boitePostale;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdpays($idpays) {
        $this->idpays = $idpays;
    }

    function setIdclient($idclient) {
        $this->idclient = $idclient;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setRegion($region) {
        $this->region = $region;
    }

    function setBoitePostale($boitePostale) {
        $this->boitePostale = $boitePostale;
    }

            
     public function initialize()
    {
        $this->setSource("pays");
        
        $this->belongsTo("idclient","client","id");
        $this->belongsTo("idpays","pays","id");
    }
}
