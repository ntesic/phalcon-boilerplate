<?php
/**
 * @var Phalcon\Mvc\View $this
 */
$head_title = '<span class="logo-mini"><strong>' . $app_mini . '</strong></span><span class="logo-lg"><strong>' . $app_name . '</strong></span>';
?>

<header class="main-header">
    <?= $this->tag->linkTo($webtools_uri, $head_title, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
                <?php
                $deleteMenu = new \Ajax\bootstrap\html\content\HtmlDropdownItem('log-out');
                $deleteMenu->setCaption('<i class="glyphicon glyphicon-log-out">&nbsp;</i>Logout')->onClick('logOut();');
                $dropdownMenu = $this->jquery->bootstrap()->htmlDropdown('admin', '<span class="glyphicon glyphicon-user"></span> Profile', [$deleteMenu]);
                $dropdownMenu->asButton();
                $dropdownMenu->addBtnClass('btn-lg');
                $selectedMenu = $this->jquery->bootstrap()->htmlButtongroups('admin-group');
                $selectedMenu->addElement($dropdownMenu);
                echo $selectedMenu->compile($this->jquery);
                ?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                </li>
            </ul>
        </div>
    </nav>
</header>
