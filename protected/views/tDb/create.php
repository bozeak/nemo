<?php
/* @var $this TDbController */
/* @var $model TDb */

$this->breadcrumbs=array(
	'Registrul'=>array('index'),
	'Adăugare',
);

$this->menu=array(
	array('label'=>'List TDb', 'url'=>array('index')),
	array('label'=>'Manage TDb', 'url'=>array('admin')),
);
?>

<h1>Adăugarea documentului</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>