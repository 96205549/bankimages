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

class type extends Model
{
    /*
     * declaration des variables
     */

    private $id;
    private $libelletype;
    private $description;
    
   
    function getId() {
        return $this->id;
    }

    function getLibelletype() {
        return $this->libelletype;
    }

    function getDescription() {
        return $this->description;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setLibelletype($libelletype) {
        $this->libelletype = $libelletype;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    
         

    public function initialize()
    {
        $this->setSource("type");
//        $this->hasMany("id","pack","id");
    }
}
