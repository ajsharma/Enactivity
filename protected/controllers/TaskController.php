<?php

class TaskController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		// get the group assigned to the event
		if(!empty($_GET['id'])) {
			$task = $this->loadModel($_GET['id']);
			$goal = $task->goal;
			$groupId = $goal->groupId;
		}
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create'),
				'users'=>array('@'),
			),
			array('allow',  // allow only group members to perform 'updateprofile' actions
				'actions'=>array(
					'view','update','trash',
					'untrash','complete','uncomplete',
					'own','unown'
				),
				'expression'=>'$user->isGroupMember(' . $groupId . ')',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete'),
				'expression'=>'$user->isAdmin',
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
		$model=new Task;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Completes a particular model.
	 * If complete is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionComplete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow trashing via POST request
			$task = $this->loadModel($id);
			$task->complete();
			$task->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Uncompletes a particular model.
	 * If uncomplete is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionUncomplete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow uncompletion via POST request
			$task = $this->loadModel($id);
			$task->uncomplete();
			$task->save();
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
		/**
	 * Owns a particular model.
	 * If own is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionOwn($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow trashing via POST request
			$task = $this->loadModel($id);
			$task->own();
			$task->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Unowns a particular model.
	 * If unown is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionUnown($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow uncompletion via POST request
			$task = $this->loadModel($id);
			$task->unown();
			$task->save();
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Trashes a particular model.
	 * If trash is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionTrash($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow trashing via POST request
			$task = $this->loadModel($id);
			$task->trash();
			$task->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
	 * Untrashes a particular model.
	 * If untrash is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionUntrash($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow untrashing via POST request
			$task = $this->loadModel($id);
			$task->untrash();
			$task->save();
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])) {
				$this->redirectReturnUrlOrView($task);
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Redirect the current view to the return url value or
	 * to the goal/view page if no return url is specified.
	 * @param Goal $goal
	 */
	private function redirectReturnUrlOrView($goal) {
		$this->redirect(
			isset($_POST['returnUrl']) 
			? $_POST['returnUrl'] 
			: array('task/view', 'id'=>$goal->id,));
	}
}
