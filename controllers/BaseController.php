<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/12/2016
 * Time: 8:47 AM
 */

namespace ntesic\boilerplate\controllers;


use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Mvc\Controller;
use Phalcon\Version;

class BaseController extends Controller
{
    public function onConstruct()
    {
        $this->setVars()
            ->setCss()
            ->setJs()
            ->setLayout()
            ->initialize();

    }

    public function initialize()
    {
return $this;
    }

    /**
     * @return $this
     */
    protected function setCss()
    {
        $path = VENDOR_PATH . '/almasaeed2010/adminlte/';
        $main_css = $this->assets
            ->collection('main_css');
        $main_css->setTargetPath('css/adminlte.css')
            ->setTargetUri('css/adminlte.css?v=' . Version::get())
//            ->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',false)
//            ->addCss($path . 'bootstrap/css/bootstrap.min.css', true)
//            ->addCss('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',false)
            ->addCss($path . 'dist/css/AdminLTE.min.css', true)
            ->addCss($path . 'dist/css/skins/_all-skins.min.css', true)
            ->join(true)
            ->addFilter(new Cssmin());
        return $this;
    }

    /**
     * @return $this
     */
    protected function setJs()
    {
        $path = VENDOR_PATH . '/almasaeed2010/adminlte/';
        $this->assets
            ->collection('footer')
            ->setTargetPath('js/js.js')
            ->setTargetUri('js/js.js?v=' . Version::get())
//            ->addJs('https://code.jquery.com/jquery-2.2.4.min.js', false, false)
//            ->addJs($path . 'bootstrap/js/bootstrap.min.js', true, false)
            ->addJs($path . 'dist/js/app.min.js', true, false)
            ->join(true)
            ->addFilter(new Jsmin());

        return $this;
    }

    /**
     * @return $this
     */
    protected function setLayout()
    {
        $viewDir = $this->view->getViewsDir();
        if (is_string($viewDir)) {
            $viewDir = [$viewDir];
        }
        $this->view->setViewsDir(array_merge($viewDir,[__DIR__ . '/../views']));
        return $this;
    }

    /**
     * @return $this
     */
    protected function setVars()
    {
        $this->view->setVars(
            [
                'base_uri' => $this->url->getBaseUri(),
                'webtools_uri' => rtrim('/', $this->url->getBaseUri()) . '/webtools.php',
                'ptools_version' => Version::get(),
                'phalcon_version' => '1',
                'phalcon_team' => 'Phalcon Team',
                'lte_team' => 'Almsaeed Studio',
                'phalcon_url' => 'https://www.phalconphp.com',
                'devtools_url' => 'https://github.com/phalcon/phalcon-devtools',
                'lte_url' => 'http://almsaeedstudio.com',
                'app_name' => 'Phalcon WebTools',
                'app_mini' => 'PWT',
                'lte_name' => 'AdminLTE',
                'copy_date' => '2011-' . date('Y'),
                'lte_date' => '2014-' . date('Y'),
                'jquery' => $this->jquery->genCDNs(),
            ]
        );
        return $this;
    }


}