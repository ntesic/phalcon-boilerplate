<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/12/2016
 * Time: 8:48 AM
 */

namespace ntesic\boilerplate\models;


use Phalcon\Mvc\Model;

class BaseModel extends Model
{
    /**
     * @var bool
     */
    protected $isNew = true;

    public function readAttribute($attribute)
    {
        return $this->$attribute;
    }

    /**
     * @return bool
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    protected function afterSave()
    {
        $this->isNew = false;
    }

    protected function afterFetch()
    {
        $this->isNew = false;
    }

}