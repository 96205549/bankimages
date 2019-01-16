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

class formule extends Model
{
    private  $id;
    private  $libelle;
    private  $description;
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    
    public function initialize()
    {
        $this->setSource("formule");
        $this->hasMany("id", "pack","idformule");
        
    }
}
