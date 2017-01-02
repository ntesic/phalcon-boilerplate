<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/12/2016
 * Time: 8:44 AM
 */

namespace ntesic\boilerplate\Services;


use ntesic\boilerplate\Helpers\FileHelper;
use Phalcon\Di;
use Phalcon\Di\InjectionAwareInterface;

class BoilerplateService implements InjectionAwareInterface
{
    /**
     * @var Di
     */
    protected $di;

    public function getDI()
    {
        return $this->di;
    }

    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
    }

    public function getBasePath()
    {
        return FileHelper::normalizePath(__DIR__ . '/..');
    }

    public function initialize()
    {
        $this->di->get('loader')->registerNamespaces([
            'App\Models' => APP_PATH . '/models/',
            'App\Plugins' => APP_PATH . '/plugins/',
            'App\Widgets' => APP_PATH . '/widgets/',
            'App\Helpers' => APP_PATH . '/helpers/',
            'Test\Models' => APP_PATH . '/common/models/',
            'Test'        => APP_PATH . '/common/library/',
            'Ajax' => APP_PATH . '/../vendor/jcheron/phalcon-jquery/Ajax/'
        ]);
        $this->di->set("jquery",function(){
            $jquery= new Ajax\JsUtils(array("driver"=>"Jquery"));
            $jquery->ui(new Ajax\JqueryUI());//optional for JQuery UI
            $jquery->bootstrap(new Ajax\Bootstrap());//Optional for Twitter Bootstrap
            return $jquery;
        });
    }

}