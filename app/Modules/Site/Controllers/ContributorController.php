<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContributorController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ContributorController extends controller {

    public function initialize() {
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }
        $this->view->setMainView("bloc-contributor");
    }

//@todo  how to check if a session is already opened

    public function indexAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
//     die(print_r("yes"));

        $idclient = $this->session->get("id");

        /*
         * images envoyé
         */
        $images = imagecontributeur::find(["idClient=:val: and validite=:validi:",
                    "bind" => ["val" => $idclient, "validi" => 0]]);
        /*
         * images validé
         */
        $attentes = imagecontributeur::find(["idClient=:val: and validite=:validi:",
                    "bind" => ["val" => $idclient, "validi" => 1]]);
        /*
         * images validé
         */
        $valides = imagecontributeur::find(["idClient=:val: and validite=:validi:",
                    "bind" => ["val" => $idclient, "validi" => 2]]);
        /*
         * images rejeté
         */
        $rejetes = imagecontributeur::find(["idClient=:val: and validite=:validi:",
                    "bind" => ["val" => $idclient, "validi" => -1]]);
        /*
         * image vendu
         */
        $ventes = imagevendu::find(["idphotographe=:photo:",
                    "bind" => ["photo" => $idclient]]);
        
        $allimages = images::find(["photographe=:photo:",
                    "bind" => ["photo" => $idclient]]);

        $categories = categorie::find();

        $this->view->images = $images;
        $this->view->attentes = $attentes;
        $this->view->valides = $valides;
        $this->view->rejetes = $rejetes;
        $this->view->ventes = $ventes;
        $this->view->allimages = $allimages;
        $this->view->categories = $categories;

        $this->view->pick("pages/space-contributor");
    }

    public function postimageAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");
//        $upload = $this->request->getUploadedFiles();
//        $filename = $upload->getName();
        $filename = $_FILES['file']['name'];

        /* Getting File size */
//        $filesize = $upload->getimagesize();
        $filesize = $_FILES['file']['size'];

        /* Location */
        $location = '../public/images/photo/' . $filename;
//        $location = $this->imagerootDir . $filename;
//        $location = "upload/" . $filename;
//        $return_arr = array();

        /* Upload file */
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $src = '../public/images/photo/site.PNG' . "default.png";
//            $src = $this->imagerootDir ."default.png";
            // checking file is image or not
            if (is_array(getimagesize($location))) {
                $src = $location;
            }
            $return_arr = array("name" => $filename, "size" => $filesize, "src" => $src);

            $image = new imagecontributeur();
            $image->image = $src;
            $image->idClient = $idclient;
            $image->date = date("Y-m-d H:i:s");
            $image->save();

//            $image->description= $src;
//            die(var_dump($return_arr));
        }

        return json_encode($return_arr);




        /* if($this->request->hasfile()){

          $uploadfile = $this->request->getUploadedFiles();
          $codeImg = "AF#" . rand(10000, 999999) . date("dmy", time());
          $folder = $this->imagerootDir . date("dmy", time());
          //               $taille= list($width, $height) = $affiche->getSize();

          //                 die(var_dump($taille));
          //                 die(print_r($height));

          if (!file_exists($folder)) {
          $path = mkdir($this->imagerootDir . date("dmy", time()), 0777);
          } else {
          $path = $folder;
          }



          foreach ($uploadfile as $key => $upload) {

          $extension = new SplFileInfo($upload->getName());
          $extFile = $extension->getExtension();
          if (in_array(strtolower($extFile), ['jpeg', 'jpg', 'png'])) {
          // die(var_dump($extFile));

          $newName = md5($upload->getName()) . "." . $extFile;
          $namefile = date("dmyhis", time()) . $newName;


          $chemin = $path . "/" . $namefile;

          $isuploads = $upload->moveTo($chemin);
          list($widthA, $heightA) = getimagesize($chemin);
          $photo = new afriquestock_image();
          $photo->imagelink = date("dmy", time()) . "/" . $namefile;
          $photo->taille = $taille[$key];
          $photo->width = $widthA;
          $photo->height = $heightA;
          $photo->idimg = "0";
          $photo->idcategorie = "1";
          die(var_dump($photo));
          $photo->save();
          $i++;
          }

          }

          //                            if ($i == sizeof($taille)) {
          //                                $this->flashSession->success("image enregistrer avec succes");
          //                                $this->response->redirect("admin/image/newPicture");
          //                            }


          } */
        $this->view->pick("pages/post-image");
    }

    public function addphotoAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        if ($this->request->isPost()) {
            $id = $this->request->getPost("idimg");
            $categorie = $this->request->getPost("categorie");
            $description = $this->request->getPost("description");
            $keyword = $this->request->getPost("keyword");

            $container = imagecontributeur::findFirst($id);
            $container->description = $description;
            $container->motcle = $keyword;
            $container->categorie = $categorie;
            $container->validite = "1";
//            die(var_dump($container));

            $data = $container->save();

            if ($data == true) {
                $this->response->redirect("contributor/");
            }
        }
        $this->view->pick("pages/post-image");
    }

    public function removeAction() {
        if (!$this->session->get("id")) {
            $this->response->redirect("account/logout");
        }
        $idclient = $this->session->get("id");
//        if($this->request->isPost()){
        $id = $this->request->get("image");
        $image = imagecontributeur::findFirst(['id=?0 and idClient=?1', "bind" => ['0' => $id, '1' => $idclient]]);
        
//        if($image==true){
            $image->delete();
            

            $this->response->redirect("contributor/");

//        $this->view->pick("pages/post-image");
    }

}
