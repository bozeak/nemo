<?php
/* @var $this TDbController */
/* @var $model TDb */

$this->breadcrumbs=array(
	'Registrul'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Modificarea',
);

?>

<h1>Modificarea înregistrării #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>