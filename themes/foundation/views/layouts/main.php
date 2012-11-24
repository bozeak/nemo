<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8"/>

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Included CSS Files (Uncompressed) -->
    <!--
    <link rel="stylesheet" href="stylesheets/foundation.css">
    -->

    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/foundation.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/app.css">

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/modernizr.foundation.js"></script>

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>

<div class="row">
    <div class="twelve columns">
        <?php echo CHtml::link(CHtml::image('images/logo_c.png', 'Aviz'), Yii::app()->homeUrl ); ?>
        <hr/>
        <?php $this->widget('zii.widgets.CMenu', array(
        'htmlOptions' => array(
            'class' => 'nav-bar',
        ),
        'items' => array(
            array('label' => Yii::t('app', 'Home'), 'url' => array('/')),
            array('label' => 'Adauga', 'url' => array('/tDb/create'), 'visible' => !Yii::app()->user->isGuest, 'linkOptions' => array('class' => 'specialsel')),
            //array('label' => 'Rapoarte', 'url' => 'http://217.12.116.70/v1/reports.php', 'visible' => !Yii::app()->user->isGuest),
            //array('label' => 'Contact', 'url' => array('/site/contact')),
            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest, 'htmlOptions'=>
                array(
                    'id'=>'myModal2',
                ),
            ),
            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
        ),
    )); ?>
    </div>
</div>

<div class="row">
    <div class="twelve columns">

    </div>
</div>

<div class="row">
    <div class="twelve columns">
        <?php echo $content; ?>
    </div>
</div>

<script src="javascripts/jquery.js"></script>
<script src="javascripts/jquery.foundation.forms.js"></script>
<script src="javascripts/jquery.foundation.tooltips.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#buttonForModal").click(function() {
            $("#myModal").reveal();
        });
    });
</script>

<!-- Included JS Files (Uncompressed) -->
<!--



<script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>



<script src="javascripts/jquery.foundation.reveal.js"></script>

<script src="javascripts/jquery.foundation.orbit.js"></script>

<script src="javascripts/jquery.foundation.navigation.js"></script>

<script src="javascripts/jquery.foundation.buttons.js"></script>

<script src="javascripts/jquery.foundation.tabs.js"></script>



<script src="javascripts/jquery.foundation.accordion.js"></script>

<script src="javascripts/jquery.placeholder.js"></script>

<script src="javascripts/jquery.foundation.alerts.js"></script>

<script src="javascripts/jquery.foundation.topbar.js"></script>

<script src="javascripts/jquery.foundation.joyride.js"></script>

<script src="javascripts/jquery.foundation.clearing.js"></script>

<script src="javascripts/jquery.foundation.magellan.js"></script>

-->

<!-- Included JS Files (Compressed) -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/foundation.min.js"></script>

<!-- Initialize JS Plugins -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/app.js"></script>

</body>
</html>
