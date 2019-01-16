<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model,
    Phalcon\Image\Adapter;

/**
 * Description of DashboardController
 *
 * @author karth solution
 */
class ImageController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('defaultimg');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    //put your code here

    public function indexAction()
    {
        
    }

    public function newPictureAction()
    {


        $iduser = $this->session->get('iduser');
        $allCategories = categorie::find();
        $this->view->categories = $allCategories;

        $photographes = client::find(["type=:typ:", "bind" => ["typ" => "photographe"]]);
        $this->view->photographes = $photographes;

        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
//                die(print_r("yes"));
                $nom = $this->request->getPost("nom");
                $description = $this->request->getPost("description");
                $motcle = $this->request->getPost("motcle");
                $categorie = $this->request->getPost("categorie");
                $photographe = $this->request->getPost("photographe");
                $type = $this->request->getPost("type");
                $prixG = $this->request->getPost("prixG");
                $prixM = $this->request->getPost("prixM");
                $prixP = $this->request->getPost("prixP");

                $signature = $this->request->getUploadedFiles()[0];
                $affiche = $this->request->getUploadedFiles()[1];
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

//                 die($path);
                //$path = mkdir($this->imagerootDir . date("d-m-y", time()), 0777);

                if ($signature->isUploadedFile() && !empty($signature->getName())) {
                    $extension = new SplFileInfo($signature->getName());
                    $fileExtension = $extension->getExtension();
                    $extensionA = new SplFileInfo($affiche->getName());
                    $fileExtensionA = $extensionA->getExtension();

//                    die(var_dump($fileExtensionA));
                    if (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'gif'])) {

                        $newName = md5($signature->getName()) . "." . $fileExtension;
                        $affiheName = md5($affiche->getName()) . "." . $fileExtensionA;
                        $dest = date("dmyhis", time()) . $newName;
                        $destA = date("dmyhis", time()) . $affiheName;
                        // die(print_r($dest));
                        if ($signature->moveTo($path . "/" . $dest)) {
                            $affiche->moveTo($path . "/" . $destA);
                            list($width, $height) = getimagesize($path . "/" . $destA);
//                        echo "width: " . $width . "<br />";
//                        echo "height: " .  $height;
//                            die();

                            $image = new images();
                            $image->nom = $nom;
                            $image->description = $description;
                            $image->motcle = $codeImg . ',' . $motcle;
                            $image->extension = $fileExtension;
                            $image->signature = date("dmy", time()) . "/" . $dest;
                            $image->affiche = date("dmy", time()) . "/" . $destA;
                            $image->type = $type;
                            $image->iduser = $iduser;
                            $image->idcategorie = $categorie;
                            $image->imageID = $codeImg;
                            $image->photographe = $photographe;
                            $image->prixG = $prixG;
                            $image->prixM = $prixM;
                            $image->prixP = $prixP;
                            $image->width = $width;
                            $image->height = $height;

                            $data = $image->save();

                            $isuploads = false;
                            $taille = ["0", "1", "grande", "moyenne", "petite"];
                            $i = 0;
                            foreach ($uploadfile as $key => $upload) {
                                if ($key != 0 && $key != 1) {
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
                                        $photo->idimg = $image->idimage;
                                        $photo->idcategorie = $categorie;
//                                          die(var_dump($photo));
                                        $photo->save();
//                            die(var_dump($data));
                                        $i++;
                                    }
                                }
                            }

                            if ($i == sizeof($taille)) {
//                                                            die(print_r("yes"));
                                $this->flashSession->success("image enregistrer avec succes");
                                $this->response->redirect("admin/image/newPicture");
                            }
                        }
                    }
                }
            }
        }


        $this->view->pick("pages/newPicture");
    }

    public function allPictureAction()
    {
//        $this->assets->addCss("public/adm/css/bootstrap.min.css");
//        $this->assets->addCss("public/adm/ncss/jquery.dataTables.min.css");

        $images = images::find();

//        $this->assets->addJs("public/adm/js/jquery-3.3.1.js");
//        $this->assets->addJs("public/adm/js/dataTables.bootstrap.min.js");
//        $this->assets->addJs("public/adm/js/jquery.dataTables.min.js");

        $this->view->images = $images;
        $this->view->pick("pages/allPicture");
    }

    public function upPictureAction()
    {

        $id = $this->request->get('id');

        $iduser = $this->session->get('iduser');
        $allCategories = categorie::find();
        $this->view->categories = $allCategories;

        $photographes = client::find(["type=:typ:", "bind" => ["typ" => "photographe"]]);
        $this->view->photographes = $photographes;

        $image = images::findFirstByIdimage($id);
        $images = afriquestock_image::findByIdimg($id);

        /*
         * code de modification au post
         */
        if ($this->request->isPost()) {
            $code = $this->request->getPost("identifiant");
//            die(print_r($code));
            $upimage = images::findFirstByIdimage($code);

            $nom = $this->request->getPost("nom");
            $description = $this->request->getPost("description");
            $motcle = $this->request->getPost("motcle");
            $categorie = $this->request->getPost("categorie");
            $photographe = $this->request->getPost("photographe");
            $type = $this->request->getPost("type");
            $prixG = $this->request->getPost("prixG");
            $prixM = $this->request->getPost("prixM");
            $prixP = $this->request->getPost("prixP");

            if ($this->request->hasFiles() == true) {
//                die(print_r("yes"));

// die(print_r("yes"));
                $signature = $this->request->getUploadedFiles()[0];
                $affiche = $this->request->getUploadedFiles()[1];
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

//                 die($path);
                //$path = mkdir($this->imagerootDir . date("d-m-y", time()), 0777);

                if ($signature->isUploadedFile() && !empty($signature->getName())) {
//                     die(print_r("yes"));
                    $extension = new SplFileInfo($signature->getName());
                    $fileExtension = $extension->getExtension();
                    $extensionA = new SplFileInfo($affiche->getName());
                    $fileExtensionA = $extensionA->getExtension();

//                    die(var_dump($fileExtensionA));
                    if (in_array(strtolower($fileExtension), ['png', 'jpg', 'jpeg', 'gif'])) {

                        $newName = md5($signature->getName()) . "." . $fileExtension;
                        $affiheName = md5($affiche->getName()) . "." . $fileExtensionA;
                        $dest = date("dmyhis", time()) . $newName;
                        $destA = date("dmyhis", time()) . $affiheName;
                        // die(print_r($dest));
                        if ($signature->moveTo($path . "/" . $dest)) {
                            $affiche->moveTo($path . "/" . $destA);
                            list($width, $height) = getimagesize($path . "/" . $destA);
//                        echo "width: " . $width . "<br />";
//                        echo "height: " .  $height;
//                            die();
                            //$upimage = new images();
                            $upimage->nom = $nom;
                            $upimage->description = $description;
                            $upimage->motcle = $codeImg . ',' . $motcle;
                            $upimage->extension = $fileExtension;
                            $upimage->signature = date("dmy", time()) . "/" . $dest;
                            $upimage->affiche = date("dmy", time()) . "/" . $destA;
                            $upimage->type = $type;
                            $upimage->iduser = $iduser;
                            $upimage->idcategorie = $categorie;
                            $upimage->imageID = $codeImg;
                            $upimage->photographe = $photographe;
                            $upimage->prixG = $prixG;
                            $upimage->prixM = $prixM;
                            $upimage->prixP = $prixP;
                            $upimage->width = $width;
                            $upimage->height = $height;

                            $data = $upimage->update();

                            $isuploads = false;
                            $taille = ["0", "1", "grande", "moyenne", "petite"];
                            $i = 0;

                            foreach ($uploadfile as $key => $upload) {
                                if ($key != 0 && $key != 1) {
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
                                        $photo->idimg = $image->idimage;
                                        $photo->idcategorie = $categorie;
//                                          die(var_dump($photo));
                                        $photo->save();
//                            die(var_dump($data));
                                        $i++;
                                    }
                                }
                            }
                        
                            if ($i == sizeof($taille)) {
//                                                            die(print_r("yes"));
                                $this->flashSession->success("image enregistrer avec succes");
                                $this->response->redirect("admin/image/upPicture?id=".$code);
                            }
                        }
                    }
                }else{
//                     die(print_r("yes"));
                $upimage->nom = $nom;
                $upimage->description = $description;
                $upimage->motcle = $codeImg . ',' . $motcle;
                // $upimage->extension = $fileExtension;
                // $upimage->signature = date("dmy", time()) . "/" . $dest;
                //$upimage->affiche = date("dmy", time()) . "/" . $destA;
                $upimage->type = $type;
                $upimage->iduser = $iduser;
                $upimage->idcategorie = $categorie;
                //$upimage->imageID = $codeImg;
                $upimage->photographe = $photographe;
                $upimage->prixG = $prixG;
                $upimage->prixM = $prixM;
                $upimage->prixP = $prixP;
//                die(var_dump($upimage));
                $data = $upimage->update();
                
                $this->flashSession->success("image enregistrer avec succes");
                $this->response->redirect("admin/image/upPicture?id=".$code);
                }
            } 
        }



        $this->view->image = $image;
        $this->view->images = $images;
//        $this->view->imageM = $imageM;
//        $this->view->imageP = $imageP;
        $this->view->pick("pages/upPicture");
    }
    
    public function delPictureAction(){
        
        $id = $this->request->get('id');
        $iduser = $this->session->get('iduser');
        
       
//       die(print_r($iduser));
        $image = images::findFirstByIdimage($id);
        if($image==true){
            $image->delete();
        $images = afriquestock_image::findByIdimg($id);
        foreach ($images as $value):
            $value->delete();
        endforeach;
        
        $this->flashSession->success("image supprimer avec succes");
        }
        
        $this->response->redirect("admin/image/allPicture");
    }
}
