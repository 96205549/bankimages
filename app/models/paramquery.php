<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of paramquery
 *
 * @author PHP_Webdev
 */
use Phalcon\Mvc\Model;

class paramquery extends model {
    //put your code here
    
    public static function arrayConditions(array $conditions, array $parameteres=[]) {
        if(count($conditions)>0) {
            $c = '';
            foreach($conditions as $field=>$value) $c.= ' AND '.$field.'=:'.$field.':';
            $c = substr($c,5);
            $parameters = array_merge($parameters, [
                'conditions' => $c,
                'bind' => $conditions,
            ]);
        }
        return $parameters;
    }
    
}
