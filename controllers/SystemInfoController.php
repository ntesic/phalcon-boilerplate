<?php
/**
 * Copyright (c) 2017.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 1/4/2017
 * Time: 4:30 PM
 */

namespace ntesic\boilerplate\controllers;


use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Version;
use probe\Factory;

class SystemInfoController extends BaseController
{

    public function IndexAction()
    {
        $provider = Factory::create();
        $this->view->setVars([
            'provider' => $provider,
        ]);
        if ($this->request->isAjax()) {
            if ($key = $this->request->get('data'))
            {
                switch ($key)
                {
                    case 'cpu_usage':
                        $this->response->setJsonContent($provider->getCpuUsage());
                        break;
                    case 'memory_usage':
                        $this->response->setJsonContent(($provider->getTotalMem() - $provider->getFreeMem()) / $provider->getTotalMem());
                        break;
                }
                return $this->response;
            }
            $this->view->disable();
        } else {
            $this->assets->collection('system-info')
                ->setTargetPath('js/system-info.js')
                ->setTargetUri('js/system-info.js?v=' . Version::get())
                ->addJs(VENDOR_PATH . '/bower/flot/jquery.flot.js',true)
                ->addJs(VENDOR_PATH . '/ntesic/phalcon-boilerplate/assets/js/system-info.js',true)
                ->join(true)
                ->addFilter(new Jsmin());

        }
    }
}