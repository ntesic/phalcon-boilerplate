<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/27/2016
 * Time: 11:13 AM
 */

namespace ntesic\boilerplate\Form;


use ntesic\boilerplate\Helpers\Tag;
use ntesic\boilerplate\Helpers\Text;
use Phalcon\Forms\Exception;
use Phalcon\Mvc\Model;

class Form extends \Phalcon\Forms\Form
{

    public $labelClass = 'control-label col-sm-3';
    public $elementClass = 'col-sm-6';
    public $buttons;
    public $method = 'POST';
    public $action;
    public $enctype = 'multipart/form-data';
    public $target;
    public $class;
    public $layout = 'form-horizontal';
    public $indent;


    public function __construct(array $options = [])
    {
//        if (!isset($options['model']) || empty($options['model'])) {
//            throw new Exception('Model need to be set');
//        } elseif (!$options['model'] instanceof Model) {
//            throw new Exception('Model passed to form need to be instance of Phalcon\Mvc\Model');
//        }
        if (isset($options['model'])) {
            parent::__construct($options['model']);
        } else {
            parent::__construct();
        }
        $this->initialize();
        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }

    public function initialize()
    {
        $this->defaultAction();
        $this->defaultButtons();
    }

    public function renderForm()
    {
        $formParams = [
            null,
            'method' => $this->method,
            'role' => 'form',
            'class' => $this->layout . ($this->class ? ' ' . $this->class : ''),
            'enctype' => $this->enctype,
        ];
        echo $this->indent() . Tag::form($formParams) . PHP_EOL;
        foreach ($this as $element) {
            //Get any generated messages for the current element
            $messages = $this->getMessagesFor($element->getName());
            if (count($messages)) {
                $groupClass = 'form-group has-error';
            } else {
                $groupClass = 'form-group';
            }
            echo $this->indent(1) . Tag::tagHtml('div', ['class' => $groupClass]) . PHP_EOL;
            $label = $element->getLabel() ? $element->getLabel() : Text::camel2words($element->getName());
            echo $this->indent(2) . Tag::tagHtml('label', ['for' => $element->getName(), 'class' => $this->labelClass]);
            echo $label;
            echo Tag::tagHtmlClose('label') . PHP_EOL;
            echo $this->indent(2) . Tag::tagHtml('div', ['class' => $this->elementClass]) . PHP_EOL;
            echo $this->indent(3) . $element->render(['class' => 'form-control']) . PHP_EOL;
            echo $this->indent(2) . Tag::tagHtmlClose('div') . PHP_EOL;
            echo $this->indent(1) . Tag::tagHtmlClose('div') . PHP_EOL;
        }
        echo $this->indent(1) . Tag::tagHtml('hr') . PHP_EOL;
        echo $this->indent(1) . $this->getErrors() . PHP_EOL;
        echo $this->flashSession->output();
        echo $this->getButtons();
        echo $this->indent() . Tag::endForm() . PHP_EOL;
    }

    protected function defaultAction()
    {
        $this->action = $this->router->getModuleName() . '/' . $this->router->getControllerName() . '/' . $this->router->getActionName();
    }

    protected function defaultButtons()
    {
        $this->buttons = [
            Tag::tagHtml('button', ['type' => 'submit', 'class' => 'btn btn-success']) . '<span class="glyphicon glyphicon-check"></span> Save' . Tag::tagHtmlClose('button') . PHP_EOL,
            ($this->_entity && !$this->_entity->isNew) ? Tag::linkTo([
                'action' => $this->url->get('delete', $this->buildParams(), null, $this->router->getModuleName() . '/' . $this->router->getControllerName() . '/'),
                'text' => '<span class="glyphicon glyphicon-trash"></span> Delete',
                'class' => 'btn btn-danger',
            ]) . PHP_EOL : '',
        ];
    }

    protected function getButtons()
    {
        $output = '';
        foreach ($this->buttons as $button) {
            $output .= $this->indent(1) . $button;
        }
        return $output;
    }

    protected function indent($times = null)
    {
        if ($this->indent !== null) {
            return str_repeat("\t", $this->indent + $times);
        }
    }

    protected function getErrors()
    {
        $messages = $this->getMessages();
        $output = '';
        if (count($messages)) {
            $output .= '<div class="error-summary alert alert-error"><p>Please fix the following errors:</p><ul>';
            foreach ($messages as $message) {
                $output .= '<li>' . $message . '</li>';
            }
            $output .= '</ul></div>';
        }
        return $output;
    }

    protected function buildParams()
    {
        /**
         * @var Model\MetaData\Memory $metaData
         */
        $metaData = $this->modelsMetadata;
        $pks = $metaData->getPrimaryKeyAttributes($this->_entity);
        $output = [];
        foreach ($pks as $pk) {
            $output[$pk]= $this->_entity->$pk;
        }
        return $output;
    }

}