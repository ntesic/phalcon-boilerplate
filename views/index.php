<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 * @var string $boilerplateViewDir
 */
?>
<?= $this->tag->getDocType() ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= $this->tag->getTitle() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="{{ phalcon_team }}" name="author">
    <link rel="shortcut icon" href="/favicon.ico?v={{ ptools_version }}">
    <?= $jquery ?>
    <?= $this->tag->stylesheetLink("https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&subset=latin,cyrillic-ext,cyrillic", false) ?>
    <?= $this->tag->stylesheetLink("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css", false) ?>
    <?= $this->tag->stylesheetLink("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css", false) ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <?= $this->assets->outputCss('main_css') ?>
    <?= $this->assets->collection('grid') ? $this->assets->outputCss('grid') : '' ?>
    <?php //$this->partial('layouts/custom_css'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php $this->partial('layouts/header'); ?>
    <?php $this->partial('layouts/sidebar'); ?>
    <div class="content-wrapper">
        <?php $this->partial('layouts/content_header'); ?>
        <?php $this->partial('layouts/content'); ?>
    </div>
    <?php $this->partial('layouts/footer'); ?>
    <div class="control-sidebar-bg"></div>
</div>
<?= $this->assets->outputJs('footer') ?>
<?= $this->assets->outputInlineJs() ?>
</body>
</html>
