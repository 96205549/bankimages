<?php
use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model;

class SessionController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('main');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    public function indexAction()
    {
        //  $this->view->disable();
        //$param = settings::findFirst(["data='electra'"]);
        // $this->view->param = $param;
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $login = $this->request->getPost("username");
            $pwd = $this->request->getPost("password");
         
           

            if (empty($login)) {
                $this->flashSession->error("veuillez renseigner le login");
                return $this->response->redirect("session/index");
            } elseif (empty($pwd)) {
                $this->flashSession->error("le champ mot de passe est vide!");
                return $this->response->redirect("session/index");
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


                        return $this->response->redirect("accueil/index");
                    } else {
                        $this->flashSession->notice("le compte est inactif");
                        return $this->response->redirect("session/index");
                    }
                } else {
                    $this->flashSession->notice("identifiant incorrect");
                    return $this->response->redirect("session/index");
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
        return $this->response->redirect("admin/session/index");
    }
}
