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

class user extends Model
{
    /*
     * declaration des variables
     */

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $login;
    private $password;
    private $dateat;
    private $dateup;
    private $typeUser;
    private $statut;
   // private $parent;

    /*
     * declaration des getters
     */

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

    function getLogin()
    {
        return $this->login;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getDateat()
    {
        return $this->dateat;
    }

    function getDateup()
    {
        return $this->dateup;
    }

    function getTypeUser()
    {
        return $this->typeUser;
    }

    function getStatut()
    {
        return $this->statut;
    }
    /*
     * declaration des setters
     */

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setEmail($mail)
    {
        $this->email = $mail;
    }

    function setLogin($login)
    {
        $this->login = $login;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setDateat($date)
    {
        $this->dateat = $date;
    }

    function setDateup($date)
    {
        $this->dateup = $date;
    }

    function setTypeUser($type)
    {
        $this->typeUser = $type;
    }

    function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function initialize()
    {
        $this->setSource("user");

//        $this->belongsTo("idprofile", "profile", "idprofile");
        $this->hasMany("id", "user_access", "iduser");
    }
}
