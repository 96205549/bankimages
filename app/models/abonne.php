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

class abonne extends Model
{
    private  $id;
    private  $nom;
    private  $prenom;
    private  $email;
    private  $password;
    private  $code;
    private  $dateat;
    private  $dateup;
    private  $contributeur;
    private  $actif;
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

    function getPassword()
    {
        return $this->password;
    }

    function getCode()
    {
        return $this->code;
    }

    function getDateat()
    {
        return $this->dateat;
    }

    function getDateup()
    {
        return $this->dateup;
    }

    function getContributeur()
    {
        return $this->contributeur;
    }

    function getActif()
    {
        return $this->actif;
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

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setCode($code)
    {
        $this->code = $code;
    }

    function setDateat($dateat)
    {
        $this->dateat = $dateat;
    }

    function setDateup($dateup)
    {
        $this->dateup = $dateup;
    }

    function setContributeur($contributeur)
    {
        $this->contributeur = $contributeur;
    }

    function setActif($actif)
    {
        $this->actif = $actif;
    }

     public function initialize()
    {
        $this->setSource("abonne");

      //  $this->hasMany("id", "abonne", "iduser");
    }
}
