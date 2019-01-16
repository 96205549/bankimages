<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of images
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class images extends Model
{

    //put your code here
    private $idimage;
    private $nom;
    private $description;
    private $motcle;
    private $extension;
    private $signature;
    private $affiche;
    private $type;
    private $iduser;
    private $idcategorie;
    private $imageID;
    private $photographe;
    private $prixG;
    private $prixM;
    private $prixP;
    private $width;
    private $height;
//    private $height;
    
    
    
    function getAffiche()
    {
        return $this->affiche;
    }

    function getPrixG()
    {
        return $this->prixG;
    }

    function getPrixM()
    {
        return $this->prixM;
    }

    function getPrixP()
    {
        return $this->prixP;
    }

    function getWidth()
    {
        return $this->width;
    }

    function getHeight()
    {
        return $this->height;
    }

    function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    function setPrixG($prixG)
    {
        $this->prixG = $prixG;
    }

    function setPrixM($prixM)
    {
        $this->prixM = $prixM;
    }

    function setPrixP($prixP)
    {
        $this->prixP = $prixP;
    }

    function setWidth($width)
    {
        $this->width = $width;
    }

    function setHeight($height)
    {
        $this->height = $height;
    }

        
    function getIdimage()
    {
        return $this->idimage;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getMotcle()
    {
        return $this->motcle;
    }

    function getExtension()
    {
        return $this->extension;
    }

    function getSignature()
    {
        return $this->signature;
    }

    function getType()
    {
        return $this->type;
    }

    function getIduser()
    {
        return $this->iduser;
    }

    function getIdcategorie()
    {
        return $this->idcategorie;
    }

    function getImageID()
    {
        return $this->imageID;
    }

    function getPhotographe()
    {
        return $this->photographe;
    }

    function getPrix()
    {
        return $this->prix;
    }
    
    /*
     * declaration des setters
     */

    function setIdimage($idimage)
    {
        $this->idimage = $idimage;
    }

    function setNom($nom_image)
    {
        $this->nom = $nom_image;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setMotcle($motcle)
    {
        $this->motcle = $motcle;
    }

    function setExtension($extension)
    {
        $this->extension = $extension;
    }

    function setSignature($signature)
    {
        $this->signature = $signature;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    function setImageID($imageID)
    {
        $this->imageID = $imageID;
    }

    function setPhotographe($photographe)
    {
        $this->photographe = $photographe;
    }

    function setPrix($prix)
    {
        $this->prix = $prix;
    }


    public function initialize()
    {
        $this->setSource("images");

        $this->belongsTo("idcategorie", "categorie", "idCat");
        $this->belongsTo("photographe", "client", "id");
//        $this->hasManyToMany("idimage", "afriquestock_image", "id" , ""  );
        $this->hasMany("idimage", "afriquestock_image", "idimg");
        $this->hasMany("idimage", "acheter", "idproduit");
        //$this->belongsTo("iduser", "user", "id");
    }

}
