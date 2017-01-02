<?php
$menu = [
    [
        'label' => 'Site',
        'url' => ['/site'],
        'icon' => 'fa fa-cube'
    ],
    [
        'label' => 'Category',
        'url' => ['/category'],
        'icon' => 'fa fa-cube'
    ],
    [
        'label' => 'Content',
        'url' => ['/content'],
        'icon' => 'fa fa-cube'
    ],
    [
        'label' => 'Paysite',
        'url' => ['/paysite'],
        'icon' => 'fa fa-cube'
    ]
];

\ntesic\Widgets\Menu::widget([
    'options' => [
        'class' => 'sidebar-menu'
    ],
    'items' => array_merge_recursive($mainMenu, $menu),
]);
?>
