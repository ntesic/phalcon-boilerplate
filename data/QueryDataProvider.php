<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/18/2016
 * Time: 10:43 PM
 */

namespace ntesic\boilerplate\data;


use Phalcon\Exception;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Paginator\Adapter\QueryBuilder;

class QueryDataProvider extends BaseDataProvider
{

    /**
     * @var BuilderInterface the query that is used to fetch data models and [[totalCount]]
     * if it is not explicitly set.
     */
    public $query;

    protected function prepareModels()
    {
        $models = [];
        if (!$this->query instanceof BuilderInterface) {
            throw new Exception('The "query" property must be an instance of a class that implements the BuilderInterface e.g. Phalcon\Mvc\Model\Query\Builder or its subclasses.');
        }
        $this->setPagination(new QueryBuilder([
            'builder' => $this->query,
            'limit' => $this->request->get('perPage') ? $this->request->get('perPage', 'int') : 2,
            'page' => $this->request->get('page') ? $this->request->get('page', 'int') : 1,
        ]));
        foreach ($this->getPagination()->getPaginate()->items as $model) {
            $models[] = $model;
        }
        return $models;
        return $this->getPagination()->getPaginate()->items;
    }

    protected function prepareKeys($models)
    {
        /**
         * @var Model $model
         */
        $keys = [];
        foreach ($models as $index => $model)
        {
            $metaData = $this->modelsMetadata;
            $pks = $metaData->getPrimaryKeyAttributes($model);
            if (is_array($pks)) {
                foreach ($pks as $pk) {
                    $keys[$index][$pk] = $model->$pk;
                }
            } else {
                $keys[$index] = $model->$pks;
            }
        }
        return $keys;
    }

    protected function prepareTotalCount()
    {
        return $this->getPagination()->getPaginate()->total_items;
    }

}