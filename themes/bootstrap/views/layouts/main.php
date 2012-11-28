<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo Yii::app()->theme->baseUrl; ?>/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Project name</a>

            <div class="nav-collapse collapse">
                <?php $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array(
                    'class' => 'nav',
                ),
                'items' => array(
                    array('label' => Yii::t('app', 'Home'), 'url' => array('/')),
                    array('label' => 'Adauga', 'url' => array('/tDb/create'), 'visible' => !Yii::app()->user->isGuest, 'linkOptions' => array('class' => 'specialsel')),
                    //array('label' => 'Rapoarte', 'url' => 'http://217.12.116.70/v1/reports.php', 'visible' => !Yii::app()->user->isGuest),
                    //array('label' => 'Contact', 'url' => array('/site/contact')),
                    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                ),
            )); ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<?php if (isset($this->breadcrumbs)): ?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => $this->breadcrumbs,
    'htmlOptions'=>array(
        'class'=>'breadcrumb',
    ),
)); ?><!-- breadcrumbs -->
    <?php endif?>

<div class="container">

    <?php echo $content; ?>

</div>
<!-- /container -->

<!-- Le javascript
================================================== -->

<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->theme->baseUrl . '/js/bootstrap.min.js'
);
?>
</body>
</html>