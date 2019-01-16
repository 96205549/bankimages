<?php

use \Phalcon\Mvc\Router;

$router = new Router();
$router->add("/:action", ['module' => 'site', 'controller' => 'index', 'action' => 1]);
// route pour la connexion
$router->add("/:action", ['controller' => "connexion", 'action' => 1]);
$router->add("/connexion(/?)", "Connexion::index")->setName("connexion");
// route pour l'identify
$router->add("/identify(/?)", "Identify::index")->setName("identification");
$router->add("/abonnement(/?)", "Abonnement::index")->setName("tarif-abonnement");
$router->add("/contributor(/?)", "Contributor::index")->setName("contributeur");
$router->add("/contributeur(/?)", "Contributeur::index")->setName("contributeur-new");
// route pour l'inscription
$router->add("/inscription(/?)", "Inscription::index")->setName("inscription");
$router->add("/images(/?)", "Images::index")->setName("image");
$router->add("/categorie(/?)", "Categorie::index")->setName("categorie-image-vue");
$router->add("/account(/?)", "Account::index")->setName("account-view");
$router->add("/shopping(/?)", "Shopping::index")->setName("cart-view");
$router->add("/become(/?)", "Become::index")->setName("become-contributor");
$router->add("/customer(/?)", "Customer::index")->setName("space-customer");


$adminRoutes = new Router\Group(['module' => 'admin', 'controller' => 'index']);
$adminRoutes->setPrefix("/admin");

$adminRoutes->add("", ['controller' => 'index', 'action' => 1]);
//panneau d'administration de l'espace admin
$adminRoutes->add("/", 'Index::index')->setName("admin-home");
//$adminRoutes->add("/", 'Dashboard::index')->setName("admin-dashboard");

//menu admin
$adminRoutes->add("/:action", ['controller' => "index", 'action' => 1]);
$adminRoutes->add("/dashboard(/?)", "Dashboard::index")->setName("dashboard");
$adminRoutes->add("/categorie(/?)", "Categorie::index")->setName("categorie");
$adminRoutes->add("/client(/?)", "Client::index")->setName("client");
$adminRoutes->add("/abonnement(/?)", "Abonnement::index")->setName("abonnement");
$adminRoutes->add("/pack(/?)", "Pack::index")->setName("pack");
$adminRoutes->add("/type(/?)", "Type::index")->setName("type");
$adminRoutes->add("/image(/?)", "Image::index")->setName("image");
$adminRoutes->add("/periode(/?)", "Periode::index")->setName("periode");
$adminRoutes->add("/parametre(/?)", "Parametre::index")->setName("parametre");
$adminRoutes->add("/gallery(/?)", "Gallery::index")->setName("gallery");
$adminRoutes->add("/abonne(/?)", "Abonne::index")->setName("abonne");


//route pour les categories
$adminRoutes->add("/categorie/showCategorie(/?)", "Categorie::newCategorie")->setName("categorie-new-create");
$adminRoutes->add("/categorie/vue(/?)", "Categorie::vue")->setName("categorie-show-all");
$adminRoutes->add("/categorie/update(/?)", "Categorie::update")->setName("categorie-update");
$adminRoutes->add("/categorie/delete(/?)", "Categorie::delete")->setName("categorie-delete");

//route pour les clients
$adminRoutes->add("/client/newClient(/?)", "client::newClient")->setName("client-new-add");
$adminRoutes->add("/client/allClient(/?)", "client::allClient")->setName("client-view-all");
$adminRoutes->add("/client/contributeur(/?)", "client::contributeur")->setName("client-view-contributeur");
$adminRoutes->add("/client/abonne(/?)", "client::abonne")->setName("client-view-abonne");
$adminRoutes->add("/client/photographe(/?)", "client::photographe")->setName("client-view-photographe");
$adminRoutes->add("/client/espace(/?)", "client::espace")->setName("client-view-espace");

//route pour les packs
$adminRoutes->add("/pack/newPack(/?)", "pack::newPack")->setName("pack-new-add");
$adminRoutes->add("/pack/allPack(/?)", "pack::allPack")->setName("pack-view-all");

//route pour les types
$adminRoutes->add("/type/newType(/?)", "type::newType")->setName("type-new-add");
$adminRoutes->add("/type/allType(/?)", "type::allType")->setName("type-view-all");

//route pour les periodes
$adminRoutes->add("/periode/newPeriode(/?)", "periode::newPeriode")->setName("periode-new-add");
$adminRoutes->add("/periode/allPeriode(/?)", "periode::allPeriode")->setName("periode-view-all");

//route pour les abonnements
$adminRoutes->add("/abonnement/formule(/?)", "abonnement::formule")->setName("formule-new-create");
$adminRoutes->add("/abonnement/pack(/?)", "abonnement::pack")->setName("pack-new-create");
$adminRoutes->add("/abonnement/allAbonnement(/?)", "abonnement::allAbonnement")->setName("abonnement-show-all");

// route du contoller image
$adminRoutes->add("/image/newPicture(/?)", "image::newPicture")->setName("image-new-add");
$adminRoutes->add("/image/allPicture(/?)", "image::allPicture")->setName("image-view-all");
$adminRoutes->add("/image/upPicture(/?)", "image::upPicture")->setName("image-update-view");
$adminRoutes->add("/image/delPicture(/?)", "image::delPicture")->setName("image-delete-view");
// route pour les paamètres 
$adminRoutes->add("/parametre/access(/?)", "parametre::access")->setName("parametre-view-access");
$adminRoutes->add("/parametre/admin(/?)", "parametre::admin")->setName("parametre-view-admin");

// route pour les gallery
$adminRoutes->add("/gallery/image(/?)", "gallery::image")->setName("gallery-view-image");
$adminRoutes->add("/gallery/video(/?)", "gallery::video")->setName("gallery-view-video");

// route des abonnes
$adminRoutes->add("/abonne/inscrit(/?)", "abonne::inscrit")->setName("abonne-view-inscrit");
$adminRoutes->add("/abonne/contributeur(/?)", "abonne::contributeur")->setName("abonne-view-contributeur");
//$adminRoutes->add("/gallery/video(/?)", "abonne::video")->setName("gallery-view-video");

$router->mount($adminRoutes);


$router->removeExtraSlashes(true);

return $router;
