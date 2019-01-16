<?php

/**
 * ControllerBase
 *
 * Controller de base
 * 
 * @author Laurice TOPANOU <latomv@gmail.com>
 */

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('USPAFRICA | ');
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
}
