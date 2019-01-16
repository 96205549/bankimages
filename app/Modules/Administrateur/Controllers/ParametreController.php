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
class ParametreController extends Controller
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
        
    }

    public function accessAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");

        $dataAccess = access::find();

        $this->view->access = ($dataAccess) ? $dataAccess : [];

        if ($this->request->isPost()) {

            $access = $this->request->getPost("access");
            $i = 0;
            $j = 0;

            if (sizeof($access) > 0) {
                foreach ($dataAccess as $key => $value) {
                    if (!in_array($value->id, $access)) {

                        $data = access::findFirstById($value->id);
                        $data->statut = 0;
                        $data->save();
                    } else {
                        $data = access::findFirstById($value->id);
                        $data->statut = 1;
                        $data->save();
                    }
                }
            }
            $this->response->redirect("admin/parametre/access");
        }
        $this->view->pick("pages/access");
        // $this->assets->addJs("public/njs/bootstrap.min.js");
    }

    public function adminAction()
    {

        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");

        $dataAccess = access::find();
        $users = user::find();

        if ($this->request->isPost()) {

            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $mail = $this->request->getPost("mail");
            $login = $this->request->getPost("login");
            $login = $this->request->getPost("login");
            $password = $this->request->getPost("password");
            $typeUser = $this->request->getPost("typeUser");
            $statut = !empty($this->request->getPost("statut")) ? "1" : "0";
            $access = $this->request->getPost("access");
            $date = date("Y-m-d", time());

            $newUSer = new user();
            $newUSer->nom = $nom;
            $newUSer->prenom = $prenom;
            $newUSer->email = $mail;
            $newUSer->login = $login;
            $newUSer->password = sha1($password);
            $newUSer->dateat = $date;
            $newUSer->dateup = $date;
            $newUSer->statut = $statut;
            $newUSer->typeUser = $typeUser;
           // die(var_dump($newUSer));
            $insertData = $newUSer->save();
            //$insertData->id;
            //die(var_dump($newUSer));
            if ($insertData == TRUE) {
                if (sizeof($access) > 0) {
                    foreach ($access as $key => $value) {
                        $newAccess = new user_access();
                        $newAccess->iduser = $newUSer->id;
                        $newAccess->idaccess = $value;
                        // die(var_dump($newAccess));
                        $newAccess->save();
                    }
                }
            }
            $this->response->redirect("admin/parametre/admin");
        }

        $this->view->access = ($dataAccess) ? $dataAccess : [];
        $this->view->users = ($users) ? $users : [];
        $this->view->pick("pages/admin");
    }
}
