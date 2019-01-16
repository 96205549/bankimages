<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of access
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class access extends Model
{

    //put your code here

    private $id;
    private $description;
    private $keyword;
    private $date_at;
    private $date_up;
    private $statut;

    /*
     * declaration des getters 
     */

    function getId()
    {
        return $this->id;
    }


    function getDescription()
    {
        return $this->description;
    }

    function getKeyword()
    {
        return $this->keyword;
    }

    function getDate_at()
    {
        return $this->date_at;
    }

    function getDate_up()
    {
        return $this->date_up;
    }

    function getStatut()
    {
        return $this->statut;
    }
    /*
     * declaration des setters
     */

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    function setDate_at($date_at)
    {
        $this->date_at = $date_at;
    }

    function setDate_up($date_up)
    {
        $this->date_up = $date_up;
    }

    function setStatut($statut)
    {
        $this->statut = $statut;
    }
    /*
     * gestion des relations
     */

    public function initialize()
    {
        $this->setSource("access");

        $this->hasMany("id", "user_access", "idaccess");
    }
}
