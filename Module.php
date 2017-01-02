<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/12/2016
 * Time: 8:41 AM
 */
namespace ntesic\boilerplate;

use ntesic\boilerplate\Routes\GeneratorRoutes;
use ntesic\boilerplate\Services\BoilerplateService;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    public function registerAutoloaders(DiInterface $di = null)
    {
    }

    public function registerServices(DiInterface $di)
    {
        $di->setShared('boilerplate', new BoilerplateService());

        /**
         * Setting up the view component
         */
        $di->setShared('view', function () use ($di) {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/generator/crud/views/');
            $view->registerEngines(array(
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
                '.php' => 'Phalcon\Mvc\View\Engine\Php',
                '.volt' => 'Phalcon\Mvc\View\Engine\Volt',
            ));
            return $view;
        });
    }

}