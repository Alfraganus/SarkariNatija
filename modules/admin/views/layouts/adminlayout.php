<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\TeacherAsset;
use yii\helpers\Url;
TeacherAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="<?=Url::to(['/admin'])?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Welcome</b> Admin!</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- Notifications: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="<?=Url::to(['default/logout'])?>" >
                            <span class="hidden-xs">Log out</span>
                        </a>

                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?=Yii::$app->homeUrl;?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Admin</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Main</li>

                <li>
                    <a href="<?= Url::to(['/admin'])?>">
                        <i class="fa fa-dashboard"></i> <span>Main</span>
                    </a>
                </li>

                <li>
                    <a href="<?=Url::to(['user/'])?>">
                        <i class="fa fa-edit"></i> <span>Register user</span>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['post/'])?>">
                        <i class="fa fa-pencil"></i> <span>Posts</span>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['main-category/'])?>">
                        <i class="fa fa-pencil"></i> <span>Main categories</span>
                    </a>
                </li>

                <li>
                    <a href="<?=Url::to(['child-categories/'])?>">
                        <i class="fa fa-pencil"></i> <span>Child categories</span>
                    </a>
                </li>

                <li>
                    <a href="<?=Url::to(['fileupload/'])?>">
                        <i class="fa fa-upload"></i> <span>File upload</span>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['tag/'])?>">
                        <i class="fa fa-tags"></i> <span>Key words</span>
                    </a>
                </li>




        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <div class="container">
        <?= $content ?>
        </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
           
    </footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
