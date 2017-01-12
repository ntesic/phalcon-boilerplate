<?php
/**
 * Created by PhpStorm.
 * User: Nikola
 * Date: 12/18/2016
 * Time: 11:24 PM
 */

namespace ntesic\boilerplate\grid;


use ntesic\boilerplate\data\DataProviderInterface;
use ntesic\boilerplate\Helpers\ArrayHelper;
use ntesic\boilerplate\Helpers\Tag;
use ntesic\Widgets\Widget;
use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Exception;
use Phalcon\Paginator\AdapterInterface;
use Phalcon\Paginator\Pager;

class BaseGridView extends Widget
{
    /**
     * @var DataProviderInterface the data provider for the view. This property is required.
     */
    public $dataProvider;
    /**
     * @var array the configuration for the pager widget. By default, [[LinkPager]] will be
     * used to render the pager. You can use a different widget class by configuring the "class" element.
     * Note that the widget must support the `pagination` property which will be populated with the
     * [[\yii\data\BaseDataProvider::pagination|pagination]] value of the [[dataProvider]].
     */
    public $pager = [];
    /**
     * @var array the configuration for the sorter widget. By default, [[LinkSorter]] will be
     * used to render the sorter. You can use a different widget class by configuring the "class" element.
     * Note that the widget must support the `sort` property which will be populated with the
     * [[\yii\data\BaseDataProvider::sort|sort]] value of the [[dataProvider]].
     */
    public $sorter = [];
    /**
     * @var string the HTML content to be displayed as the summary of the list view.
     * If you do not want to show the summary, you may set it with an empty string.
     *
     * The following tokens will be replaced with the corresponding values:
     *
     * - `{begin}`: the starting row number (1-based) currently being displayed
     * - `{end}`: the ending row number (1-based) currently being displayed
     * - `{count}`: the number of rows currently being displayed
     * - `{totalCount}`: the total number of rows available
     * - `{page}`: the page number (1-based) current being displayed
     * - `{pageCount}`: the number of pages available
     */
    public $summary;
    /**
     * @var array the HTML attributes for the summary of the list view.
     * The "tag" element specifies the tag name of the summary element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $summaryOptions = ['class' => 'summary'];
    /**
     * @var boolean whether to show the list view if [[dataProvider]] returns no data.
     */
    public $showOnEmpty = false;
    /**
     * @var string the HTML content to be displayed when [[dataProvider]] does not have any data.
     */
    public $emptyText;
    /**
     * @var array the HTML attributes for the emptyText of the list view.
     * The "tag" element specifies the tag name of the emptyText element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $emptyTextOptions = ['class' => 'empty'];
    /**
     * @var string the layout that determines how different sections of the list view should be organized.
     * The following tokens will be replaced with the corresponding section contents:
     *
     * - `{summary}`: the summary section. See [[renderSummary()]].
     * - `{items}`: the list items. See [[renderItems()]].
     * - `{sorter}`: the sorter. See [[renderSorter()]].
     * - `{pager}`: the pager. See [[renderPager()]].
     */
    public $layout = "{summary}\n{items}\n{pager}";

    /**
     * @var array the HTML attributes for the container of the rendering result of each data model.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * If "tag" is false, it means no container element will be rendered.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = [];
    /**
     * @var string|callable the name of the view for rendering each data item, or a callback (e.g. an anonymous function)
     * for rendering each data item. If it specifies a view name, the following variables will
     * be available in the view:
     *
     * - `$model`: mixed, the data model
     * - `$key`: mixed, the key value associated with the data item
     * - `$index`: integer, the zero-based index of the data item in the items array returned by [[dataProvider]].
     * - `$widget`: ListView, this widget instance
     *
     * Note that the view name is resolved into the view file by the current context of the [[view]] object.
     *
     * If this property is specified as a callback, it should have the following signature:
     *
     * ```php
     * function ($model, $key, $index, $widget)
     * ```
     */
    public $itemView;
    /**
     * @var array additional parameters to be passed to [[itemView]] when it is being rendered.
     * This property is used only when [[itemView]] is a string representing a view name.
     */
    public $viewParams = [];
    /**
     * @var string the HTML code to be displayed between any two consecutive items.
     */
    public $separator = "\n";
    /**
     * @var array the HTML attributes for the container tag of the list view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'list-view'];

    /**
     * Initializes the view.
     */
    public function initialize()
    {
        if ($this->dataProvider === null) {
            throw new Exception('The "dataProvider" property must be set.');
        }
        if ($this->emptyText === null) {
            $this->emptyText = 'No results found.';
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = rand(1, 1000);
        }
        $this->registerAssets();
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback("/{\\w+}/", function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Tag::tag($tag, $content, $options);
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{summary}':
                return $this->renderSummary();
            case '{items}':
                return $this->renderItems();
            case '{pager}':
                return $this->renderPager();
            case '{sorter}':
                return $this->renderSorter();
            default:
                return false;
        }
    }

    /**
     * Renders the HTML content indicating that the list view has no data.
     * @return string the rendering result
     * @see emptyText
     */
    public function renderEmpty()
    {
        $options = $this->emptyTextOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Tag::tag($tag, $this->emptyText, $options);
    }

    /**
     * Renders the summary text.
     */
    public function renderSummary()
    {
        $range = (($this->dataProvider->getPagination()->getCurrentPage() - 1) * $this->dataProvider->getPagination()->getLimit()) + 1 . '-' . $this->dataProvider->getPagination()->getCurrentPage() * $this->dataProvider->getPagination()->getLimit();
        return Tag::tag('div', 'Showing <b>' . $range . '</b> of <b>' . $this->dataProvider->getTotalCount() . '</b> items.', $this->summaryOptions);
        return '';
//        $count = $this->dataProvider->getCount();
//        if ($count <= 0) {
//            return '';
//        }
//        $summaryOptions = $this->summaryOptions;
//        $tag = ArrayHelper::remove($summaryOptions, 'tag', 'div');
//        /**
//         * @var AdapterInterface $pagination
//         */
//        if (($pagination = $this->dataProvider->getPagination()) !== false) {
//            $totalCount = $this->dataProvider->getTotalCount();
//            $begin = $pagination->getPage() * $pagination->pageSize + 1;
//            $end = $begin + $count - 1;
//            if ($begin > $end) {
//                $begin = $end;
//            }
//            $page = $pagination->getPage() + 1;
//            $pageCount = $pagination->pageCount;
//            if (($summaryContent = $this->summary) === null) {
//                return Html::tag($tag, Yii::t('yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.', [
//                    'begin' => $begin,
//                    'end' => $end,
//                    'count' => $count,
//                    'totalCount' => $totalCount,
//                    'page' => $page,
//                    'pageCount' => $pageCount,
//                ]), $summaryOptions);
//            }
//        } else {
//            $begin = $page = $pageCount = 1;
//            $end = $totalCount = $count;
//            if (($summaryContent = $this->summary) === null) {
//                return Html::tag($tag, Yii::t('yii', 'Total <b>{count, number}</b> {count, plural, one{item} other{items}}.', [
//                    'begin' => $begin,
//                    'end' => $end,
//                    'count' => $count,
//                    'totalCount' => $totalCount,
//                    'page' => $page,
//                    'pageCount' => $pageCount,
//                ]), $summaryOptions);
//            }
//        }
//
//        return Yii::$app->getI18n()->format($summaryContent, [
//            'begin' => $begin,
//            'end' => $end,
//            'count' => $count,
//            'totalCount' => $totalCount,
//            'page' => $page,
//            'pageCount' => $pageCount,
//        ], Yii::$app->language);
    }

    /**
     * Renders the pager.
     * @return string the rendering result
     */
    public function renderPager()
    {
        $content = Tag::tagHtml('div', ['style' => 'padding:10px'], false, false, true);
        $pager = new Pager($this->dataProvider->getPagination(), [
            // We will use Bootstrap framework styles
            'layoutClass' => '\Phalcon\Paginator\Pager\Layout\Bootstrap',
            'rangeLength' => 5,
            // Just a string with URL mask
            'urlMask' => '?page={%page_number}',
            // Or something like this
            // 'urlMask'     => sprintf(
            //     '%s?page={%%page_number}',
            //     $this->url->get([
            //         'for'        => 'index:posts',
            //         'controller' => 'index',
            //         'action'     => 'index'
            //     ])
            // ),
        ]);
        $content .= Tag::tagHtml('ul', ['class' => 'pagination'], false, false, true);
        if ($pager->haveToPaginate()) {
            $content .= $pager->getLayout();
        }
        $content .= Tag::tagHtmlClose('ul');
        $content .= Tag::tagHtmlClose('div');
        return $content;
    }

//    /**
//     * Renders the sorter.
//     * @return string the rendering result
//     */
//    public function renderSorter()
//    {
//        $sort = $this->dataProvider->getSort();
//        if ($sort === false || empty($sort->attributes) || $this->dataProvider->getCount() <= 0) {
//            return '';
//        }
//        /* @var $class LinkSorter */
//        $sorter = $this->sorter;
//        $class = ArrayHelper::remove($sorter, 'class', LinkSorter::className());
//        $sorter['sort'] = $sort;
//        $sorter['view'] = $this->getView();
//
//        return $class::widget($sorter);
//    }

    /**
     * Renders all data models.
     * @return string the rendering result
     */
    public function renderItems()
    {
        $models = $this->dataProvider->getModels();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach (array_values($models) as $index => $model) {
            $rows[] = $this->renderItem($model, $keys[$index], $index);
        }

        return implode($this->separator, $rows);
    }

    /**
     * Renders a single data model.
     * @param mixed $model the data model to be rendered
     * @param mixed $key the key value associated with the data model
     * @param integer $index the zero-based index of the data model in the model array returned by [[dataProvider]].
     * @return string the rendering result
     */
    public function renderItem($model, $key, $index)
    {
        if ($this->itemView === null) {
            $content = $key;
        } elseif (is_string($this->itemView)) {
            $content = $this->getView()->render($this->itemView, array_merge([
                'model' => $model,
                'key' => $key,
                'index' => $index,
                'widget' => $this,
            ], $this->viewParams));
        } else {
            $content = call_user_func($this->itemView, $model, $key, $index, $this);
        }
        $options = $this->itemOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        $options['data-key'] = is_array($key) ? json_encode($key, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : (string)$key;

        return Tag::tag($tag, $content, $options);
    }

    public function registerAssets()
    {
        $this->assets->collection('grid')
            ->addCss(VENDOR_PATH . '/ntesic/phalcon-boilerplate/assets/css/grid.css', true)
            ->setTargetPath('css/grid.css')
            ->setTargetUri('css/grid.css')
            ->addFilter(new Cssmin())
            ->join(true);
        $this->assets->collection('footer')
            ->addJs(VENDOR_PATH . '/ntesic/phalcon-boilerplate/assets/js/grid.js', true)
            ->addJs(VENDOR_PATH . '/ntesic/phalcon-boilerplate/assets/js/delete-multiple.js', true);
    }
}