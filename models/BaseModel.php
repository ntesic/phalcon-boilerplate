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


use ntesic\boilerplate\Helpers\Text;
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
     * Returns the text label for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute label
     * @see generateAttributeLabel()
     * @see attributeLabels()
     */
    public function getAttributeLabel($attribute)
    {
        $labels = $this->labels();
        return isset($labels[$attribute]) ? $labels[$attribute] : $this->generateAttributeLabel($attribute);
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

    /**
     * Generates a user friendly attribute label based on the give attribute name.
     * This is done by replacing underscores, dashes and dots with blanks and
     * changing the first letter of each word to upper case.
     * For example, 'department_name' or 'DepartmentName' will generate 'Department Name'.
     * @param string $name the column name
     * @return string the attribute label
     */
    public function generateAttributeLabel($name)
    {
        return Text::camel2words($name, true);
    }
}