<?php
/* @var $this TDbController */
/* @var $dataProvider CActiveDataProvider */
$br_sub = Subdiv::model()->find('id=:subdiv', array(':subdiv' => $_GET['subdiv']));
$this->breadcrumbs = array(
    $br_sub->name,
);
?>
<!-- Button to trigger modal -->


    <?php $this->renderPartial('_table'); ?>