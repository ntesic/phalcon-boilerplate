<?php
/**
 * Copyright (c) 2016.
 * @author Nikola Tesic (nikolatesic@gmail.com)
 */

/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/16/2016
 * Time: 2:12 PM
 */

namespace ntesic\boilerplate\grid;



use ntesic\boilerplate\Helpers\Tag;
use Phalcon\Exception;

class CheckboxColumn extends Column
{

    /**
     * @var string the name of the input checkbox input fields. This will be appended with `[]` to ensure it is an array.
     */
    public $name = 'selection';
    /**
     * @var array|\Closure the HTML attributes for checkboxes. This can either be an array of
     * attributes or an anonymous function ([[Closure]]) that returns such an array.
     * The signature of the function should be the following: `function ($model, $key, $index, $column)`.
     * Where `$model`, `$key`, and `$index` refer to the model, key and index of the row currently being rendered
     * and `$column` is a reference to the [[CheckboxColumn]] object.
     * A function may be used to assign different attributes to different rows based on the data in that row.
     * Specifically if you want to set a different value for the checkbox
     * you can use this option in the following way (in this example using the `name` attribute of the model):
     *
     * ```php
     * 'checkboxOptions' => function ($model, $key, $index, $column) {
     *     return ['value' => $model->name];
     * }
     * ```
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $checkboxOptions = [];
    /**
     * @var boolean whether it is possible to select multiple rows. Defaults to `true`.
     */
    public $multiple = true;
    /**
     * @var string the css class that will be used to find the checkboxes.
     * @since 2.0.9
     */
    public $cssClass = 'sel';

    public function init()
    {
        parent::init();
        if (empty($this->name)) {
            throw new Exception('The "name" property must be set.');
        }
        if (substr_compare($this->name, '[]', -2, 2)) {
            $this->name .= '[]';
        }
        $this->registerJsScript();
        $this->registerClientScript();
    }

    /**
     * Renders the header cell content.
     * The default implementation simply renders [[header]].
     * This method may be overridden to customize the rendering of the header cell.
     * @return string the rendering result
     */
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || !$this->multiple) {
            return parent::renderHeaderCellContent();
        } else {
            return Tag::checkField([$this->getHeaderCheckBoxName(), false, 'class' => 'select-on-check-all']);
        }
    }

    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->checkboxOptions instanceof \Closure) {
            $options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
        } else {
            $options = $this->checkboxOptions;
        }

        if (!isset($options['value'])) {
            $options['value'] = is_array($key) ? json_encode($key) : $key;
        }

        if ($this->cssClass !== null) {
            Tag::addCssClass($options, $this->cssClass);
        }
//        return Tag::checkField([$this->name, false, 'value' => $model->$key]);
        return Tag::checkField([$this->name, !empty($options['checked']), $options]);
//        return Tag::checkField([$this->name, !empty($options['checked']), 'class'=>'sel']);
//        return Html::checkbox($this->name, !empty($options['checked']), $options);
    }


    /**
     * Returns header checkbox name
     * @return string header checkbox name
     * @since 2.0.8
     */
    protected function getHeaderCheckBoxName()
    {
        $name = $this->name;
        if (substr_compare($name, '[]', -2, 2) === 0) {
            $name = substr($name, 0, -2);
        }
        if (substr_compare($name, ']', -1, 1) === 0) {
            $name = substr($name, 0, -1) . '_all]';
        } else {
            $name .= '_all';
        }

        return $name;
    }

    protected function registerJsScript()
    {
//        $js = <<<JS
//        $('document').ready(function(){
//            $("#selection_all").change(function () {
//                $("input:checkbox").prop('checked', $(this).prop("checked"));
//            });
//        });
//JS;
        $this->jquery->change('#selection_all','$("input:checkbox").prop(\'checked\', $(this).prop("checked"));');
//        $this->jquery->ready($js);
        $this->jquery->compile($this->view);
//        $this->assets->addInlineJs($js);
    }

    /**
     * Registers the needed JavaScript
     * @since 2.0.8
     */
    public function registerClientScript()
    {
        $id = $this->grid->options['id'];
        $options = json_encode([
            'name' => $this->name,
            'class' => $this->cssClass,
            'multiple' => $this->multiple,
            'checkAll' => $this->grid->showHeader ? $this->getHeaderCheckBoxName() : null,
        ]);
        $this->assets->addInlineJs("jQuery('#$id').gridView('setSelectionColumn', $options);");
//        $this->grid->getView()->registerJs("jQuery('#$id').yiiGridView('setSelectionColumn', $options);");
    }
}