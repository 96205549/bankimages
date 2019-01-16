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

class categorie extends Model
{
    /*
     * declaration des variables
     */

    private $id;
    private $idCat;
    private $nomCategorie;
    private $parent;
    private $iduser;
    private $dateat;
    private $dateup;
    private $statut;
    
    
    
    function getIdCat()
    {
        return $this->idCat;
    }

    function setIdCat($idCat)
    {
        $this->idCat = $idCat;
    }

        
    
 

        
  

    function getId()
    {
        return $this->id;
    }

    function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    function getParent()
    {
        return $this->parent;
    }

    function getIduser()
    {
        return $this->iduser;
    }

    function getDateat()
    {
        return $this->dateat;
    }

    function getDateup()
    {
        return $this->dateup;
    }

    function getStatut()
    {
        return $this->statut;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;
    }

    function setParent($parent)
    {
        $this->parent = $parent;
    }

    function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    function setDateat($dateat)
    {
        $this->dateat = $dateat;
    }

    function setDateup($dateup)
    {
        $this->dateup = $dateup;
    }

    function setStatut($statut)
    {
        $this->statut = $statut;
    }
     

    public function initialize()
    {
        $this->setSource("categorie");

        $this->hasMany("idCat", "images", "idcategorie");
        $this->hasMany("idCat", "afriquestock_image", "idcategorie");
        $this->belongsTo("iduser", "user", "id");
    }
}
