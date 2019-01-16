<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model;

/**
 * Description of DashboardController
 *
 * @author karth solution
 */
class ClientController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //varclient::initialize();
    }

    //put your code here
    public function newClientAction()
    {
        $this->assets->addCss("public/adm/css/bootstrap.min.css");
        $this->assets->addCss("public/adm/ncss/styles.css");


        $clients = client::find(["varclient=:val:", "bind" => ["val" => 0]]);
        $this->view->clients = $clients;

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $email = $this->request->getPost("email");
            $telephone = $this->request->getPost("telephone");
            $password = $this->request->getPost("password");
            $varclient = $this->request->getPost("varclient");


            $client = new client();
            $client->nom = $nom;
            $client->prenom = $prenom;
            $client->email = $email;
            $client->telephone = $telephone;
            $client->password = $password;
            $client->varclient = $varclient;

            $save = $client->save();

            if ($save == TRUE) {
                $this->flashSession->success("Client enegistré avec succes");
            }
            return $this->response->redirect("admin/client/allClient");
        }
        $this->view->pick("pages/newClient");
    }

    public function allClientAction()
    {
        $clients = client::find();

        $this->view->clients = $clients;
        $this->view->pick("pages/allClient");
    }

    public function abonneAction()
    {

        $clients = client::find(["type=:typ:", "bind" => ["typ" => 0]]);

        $this->view->clients = $clients;
        $this->view->pick("pages/abonne");
    }

    public function contributeurAction()
    {

        $clients = client::find(["type=:typ:", "bind" => ["typ" => "contributeur"]]);

        $this->view->clients = $clients;
        $this->view->pick("pages/contributeur");
    }

    public function photographeAction()
    {

        $clients = client::find(["type=:typ:", "bind" => ["typ" => "photographe"]]);
        $this->view->clients = $clients;

        $pays = pays::find();
        $this->view->pays = $pays;
//        die(print_r("no"));

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $email = $this->request->getPost("email");
            $telephone = $this->request->getPost("telephone");
            $pays = $this->request->getPost("idpays");
            $ville = $this->request->getPost("ville");
            $region = $this->request->getPost("region");
            $password = $this->request->getPost("password");
            $passwordconf = $this->request->getPost("passwordconf");
            $boitePostale = $this->request->getPost("boitePostale");
            $numero = $this->request->getPost("numero");
//            $codevalidate = $this->request->getPost("codevalidate");
//            $statut = $this->request->getPost("statut");
            $type = $this->request->getPost("type");


            if ($password != $passwordconf) {

                $this->flashSession->error("les mots de pass doivent etre identiques");
            } else {
//                            die(print_r($type));

                $photographe = new client();
                $photographe->nom = $nom;
                $photographe->prenom = $prenom;
                $photographe->email = $email;
                $photographe->telephone = $telephone;
                $photographe->password = $password;
                $photographe->passwordconf = $passwordconf;
                $photographe->idpays = $pays;
                $photographe->ville = $ville;
                $photographe->region = $region;
                $photographe->numero = $numero;
                $photographe->codevalidate = sha1(time());
//                $photographe->statut = "0";
                $photographe->type = $type;
                $photographe->boitePostale = $boitePostale;
                $save = $photographe->save();
//                die(var_dump($photographe));


                if ($save == TRUE) {
                    $this->flashSession->success("Photographe enregistrÃ© avec succes");
                }
            }
        }


        $this->view->pick("pages/photographe");
    }

    public function espaceAction()
    {
        $customer = $this->request->get('customer');
        
        $clients = client::find(["type=:typ:", "bind" => ["typ" => "contributeur"]]);

        $imgEnAttente = Imagecontributeur::find(["idClient=:idclient: and validite=:val: and archiver=0", "bind" => ["val" => "1", "idclient" => $customer]]);
        $imgValide = Imagecontributeur::find(["idClient=:idclient: and validite=:val: and archiver=0", "bind" => ["val" => "2", "idclient" => $customer]]);
        $imgRejete = Imagecontributeur::find(["idClient=:idclient: and validite=:val: and archiver=0", "bind" => ["val" => "-1", "idclient" => $customer]]);

        $this->view->clients = $clients;
        $this->view->imgEnAttente = $imgEnAttente;
        $this->view->imgValide = $imgValide;
        $this->view->imgRejete = $imgRejete;
        $this->view->pick("pages/espace");
    }
}
