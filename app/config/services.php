<?php

/**
 * definition les services
 */
//<editor-fold desc="Declaration des services / Dependency Injector" defaultstate="collapsed">
//

/* @var $di Phalcon\Di */
$di = new Phalcon\DI\FactoryDefault();
$di->set('config', $config, true);

// service dispatcher
$di->set('dispatcher', function() {
    $eventsManager = $this->getShared('eventsManager');
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $dispatcher->setEventsManager($eventsManager);
    return $dispatcher;
}, true);


// service de base de donnees
$di->set('db', function() {
    $config = $this->get('config');
    return new \Phalcon\Db\Adapter\Pdo\Mysql($config->database->toArray());
}, true);
//service de routage
$di->set('router', function() {
    $config = $this->get('config');
    /* @var $router Phalcon\Mvc\Router */
    $router = require $config->application->path . 'config/routes.php';
    $router->setDefaultModule("site");
    return $router;
}, true);

//service url
$di->set('url', function() {
    $config = $this->get('config');
    $url = new \Phalcon\Mvc\Url(); //new UrlProvider();
    $url->setBaseUri($config->application->baseUri);
    return $url;
}, true);
//service root image
$di->set('imagerootDir', function() {
    $config = $this->get('config');
    //$url = new \Phalcon\Mvc\Url(); //new UrlProvider();
    $imagerootDir = $config->application->imagerootDir;
    return $imagerootDir;
}, true);

/**
 * add phpmailer library capabilities
 */
$di->set('PHPMailer', function() {
    $config = $this->get('config');
    require $config->application->classMail . "PHPMailerAutoload.php";
    $PHPMailer = new PHPMailer();
    return $PHPMailer;
});


// service des session utilisateur
$di->set('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
}, true);

//service Instance de l'utilisateur 
$di->set('loggeduser', function() {
    return UserLogged::getInstance();
}, true);

// Register the flash service with custom CSS classes
$di->set('flashSession', function () {
    $flashsession = new \Phalcon\Flash\Session(array(
        'error' => 'alert alert-danger fade in alert-dismissable',
        'success' => 'alert alert-success fade in alert-dismissable',
        'notice' => 'alert alert-info fade in alert-dismissable',
        'warning' => 'alert alert-warning fade in alert-dismissable'
    ));
    return $flashsession;
}, true);


//profiler
$di->set('profiler', function() {
    $profiler = new \Fabfuel\Prophiler\Profiler();
    $pluginManager = new \Fabfuel\Prophiler\Plugin\Manager\Phalcon($profiler);
    $pluginManager->register();
    $profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\QueryAggregator());
    //$profiler->addAggregator(new \Fabfuel\Prophiler\Aggregator\Database\CacheAggregator());
    return $profiler;
}, true);

//</editor-fold>
//
return $di;
