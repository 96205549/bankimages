<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of InscriptionController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class InscriptionController extends Controller
{

    public function initialize()
    {
        $this->tag->setTitle("banque d'image");

        $this->view->setMainView("main_subcrite");
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");
            $confirmer = $this->request->getPost("confirm");
            $date = date("d-m-Y H:i:s", time());

            if (empty($nom)) {
                $this->flashSession->error("Veuillez renseigner votre nom");
            } elseif (empty($prenom)) {
                $this->flashSession->error("Veuillez renseigne votre prenom");
            } elseif (empty($email)) {
                $this->flashSession->error("Veuillez renseigner votre adresse email");
            } elseif (empty($password)) {
                $this->flashSession->error("Veuillez definir un mot de passe");
            } elseif ($password != $confirmer) {
                $this->flashSession->error("Le mot de passe ne n est pas conforme");
            } else {
                
                
                    $abonne = new abonne();
                    $abonne->nom = $nom;
                    $abonne->prenom = $prenom;
                    $abonne->email = $email;
                    $abonne->password = sha1($password);
                    $abonne->dateat = $date;
                    $abonne->dateup = $date;
                    $abonne->code = sha1($date. rand(10000, 99999));
                    //die(var_dump($abonne));
                    $data = $abonne->save();

                    if ($data == true) {
                        $this->flashSession->success("Votre compte a ete creer avec succes,"
                            . " consulter votre boite email pour confoirmer votre compte");
                    } else {
                        $this->flashSession->error("Desole la creation du compte a echoue veuillez verifier a nouveau les informations renseigner");
                    }
              
            }
            $this->view->setVars(["nom" => $nom, "prenom" => $prenom, "email" => $email]);
        }


        $this->view->pick("pages/inscription");
    }
}
