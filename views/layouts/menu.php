<?php
$menu = [
    [
        'label' => 'Generator',
        'url' => ['#'],
        'icon' => 'fa fa-cube',
        'items' => [
            [
                'label' => 'CRUD Generator',
                'url' => ['/generator/crud'],
                'icon' => 'fa fa-cube',
            ],
            [
                'label' => 'Model Generator',
                'url' => ['/generator/model'],
                'icon' => 'fa fa-cube',
            ],
        ],
    ],
    [
        'label' => 'System Information',
        'url' => ['/system-info'],
        'icon' => 'fa fa-cube'
    ],
];

\ntesic\Widgets\Menu::widget([
    'options' => [
        'class' => 'sidebar-menu'
    ],
    'items' => array_merge_recursive(isset($mainMenu) ? $mainMenu : [], $menu),
]);
?>
