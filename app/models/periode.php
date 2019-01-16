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

class periode extends Model
{
    private  $id;
    private  $taux;
    
    function getId() {
        return $this->id;
    }

    function getTaux() {
        return $this->taux;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTaux($taux) {
        $this->taux = $taux;
    }

    
     public function initialize()
    {
        $this->setSource("periode");
//        $this->hasMany("id","pack","idpack");

    }
}
