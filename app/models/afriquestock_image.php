<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of afriquestockimage
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class afriquestock_image extends Model
{
    //put your code here
    private $id;
    private $imagelink;
    private $taille;
    private $idimg;
    private $idcategorie;
    private $width;
    private $height;
    
    function getWidth()
    {
        return $this->width;
    }

    function getHeight()
    {
        return $this->height;
    }

    function setWidth($width)
    {
        $this->width = $width;
    }

    function setHeight($height)
    {
        $this->height = $height;
    }

        
    function getIdcategorie()
    {
        return $this->idcategorie;
    }

    function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    
        function getId()
    {
        return $this->id;
    }

    function getImagelink()
    {
        return $this->imagelink;
    }

    function getTaille()
    {
        return $this->taille;
    }

    function getIdimg()
    {
        return $this->idimg;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setImagelink($imagelink)
    {
        $this->imagelink = $imagelink;
    }

    function setTaille($taille)
    {
        $this->taille = $taille;
    }

    function setIdimg($idimg)
    {
        $this->idimg = $idimg;
    }

  public function initialize()
    {
        $this->setSource("afriquestock_image");


        $this->belongsTo("idimage", "images", "idimg");
        $this->belongsTo("idcategorie", "categorie", "idCat");
       
    }


    
    
}
