<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class AccountController extends controller {

    public function initialize() {
        
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        } else {
            $this->view->panier = [];
        }

        $this->view->setMainView("bloc-account");
    }

    public function send_mail($from, $mailDest, $subject, $content, $isHtml = false) {

        $mail = $this->PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP

        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'bouraimajoezer@gmail.com';  //'bouraimajoezer@gmail.com';                 // SMTP username
        $mail->Password = '10129096205549';  //'10129096205549';                           // SMTP password

        $mail->Port = 587;
        //$mail->Port = 465;                                                                        // TCP port to connect to
        $mail->setFrom($from, $subject);

        $mail->addAddress($mailDest);

        $mail->addReplyTo($from, 'Information');
        // foreach ($mailGroups as $to) {
        $mail->addCC("bouraimajoezer@gmail.com");


        $mail->isHTML($isHtml);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $content;
        $result = $mail->send();
        return $result ? true : false; // $mail->ErrorInfo;
    }

//@todo  how to check if a session is already opened

    public function indexAction() {
        $this->view->pick("pages/login");
    }

    public function loginAction() {

        if ($this->request->isPost()) {
            $email = $this->request->getPost("username");
            $password = $this->request->getPost("password");

//            die(print_r($email));
            $client = client::findFirst(["email=?0 and password=?1",
                        "bind" => ["0" => $email, "1" => sha1($password)]]);
//            die(var_dump($check));
            if ($client == true) {

                $this->session->set('id', $client->id);
                $this->session->set('nom', $client->nom);
                $this->session->set('prenom', $client->prenom);
                $this->session->set('email', $client->email);
                $this->session->set('code', $client->codevalidate);

                if ($client->type == "contributeur") {
                    if ($client->statut == 1) {
                        $this->session->set('contributor', "yes");
                    } else {
                        $this->session->set('contributor', "no");
                    }
                }
               
                
                
                
                $this->response->redirect("images/freepicture");
            }
        }

        $this->view->pick("pages/login");
    }

    public function logoutAction() {
        $this->session->destroy();
        return $this->response->redirect("account/login");
    }

    public function createAction() {

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $prenom = $this->request->getPost("prenom");
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("pass");
            $confirm = $this->request->getPost("confirm");


            if ($password == $confirm) {
                $user = new client();
                $user->nom = $nom;
                $user->prenom = $prenom;
                $user->email = $email;
                $user->password = sha1($password);
                $user->codevalidate = sha1(time());

//                die(var_dump($user));
                $data = $user->save();

                if ($data == true) {
                    $this->flashSession->success("Merci!, votre compte est creer avec succes");
//                    $this->response->redirect("admin/image/newPicture");
                }
            }
        }

        $this->view->pick("pages/create");
    }

    
   
    
    
    
    public function contributorAction() {
        $idclient = $this->session->get("id");
        $code = $this->session->get("code");

        if ($this->request->isPost()) {
            $pays = $this->request->getPost("pays");
            $ville = $this->request->getPost("ville");
            $region = $this->request->getPost("region");
            $boitePostale = $this->request->getPost("boitePostale");
            $telephone = $this->request->getPost("telephone");
            /*
             * recuperer les adresses du bureau
             */
            $paysB = $this->request->getPost("paysB");
            $villeB = $this->request->getPost("villeB");
            $regionB = $this->request->getPost("regionB");
            $boitePostaleB = $this->request->getPost("boitePostaleB");
//            $telephone = $this->request->getPost("telephone");


            if ($idclient) {

                $client = client::findFirstById($idclient);
                $client->telephone = $telephone;
                $client->idpays = $pays;
                $client->ville = $ville;
                $client->region = $region;
                $client->boitePostale = $boitePostale;
                $client->type = "contributeur";
//                die(var_dump($client));
                $data = $client->update();

                if ($data == true) {
                    $adresse = new adresse();
                    $adresse->idpays = $paysB;
                    $adresse->ville = $villeB;
                    $adresse->region = $regionB;
                    $adresse->boitePostale = $boitePostaleB;
                    $adresse->idclient = $idclient;
                    $dataB = $adresse->save();


                    $content = "Bonjour  chers " . $this->session->get("nom") . ' ' . $this->session->get("prenom") . "\n";
                    $content .= "pour valider votre compte, cliquer sur le lien ci-dessous " . "\n";
                    $content .= "http://localhost/afriqueStokn/account/activation?confirm=" . $code;

                    $this->send_mail("tj-tech@twicejoetech.com", $client->email, "AfriqueStock, code de confirmation", $content);



                    $this->session->set('contributeur', "yes");

                    $this->flashSession->success("Merci!, votre compte est creer avec succes");
                    $this->response->redirect("account/validate");
//                    $this->response->redirect("contributor/");
                }
            } else {
                $this->flashSession->warning("salut!, vous devez creer votre compte avant de deveni contributeur");
                $this->response->redirect("account/create");
            }
        }

        $this->view->pick("pages/contributor");
    }

    public function resendmailAction() {

        $email = $this->session->get('email');
        $nom = $this->session->get('nom');
        $prenom = $this->session->get('prenom');

        $code = "0bd367f12e7ad25d82994712c7d038b3410fb0f7";
//        $code = $this->session->get('code');
//        die(print_r($email));
        $content = "Bonjour  chers " . $nom . ' ' . $prenom . "\n";
        $content .= "pour valider votre compte, cliquer sur le lien ci-dessous " . "\n";
        $content .= "http://localhost/afriqueStokn/account/activation?confirm=" . $code;

        $send = $this->send_mail("tj-tech@twicejoetech.com", $email, "AfriqueStock, code de validation de votre compte", $content);

        if ($send == true) {
            $this->response->redirect("account/validate");
        } else {
            $this->flashSession->error("Echec de connexion");
            $this->response->redirect("account/validate");
        }

        $this->view->pick("pages/validate");
    }

    public function validateAction() {
        $idclient = $this->session->get("id");
        $email = $this->session->get("email");




        $this->view->email = $email;
        $this->view->pick("pages/validate");
    }

    public function activationAction() {
        $idclient = $this->session->get("id");
        $email = $this->session->get("email");
//        $code = $this->request->post("confirm");



        $codeConfirm = $this->request->get("confirm");

        $client = client::findFirst(['codevalidate=?1', "bind" => ["1" => $codeConfirm]]);

        if ($client == true) {

            $client->statut = 1;
            $data = $client->save();

            if ($data == true) {
                $this->response->redirect("contributor/");
            }
        } else {
            $this->flashSession->error("Le code de confirmation est invalide ou expirer");
            $this->response->redirect("account/validate");
        }





        $this->view->email = $email;
        $this->view->pick("pages/validate");
    }
    
    
    public function customerAction(){
        
        
        $this->view->pick("pages/space-customer");
    }

}
