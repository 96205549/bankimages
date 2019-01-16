<?php
ob_start();
// Define path to application directory
if (!defined('APPLICATION_PATH')) {
    $applicationPath = realpath(__DIR__ . "/../app/");
    if (empty($applicationPath)) {
        exit();
    }
    define('APPLICATION_PATH', $applicationPath . DIRECTORY_SEPARATOR);
}

try {
    //chargement des parametres de configuration
    $config = new Phalcon\Config\Adapter\Ini(APPLICATION_PATH . 'config/settings.ini');
    $config['application']['path'] = APPLICATION_PATH;

    //chargement dynamique des classes
    $loader = require APPLICATION_PATH . 'config/loader.php';

    //definition du DI et des services
    /* @var $di Phalcon\Di */
    $di = require APPLICATION_PATH . 'config/services.php';

    

    //definition des modules
    $application = new \Phalcon\Mvc\Application($di);
    $application->registerModules(
        array(
            'site' => array(
                'className' => 'AfriqueStock\Site\Module',
                'path' => APPLICATION_PATH . 'Modules/Site/Module.php'
            ),
            'admin' => array(
                'className' => 'AfriqueStock\Administrateur\Module',
                'path' => APPLICATION_PATH . 'Modules/Administrateur/Module.php'
            )
        )
    );

   

    echo $application->handle()->getContent();
} catch (Exception $e) {
    //$logger = $di->get('logger');
   /* $logger->warning($e->getMessage(), [
        'file' => $e->getFile(),"line" => $e->getLine(),
         "exception"=>  get_class($e), 'trace' => $e->getTrace() 
    ]);*/
}
