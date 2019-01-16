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

class client extends Model
{
    /*
     * declaration des variables
     */

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $password;
    private $idpays;
    private $ville;
    private $region;
    private $boitePostale;
    private $numero;
    private $codevalidate;
    private $statut;
    private $type;
    
    
    function getType()
    {
        return $this->type;
    }

    function setType($type)
    {
        $this->type = $type;
    }

       
    function getCodevalidate()
    {
        return $this->codevalidate;
    }

    function getStatut()
    {
        return $this->statut;
    }

    function setCodevalidate($codevalidate)
    {
        $this->codevalidate = $codevalidate;
    }

    function setStatut($statut)
    {
        $this->statut = $statut;
    }

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getTelephone()
    {
        return $this->telephone;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getIdpays()
    {
        return $this->idpays;
    }

    function getVille()
    {
        return $this->ville;
    }

    function getRegion()
    {
        return $this->region;
    }

    function getBoitePostale()
    {
        return $this->boitePostale;
    }

    function getNumero()
    {
        return $this->numero;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setIdpays($idpays)
    {
        $this->idpays = $idpays;
    }

    function setVille($ville)
    {
        $this->ville = $ville;
    }

    function setRegion($region)
    {
        $this->region = $region;
    }

    function setBoitePostale($boitePostale)
    {
        $this->boitePostale = $boitePostale;
    }

    function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function initialize()
    {
        $this->setSource("client");

        $this->belongsTo("idpays", "pays", "id");
        $this->hasMany("id", "abonnement", "abonnement_id");
        $this->hasMany("id", "adresse", "idclient");
        $this->hasMany("id", "imagecontributeur", "idClient");
    }
}
