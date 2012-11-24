<?php
/* @var $this TDbController */
/* @var $model TDb */

$this->breadcrumbs=array(
	'Registrul'=>array('index'),
	$model->id,
);

?>

<h1>Detalierea înregistrării #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
    'nullDisplay'=>'',
    'attributes'=>array(
		'id',
        array(
            'name'=>'subdiv',
            'value'=>($model->subdiv2)?$model->subdiv2->name:'',
        ),
		'nr_reg',
        array(
            'name'=>'date_reg',
            'value'=>Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),$model->date_reg),
        ),
        array(
            'name'=>'date_doc',
            'value'=>Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),$model->date_doc),
        ),
		'elab',
		'id_elab',
		'address',
        'nr_etaje',
        'suprafata',
		'nr_cadastr',
		'tel',
		'content',
        array(
            'name'=>'responsabil',
            'value'=>($model->responsabil2)?$model->responsabil2->fullname:'',
        ),
        array(
            'name'=>'get_exec',
            'value'=>($model->get_exec == "0000-00-00")?'':Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),$model->get_exec),
        ),
		'nr_respons',
        array(
            'name'=>'date_respons',
            'value'=>($model->date_respons == "0000-00-00")?'':Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),$model->date_respons),
        ),
        array(
            'name'=>'respons_type',
            'value'=>($model->respons_type2)?$model->respons_type2->name:'',
        ),
		'note',
		'dossier',
        array(
            'name'=>'author',
            'value'=>($model->author2)?$model->author2->login:'',
            'visible'=>!Yii::app()->user->isGuest,
        ),
        array(
            'name'=>'date_add',
            'value'=>Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'),$model->date_add),
            'visible'=>!Yii::app()->user->isGuest,
        ),
	),
)); ?>
