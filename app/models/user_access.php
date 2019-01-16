<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of user_access
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class user_access extends Model
{

    //put your code here

    private $id;
    private $iduser;
    private $idaccess;

    /*
     * declaration des getters
     */

    function getId()
    {
        return $this->id;
    }

    function getIdaccess()
    {
        return $this->idaccess;
    }

    function getIduser()
    {
        return $this->iduser;
    }
    /*
     * declaration des setters
     */

    function setIdaccess($idacces)
    {
        $this->idaccess = $idacces;
    }

    function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    public function initialize()
    {
        $this->setSource("user_access");

        $this->belongsTo("iduser", "user", "id");
        $this->belongsTo("idaccess", "access", "id");
    }
}
