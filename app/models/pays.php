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

class pays extends Model
{
    private  $id;
    private  $nompays;
   
    
    function getId() {
        return $this->id;
    }

    function getNompays() {
        return $this->nompays;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNompays($nompays) {
        $this->nompays = $nompays;
    }

        
     public function initialize()
    {
        $this->setSource("pays");
        $this->hasMany("id","client","id_client");
        $this->hasMany("id","ville","idPays");
       
    }
}
