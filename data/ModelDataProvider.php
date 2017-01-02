<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/18/2016
 * Time: 11:12 PM
 */

namespace ntesic\boilerplate\data;


use Phalcon\Exception;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Paginator\Adapter\Model;

class ModelDataProvider extends QueryDataProvider
{

    public $model;

    public function prepareModels()
    {
        $models = [];
        if (!$this->model instanceof Resultset) {
            throw new Exception('The "query" property must be an instance of a class that implements the Resultset');
        }
        $this->setPagination(new Model([
            'data' => $this->model,
            'limit' => $this->request->get('perPage') ? $this->request->get('perPage', 'int') : 2,
            'page' => $this->request->get('page') ? $this->request->get('page', 'int') : 1,
        ]));
        foreach ($this->getPagination()->getPaginate()->items as $model) {
            $models[] = $model;
        }
        return $models;
        return $this->getPagination()->getPaginate()->items;
    }
}