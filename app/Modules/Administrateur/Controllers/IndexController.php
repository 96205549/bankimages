<?php

/**
 * Controlleur des fonctionnalités d'authentification
 * Gère l'authentification et la page d'administration des administrateurs
 *
 * @author Laurice TOPANOU <latomv@gmail.com>
 */

/*
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;*/

use \Phalcon\Mvc\Model\Resultset,
    \Phalcon\Mvc\Controller;
/*use afriqueStock\Model\user,
    \afriqueStock\Model\access;*/
   // \Wandoo\Model\Produit;


class IndexController extends Controller
{

    public function initialize()
    {
//        if (!$this->loggeduser->isLogged() || ($this->loggeduser->getUser()->mailvendeur)) {
//            $this->loggeduser->logOut();
//            return $this->response->redirect("authentification");
//        }
        $this->view->setMainView("main");
    }

//@todo  how to check if a session is already opened

    public function indexAction()
    {
        $this->view->pick("pages/index");
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $login = $this->request->getPost("username");
            $pwd = $this->request->getPost("password");

          // die(print_r($login));

            if (empty($login)) {
                $this->flashSession->error("veuillez renseigner le login");
                return $this->response->redirect("admin/index");
            } elseif (empty($pwd)) {
                $this->flashSession->error("le champ mot de passe est vide!");
                return $this->response->redirect("admin/index");
            } else {
                $pass = sha1($pwd);

                $dataUser = user:: findFirst(["login=?0 and password=?1", "bind" => ['0' => $login, '1' => $pass]]);
//                var_dump($dataUser);
//                die();
                if ($dataUser == TRUE) {

                    if ($dataUser->statut == '1') {
                        /*
                         * passage de la variable  id de l'utilisateur en session
                         */
                        $this->session->set('iduser', $dataUser->id);
                        /*
                         * controller sur les permission
                         */
                        // $permission = ["modifier", "supprimer", "telecharger", "sms"];

                        $access = access::find();


                        return $this->response->redirect("admin/dashboard/");
                    } else {
                        $this->flashSession->notice("le compte est inactif");
                        return $this->response->redirect("admin/index");
                    }
                } else {
                    $this->flashSession->notice("identifiant incorrect");
                    return $this->response->redirect("admin/index");
                }
            }
        }
    }
    /*
     * gestion du mot de psse oublié
     */

    public function forgotPassAction()
    {
        
    }

    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect("index");
    }

    public function monProfilAction()
    {
        $this->view->pick("pages/monProfil");
    }

    public function siteMaintenanceAction()
    {
        $this->view->pick("pages/siteMaintenance");
    }

    /**
     * gère la fermeture de session de l'utilisateur en cours
     */
    public function loggoutAction()
    {
        if ($this->loggeduser->isLogged()) {
            $this->loggeduser->logOut();
            $this->flashSession->success("Fin de session. &Agrave; tr&egrave;s bient&ocirc;t!");
        }
        $this->response->redirect("index");
    }
}
