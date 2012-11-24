<?php

class TDbController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','dynamicresponsabil','list','stat'),
				//'users'=>array('@'),
                'roles'=>array('2','3'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
                'roles'=>array('1','2'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new TDb;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TDb']))
		{
			$model->attributes=$_POST['TDb'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['TDb']))
		{
			$model->attributes=$_POST['TDb'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//		$dataProvider=new CActiveDataProvider('TDb');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));

            // = date('Y');

            $criteria=new CDbCriteria();
            $criteria->condition= 'YEAR(date_reg)=2012';
            $criteria->order= 'id DESC';
            $count=TDb::model()->count($criteria);
            $pages=new CPagination($count);

            // results per page
            $pages->pageSize=Yii::app()->params['listPerPage'];
            $pages->applyLimit($criteria);
            $models=TDb::model()->findAll($criteria);

            $this->render('index', array(
                'models' => $models,
                'pages' => $pages
            ));
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TDb('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TDb']))
			$model->attributes=$_GET['TDb'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionList()
        {
            $criteria=new CDbCriteria();
            
            if(isset($_GET['inchis'])){
                $criteria->condition= 'subdiv=:subdiv AND nr_respons!=0 AND YEAR(date_reg)=:year';
                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            } else if(isset($_GET['neinchis'])) {
                $criteria->condition= 'subdiv=:subdiv AND nr_respons=0 AND YEAR(date_reg)=:year';

                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            } else if(isset($_GET['erori'])) {
                $criteria->condition= 'subdiv=:subdiv AND responsabil=0 AND nr_respons!=0 AND YEAR(date_reg)=:year';
                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            } else if(isset($_GET['rp'])) {
                $criteria->condition= 'subdiv=:subdiv AND responsabil=:rp AND YEAR(date_reg)=:year';
                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':rp'=>$_GET['rp'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            } else if(isset($_GET['tr'])) {
                $criteria->condition= 'subdiv=:subdiv AND respons_type=:tr AND YEAR(date_reg)=:year';
                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':tr'=>$_GET['tr'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            }
            else
            {
                $criteria->condition= 'subdiv=:subdiv AND YEAR(date_reg)=:year';

                $criteria->params = array(':subdiv' => $_GET['subdiv'], ':year'=>date("Y"));
                $criteria->order = 'id DESC';
            }
            
            
            
            $count=TDb::model()->count($criteria);
            $pages=new CPagination($count);

            // results per page
            $pages->pageSize=Yii::app()->params['listPerPage'];
            $pages->applyLimit($criteria);
            $models=TDb::model()->findAll($criteria);

            $this->render('list', array(
                'models' => $models,
                'pages' => $pages
            ));
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TDb::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tdb-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionDynamicresponsabil()
    {
        $data=Responsabil::model()->findAll('subdiv=:parent_id',
            array(':parent_id'=>(int) $_POST['subdiv']));

        $data=CHtml::listData($data,'id','fullname');
        echo "<option value='0'>Alegeți responsabilul</option>";
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                array('value'=>$value),CHtml::encode($name),true);
        }
    }

    public function textLimit($string, $length, $replacer = '...')
    {
        if (strlen($string) > $length)
            return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length + 1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;

        return $string;
    }
    
    public function actionStat()
    {
        $this->render('stat');
    }
    
}
