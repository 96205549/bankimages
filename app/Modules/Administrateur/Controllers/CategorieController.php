<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;

/**
 * Description of DashboardController
 *
 * @author karth solution
 */
class CategorieController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    //put your code here

    public function indexAction()
    {
//        $this->assets->addCss("public/adm/css/bootstrap.min.css");
//        $this->assets->addCss("public/adm/ncss/styles.css");

        $categories = categorie::find(["parent=:val:", "bind" => ["val" => 0]]);
        $this->view->categories = $categories;
        if ($this->request->isPost()) {
            $nomCat = $this->request->getPost("categorie");
            
            $parent = $this->request->getPost("parent");
            $statut = !empty($this->request->getPost("statut")) ? "1" : "0";
            $checkCategories = categorie::find(["nomCategorie=:val:","bind"=>["val"=>$nomCat]]);
            if (sizeof($checkCategories) >0) {
                $this->flashSession->error("ce nom de categorie existe deja");
            } elseif (empty($nomCat)) {
                $this->flashSession->error("veuillez saisie le nom de la categorie");
            } else {

                $iduser = $this->session->get('iduser');
                $idCat = sha1(time());

                $date = date("Y-m-d H:i:s", time());
                $newCategorie = new categorie();
                $newCategorie->idCat = $idCat;
                $newCategorie->nomCategorie = $nomCat;
                $newCategorie->parent = $parent;
                $newCategorie->iduser = $iduser;
                $newCategorie->dateat = $date;
                $newCategorie->dateup = $date;
                $newCategorie->statut = $statut;
                $save = $newCategorie->save();
               // die(var_dump($newCategorie));
                if ($save == TRUE) {
                   // die(print_r($nomCat));
                    $this->flashSession->success("Categorie enregistree avec succes");
                }
            }
            return $this->response->redirect("admin/categorie/");
        }
        $this->view->pick("pages/newCategorie");
    }
    
  
    
    public function vueAction(){
//        $this->assets->addCss("public/adm/css/bootstrap.min.css");
//        $this->assets->addCss("public/adm/ncss/styles.css");
        $idCategorie= $this->request->get("AFID");
        $this->view->parent=$idCategorie;
        
        //$categorie = categorie::findFirstById($idCategorie);
        $categories = categorie::find(["parent=:val:", "bind" => ["val" => $idCategorie]]);
        //$this->view->oneCategorie = $categorie;
        $this->view->categories = $categories;
        if ($this->request->isPost()) {
            
           // die(print_r($idCategorie));
            $nomCat = $this->request->getPost("categorie");
            $parent = $this->request->getPost("parent");
            $statut = !empty($this->request->getPost("statut")) ? "1" : "0";
            $checkCategories = categorie::find(["nomCategorie=:val:","bind"=>["val"=>$nomCat]]);
//        die(var_dump($checkCategories));
            if (sizeof($checkCategories) >0) {
                $this->flashSession->error("ce nom de categorie existe deja");
            } elseif (empty($nomCat)) {
                $this->flashSession->error("veuillez saisie le nom de la categorie");
            } else {

                $iduser = $this->session->get('iduser');

                $idCat = sha1(time());

                $date = date("Y-m-d H:i:s", time());
                $newCategorie = new categorie();
                $newCategorie->idCat = $idCat;
                $newCategorie->nomCategorie = $nomCat;
                $newCategorie->parent = $parent;
                $newCategorie->iduser = $iduser;
                $newCategorie->dateat = $date;
                $newCategorie->dateup = $date;
                $newCategorie->statut = $statut;
//                die(var_dump($newCategorie));
                $save = $newCategorie->save();
                
                if ($save == TRUE) {
                    $this->flashSession->success("Categoie enegistrer avec succes");
                }
            }
             return $this->response->redirect("admin/categorie/vue?AFID=". $parent);
        }
        $this->view->pick("pages/vue");
    }
    
    
    public function updateAction(){
//        $this->assets->addCss("public/adm/css/bootstrap.min.css");
//        $this->assets->addCss("public/adm/ncss/styles.css");
        
        $idCategorie= $this->request->get("AFID");       
        $categorie = categorie::findFirstByIdCat($idCategorie);
         
        
        if ($this->request->isPost()) {
            $nomCategorie= $this->request->getPost('categorie');
            $id= $this->request->getPost('idcat');
            $result = categorie::findFirstByIdCat($id);
            
//            die(var_dump($result));
            if($result==TRUE){
                $result->nomCategorie=$nomCategorie;
                $result->update();
            }

            $this->response->redirect('admin/categorie/update?AFID='.$id);

            
        }   
        $this->view->pick("pages/editCategorie");
        $this->view->idcategorie=$idCategorie;
        $this->view->categories=$categorie;
    }
    
    public function deleteAction(){
//        $this->assets->addCss("public/adm/css/bootstrap.min.css");
//        $this->assets->addCss("public/adm/ncss/styles.css");
        
        $idCategorie= $this->request->get("AFID");
        $categorie=categorie::findFirstById($idCategorie);
         if ($categorie) {
           $del=$categorie->delete();
           if($del){
               
          
            
            return $this->dispatcher->forward(
                [
                    "controller" => "categorie",
                    "action"     => "index",
                ]
            );
            
             }
        }
    }
}
