<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/30/2016
 * Time: 1:30 PM
 */

namespace ntesic\boilerplate\Helpers;


use Phalcon\Di;
use Phalcon\Session\Adapter\Files;

class Url extends \Phalcon\Mvc\Url
{

    public static function remember($url = null, $name = null)
    {
        if ($name === null) {
            $name = '__remember_url';
        }
        if ($url === null) {
            $url = $_SERVER['REQUEST_URI'];
        }
        /**
         * @var Files $session
         */
        $session = Di::getDefault()->get('session');
        $session->set($name, $url);
    }

    public static function previous($name = null)
    {
        if ($name === null)
        {
            $name = '__remember_url';
        }
        /**
         * @var Files $session
         */
        $session = Di::getDefault()->get('session');
        return $session->get($name);
    }
}