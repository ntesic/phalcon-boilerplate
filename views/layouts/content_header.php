<?php
/**
 * @var Phalcon\Mvc\View $this
 */
?>
<section class="content-header">
    <?php if (isset($page_title) && !empty($page_title)) { ?>
        <h1>
            <?= $page_title ?>
            <?php if ($page_subtitle && !empty($page_subtitle)) { ?>
            <small><?= $page_subtitle ?></small>
            <?php } ?>
        </h1>
    <?php } ?>
</section>
