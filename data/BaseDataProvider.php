<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/18/2016
 * Time: 10:34 PM
 */

namespace ntesic\boilerplate\data;


use Phalcon\Exception;
use Phalcon\Mvc\User\Component;
use Phalcon\Paginator\AdapterInterface;

abstract class BaseDataProvider extends Component implements DataProviderInterface
{

    private $pagination;
    private $keys;
    private $models;
    private $totalCount;


    /**
     * Prepares the data models that will be made available in the current page.
     * @return array the available data models
     */
    abstract protected function prepareModels();

    /**
     * Prepares the keys associated with the currently available data models.
     * @param array $models the available data models
     * @return array the keys
     */
    abstract protected function prepareKeys($models);

    /**
     * Returns a value indicating the total number of data models in this data provider.
     * @return integer total number of data models in this data provider.
     */
    abstract protected function prepareTotalCount();

    public function __construct($options = [])
    {
        foreach ($options as $option => $value)
        {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }

    /**
     * Prepares the data models and keys.
     *
     * This method will prepare the data models and keys that can be retrieved via
     * [[getModels()]] and [[getKeys()]].
     *
     * This method will be implicitly called by [[getModels()]] and [[getKeys()]] if it has not been called before.
     *
     * @param boolean $forcePrepare whether to force data preparation even if it has been done before.
     */
    public function prepare($forcePrepare = false)
    {
        if ($forcePrepare || $this->models === null) {
            $this->models = $this->prepareModels();
        }
        if ($forcePrepare || $this->keys === null) {
            $this->keys = $this->prepareKeys($this->models);
        }
    }

    /**
     * Returns the data models in the current page.
     * @return array the list of data models in the current page.
     */
    public function getModels()
    {
        $this->prepare();

        return $this->models;
    }

    /**
     * Sets the data models in the current page.
     * @param array $models the models in the current page
     */
    public function setModels($models)
    {
        $this->models = $models;
    }

    /**
     * Returns the key values associated with the data models.
     * @return array the list of key values corresponding to [[models]]. Each data model in [[models]]
     * is uniquely identified by the corresponding key value in this array.
     */
    public function getKeys()
    {
        $this->prepare();

        return $this->keys;
    }

    /**
     * Sets the key values associated with the data models.
     * @param array $keys the list of key values corresponding to [[models]].
     */
    public function setKeys($keys)
    {
        $this->keys = $keys;
    }

    /**
     * Returns the number of data models in the current page.
     * @return integer the number of data models in the current page.
     */
    public function getCount()
    {
        return count($this->getModels());
    }

    /**
     * Returns the total number of data models.
     * When [[pagination]] is false, this returns the same value as [[count]].
     * Otherwise, it will call [[prepareTotalCount()]] to get the count.
     * @return integer total number of possible data models.
     */
    public function getTotalCount()
    {
        if ($this->getPagination() === false) {
            return $this->getCount();
        } elseif ($this->totalCount === null) {
            $this->totalCount = $this->prepareTotalCount();
        }

        return $this->totalCount;
    }

    /**
     * Sets the total number of data models.
     * @param integer $value the total number of data models.
     */
    public function setTotalCount($value)
    {
        $this->totalCount = $value;
    }

    /**
     * Returns the pagination object used by this data provider.
     * Note that you should call [[prepare()]] or [[getModels()]] first to get correct values
     * of [[Pagination::totalCount]] and [[Pagination::pageCount]].
     * @return AdapterInterface|false the pagination object. If this is false, it means the pagination is disabled.
     */
    public function getPagination()
    {
        if ($this->pagination === null) {
            $this->setPagination([]);
        }

        return $this->pagination;
    }

    /**
     * Sets the pagination for this data provider.
     * @param array|AdapterInterface|boolean $value the pagination to be used by this data provider.
     * This can be one of the following:
     *
     * - a configuration array for creating the pagination object. The "class" element defaults
     *   to 'yii\data\Pagination'
     * - an instance of [[Pagination]] or its subclass
     * - false, if pagination needs to be disabled.
     *
     * @throws Exception
     */
    public function setPagination($value)
    {
        if ($value instanceof AdapterInterface || $value === false) {
            $this->pagination = $value;
        } else {
            throw new Exception('Only Pagination instance, configuration array or false is allowed.');
        }
    }

    /**
     * Refreshes the data provider.
     * After calling this method, if [[getModels()]], [[getKeys()]] or [[getTotalCount()]] is called again,
     * they will re-execute the query and return the latest data available.
     */
    public function refresh()
    {
        $this->totalCount = null;
        $this->models = null;
        $this->keys = null;
    }
}