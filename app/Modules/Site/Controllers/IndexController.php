<?php
/**
 * IndexController
 *
 * Controller du front
 * 
 * @author Laurice TOPANOU <latomv@gmail.com>
 */
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function initialize()
    {
        $this->tag->setTitle('Plateforme unifiée de services en Afrique');
        //parent::initialize();
        
        if ($this->session->get("idpanier")) {
            $idpanier = $this->session->get("idpanier");
            $panier = acheter::find(["idpanier=:val:", "bind" => ["val" => $idpanier]]);
            $this->view->panier = $panier;
        }else{
            $this->view->panier = [];
        }
        
        $categories = categorie::find();
        $images = images::find();
        $this->view->categories = $categories;
        $this->view->images = $images;
        $this->view->setMainView("default");
    }

    public function indexAction()
    {

        $categories = categorie::find();
        $images = images::find();
         

        $this->view->categories = $categorie;
        $this->view->images = $images;
//        $this->view->banner = $banner;
        $this->view->pick("pages/index");
    }
    
    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function connexionAction()
    {
        $this->tag->setTitle('Accédez à votre espace client');
        $this->view->pick("pages/connexion");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function maintenanceAction()
    {
        $this->tag->setTitle('Page en cours de maintenance');
        $this->view->pick("pages/maintenance");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function inscriptionAction()
    {
        $this->tag->setTitle('Inscrivez-vous pour profiter de nos offres');
        $this->view->pick("pages/inscription");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function acteursAction()
    {
        $this->tag->setTitle('Les acteurs et leurs avantages');
        $this->view->pick("pages/acteurs");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function presentationAction()
    {
        $this->tag->setTitle('Qui sommes-nous?');
        $this->view->pick("pages/presentation");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function produitsAction()
    {
        $this->tag->setTitle('Nos produits et services');
        $this->view->pick("pages/produits");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function partenairesAction()
    {
        $this->tag->setTitle('Nos partenaires');
        $this->view->pick("pages/partenaires");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function contactAction()
    {
        $this->tag->setTitle('Contactez-nous');
        $this->view->pick("pages/contact");
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function responsabilitesAction()
    {
        $this->tag->setTitle('Conditions générales');
        $this->view->pick("pages/responsabilites");
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('index/index');
    }
    
    
}
