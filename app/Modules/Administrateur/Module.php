<?php

/**
 * Description of Module
 *
 * @author Laurice TOPANOU <latomv@gmail.com>
 */

namespace afriqueStock\Administrateur;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    public function registerAutoloaders(DiInterface $dependencyInjector = NULL)
    {
        $loader = new \Phalcon\Loader();
        $controllersFolder = __DIR__ . "/Controllers/";
        $loader->registerDirs(array($controllersFolder), true)->register();
        $loader->registerNamespaces(array(
            "afriqueStock\Administrateur" => $controllersFolder,
                ), true);
    }

    public function registerServices(DiInterface $di)
    {
        $di->set('view', function () {
            $view = new \Phalcon\Mvc\View();
            $viewsFolder = __DIR__ . "/views";
            $view->setViewsDir($viewsFolder);
            return $view;
        });
    }

}
